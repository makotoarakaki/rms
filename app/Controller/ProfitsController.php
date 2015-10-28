<?php
App::uses('AppController', 'Controller');
/**
 * Profits Controller
 *
 * @property Profit $Profit
 */
class ProfitsController extends AppController {

	/**
	 *使用モデルの設定
	 *
	 */
	public $uses = array('Profit', 'MainItem', 'Item');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if (isset($this->request->data['Profit']['business_day'])) {
			$business_day = $this->request->data['Profit']['business_day']['year'].'-'.$this->request->data['Profit']['business_day']['month'].'-'.$this->request->data['Profit']['business_day']['day'];
		} else if (!empty($this->request->params['pass'])) {
			$business_day = $this->request->params['pass'][0];
		} else {
			$business_day = date("Y-m-d");
		}

		$this->Profit->recursive = 0;

		$option = array('conditions' => 'Profit.business_day = "'.$business_day.'"', 'order' => array('Profit.created' => 'desc'));

		$this->set('profits', $this->paginate());
		$this->set('profits', $this->Profit->find('all', $option));
		$this->request->data['Profit']['business_day'] = $business_day;
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Profit->id = $id;
		if (!$this->Profit->exists()) {
			throw new NotFoundException(__('この仕入れ項目は無効です。'));
		}
		$this->set('profit', $this->Profit->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if (!empty($this->data)) {
							$list = array();
				foreach ($this->data['Profit'] as $data) {
					$this->Profit->create();

					if (isset($data['item_id'])) {
						// 営業日の作成
						$data += array('business_day' => $this->data['Profit']['business_day']);

						// 合計値を取得
						$total = $this->_unit_total($data['item_count'], $data['unit_price']);
						// 合計値の作成
						$data += array('total' => $total);

						array_push($list, $data);
					}
				}

				// データ登録処理
				$this->Profit->begin();
				$result = $this->Profit->saveAll($list);
				if ($result) {
					$this->Profit->commit();
					$this->Session->setFlash(__('売上が保存されました。'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Profit->rollback();
					$this->Session->setFlash(__('売上が保存出来ませんでした。もう一度やり直して下さい。'));

				}
			}
		}

		$options['fields'] = array('MainItem.id AS main_item_id', 'MainItem.main_item_name AS main_item_name',
				                   'Item.id AS item_id', 'Item.item_name AS item_name', 'Item.unit_price AS unit_price', 'Item.no_cost AS no_cost');
		$options['joins'][] = array('type'=>'LEFT', 'table'=>'main_item', 'alias'=>'MainItem',
		                            'conditions'=>'Item.main_item_id = MainItem.id');
		$options['conditions'] = array('bunrui = 0 OR bunrui = 2');
		$options['order'] = array('MainItem.id', 'Item.id');

		$result =  $this->Item->find('all', $options);
		$this->set('profits', $this->_makeAddList($result));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null, $item_id = null) {
		$this->Profit->id = $id;
		if (!$this->Profit->exists()) {
			throw new NotFoundException(__('この売上項目は無効です。'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// 品目マスタよりデータを取得
			$data = $this->Item->find('all', array('conditions' => 'id = '.$item_id));
			if ($data[0]['Item']['no_cost'] == 0) {
				$cost = $data[0]['Item']['unit_price'];
				// 売上単価 × 数量
				$this->request->data['Profit']['total'] = $cost * $this->request->data['Profit']['item_count'];
			}

			if ($this->Profit->save($this->request->data)) {
				$this->Session->setFlash(__('売上が保存されました。'));
				$business_day = $this->request->data['Profit']['business_day']['year'].'-'.$this->request->data['Profit']['business_day']['month'].'-'.$this->request->data['Profit']['business_day']['day'];
				$this->redirect(array('action' => 'index', $business_day));
			} else {
				$this->Session->setFlash(__('売上が保存出来ませんでした。もう一度やり直して下さい。'));
			}
		} else {
			$this->request->data = $this->Profit->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Profit->id = $id;
		if (!$this->Profit->exists()) {
			throw new NotFoundException(__('この売上項目は無効です。'));
		}
		if ($this->Profit->delete()) {
			$this->Session->setFlash(__('売上を削除しました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('売上は削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * 売上レコード用のリスト作成
	 *
	 * @param $array クエリーで取得した配列
	 * @return $list 登録、更新用のレコード配列
	 *
	 */
	private function _makeAddList($array = null) {
		$result_list = array();
		$list;

		$main_id = 0;
		foreach ($array as $profit) {

			$list['main_item_id'] =  $profit['MainItem']['main_item_id'];
			$list['main_item_name'] = $profit['MainItem']['main_item_name'];
			$list['item_id'] = $profit['Item']['item_id'];
			$list['item_name'] = $profit['Item']['item_name'];
			$list['unit_price'] = $profit['Item']['unit_price'];
			$list['no_cost'] = $profit['Item']['no_cost'];
			$list['item_count'] = 0;

			array_push($result_list, $list);
		}
		return $result_list;
	}

	/**
	 * 合計値返却
	 * @param $item_count 品目数
	 * @param $unit_price 単価
	 * @return $total 合計値
	 */
	private function _unit_total($item_count = 0, $unit_price) {
		$total = 0;
		if ($item_count != 0) {
			$total = $item_count * $unit_price;
		}
		return $total;
	}
}
