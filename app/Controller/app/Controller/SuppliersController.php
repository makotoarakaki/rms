<?php
App::uses('AppController', 'Controller');
/**
 * Suppliers Controller
 *
 * @property Supplier $Supplier
 */
class SuppliersController extends AppController {

	/**
	 *使用モデルの設定
	 *
	 */
	public $uses = array('Supplier', 'MainItem', 'Item');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if (isset($this->request->data['Supplier']['business_day'])) {
			$business_day = $this->request->data['Supplier']['business_day']['year'].'-'.$this->request->data['Supplier']['business_day']['month'].'-'.$this->request->data['Supplier']['business_day']['day'];
		} else if (!empty($this->request->params['pass'])) {
			$business_day = $this->request->params['pass'][0];
		} else {
			$business_day = date("Y-m-d");
		}

		$this->Supplier->recursive = 0;

		$option = array('conditions' => 'Supplier.business_day = "'.$business_day.'"', 'order' => array('Supplier.created' => 'desc'));

		$this->set('suppliers', $this->paginate());
		$this->set('suppliers', $this->Supplier->find('all', $option));
		$this->request->data['Supplier']['business_day'] = $business_day;
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Supplier->id = $id;
		if (!$this->Supplier->exists()) {
			throw new NotFoundException(__('この仕入れ項目は無効です。'));
		}
		$this->set('supplier', $this->Supplier->read(null, $id));
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
				foreach ($this->data['Supplier'] as $data) {
					$this->Supplier->create();

					if (isset($data['item_id'])) {
						// 営業日の作成
						$data += array('business_day' => $this->data['Supplier']['business_day']);

						// 合計値を取得
						$total = $this->_unit_total($data['item_count'], $data['cost']);
						// 合計値のリストを追加
						$data += array('total' => $total);

						array_push($list, $data);
					}
				}

				// データ登録処理
				// 仕入
				$this->Supplier->begin();
				$result = $this->Supplier->saveAll($list);
				if ($result) {
					$this->Supplier->commit();
					$this->Session->setFlash(__('仕入が保存されました。'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Supplier->rollback();
					$this->Session->setFlash(__('仕入が保存出来ませんでした。もう一度やり直して下さい。'));
				}
			}
		}

		$options['fields'] = array('MainItem.id AS main_item_id', 'MainItem.main_item_name AS main_item_name',
				                   'Item.id AS item_id', 'Item.item_name AS item_name', 'Item.cost AS cost', 'Item.no_cost AS no_cost');
		$options['joins'][] = array('type'=>'LEFT', 'table'=>'main_item', 'alias'=>'MainItem',
		                            'conditions'=>'Item.main_item_id = MainItem.id');
		$options['conditions'] = array('bunrui = 0 OR bunrui = 1');
		$options['order'] = array('MainItem.id', 'Item.id');

		$result =  $this->Item->find('all', $options);
		$this->set('suppliers', $this->_makeAddList($result));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null, $item_id = null) {
		$this->Supplier->id = $id;
		if (!$this->Supplier->exists()) {
			throw new NotFoundException(__('この仕入項目は無効です。'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// 品目マスタよりデータを取得
			$data = $this->Item->find('all', array('conditions' => 'id = '.$item_id));
			if ($data[0]['Item']['no_cost'] == 0) {
				$cost = $data[0]['Item']['cost'];
				// 仕入れ単価 × 数量
				$this->request->data['Supplier']['total'] = $cost * $this->request->data['Supplier']['item_count'];
			}

			if ($this->Supplier->save($this->request->data)) {
				$this->Session->setFlash(__('仕入が保存されました。'));
				$business_day = $this->request->data['Supplier']['business_day']['year'].'-'.$this->request->data['Supplier']['business_day']['month'].'-'.$this->request->data['Supplier']['business_day']['day'];
				$this->redirect(array('action' => 'index', $business_day));
			} else {
				$this->Session->setFlash(__('仕入が保存出来ませんでした。もう一度やり直して下さい。'));
			}
		} else {
			$this->request->data = $this->Supplier->read(null, $id);
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
		$this->Supplier->id = $id;
		if (!$this->Supplier->exists()) {
			throw new NotFoundException(__('この仕入項目は無効です。'));
		}
		if ($this->Supplier->delete()) {
			$this->Session->setFlash(__('仕入を削除しました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('仕入は削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * 仕入レコード用のリスト作成
	 *
	 * @param $array クエリーで取得した配列
	 * @return $list 登録、更新用のレコード配列
	 *
	 */
	private function _makeAddList($array = null) {
		$result_list = array();
		$list;

		$main_id = 0;
		foreach ($array as $supplier) {

    		$list['main_item_id'] =  $supplier['MainItem']['main_item_id'];
			$list['main_item_name'] = $supplier['MainItem']['main_item_name'];
			$list['item_id'] = $supplier['Item']['item_id'];
			$list['item_name'] = $supplier['Item']['item_name'];
			$list['cost'] = $supplier['Item']['cost'];
			$list['no_cost'] = $supplier['Item']['no_cost'];
			$list['item_count'] = 0;

			array_push($result_list, $list);
    	}
		return $result_list;
    }

    /**
     * 合計値返却
     * @param $item_count 品目数
     * @param $cost 原価
     * @return $total 合計値
     */
    private function _unit_total($item_count = 0, $cost) {
    	$total = 0;
    	if ($item_count != 0) {
    		$total = $item_count * $cost;
    	}
    	return $total;
    }
}
