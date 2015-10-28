<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class ItemsController extends AppController {

	/**
	 *使用モデルの設定
	 *
	 */
	public $uses = array('Item','MainItem', 'Spread');


	/**
	 *beforeRender コールバック
	 *
	 */
	public function beforeRender() {
		// 項目リストの設定
		$this->set('mainItemList', $this->MainItem->find('list', array('fields' => array('id', 'main_item_name'))));
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Item->recursive = 0;

		$options['fields'] = array('Main.id', 'Main.main_item_name', 'Item.id', 'Item.item_name', 'Item.cost',
		                           'Item.unit_price', 'Item.created', 'Item.modified');
		$options['joins'][] = array('type'=>'LEFT', 'table'=>'main_item', 'alias'=>'Main',
		                            'conditions'=>'Item.main_item_id = Main.id');
		$options['order'] = 'Main.id';
//		$options['limit'] = '20';
		$result =  $this->Item->find('all', $options);

		$this->set('items', $result, $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('無効な品目'));
		}
		$this->set('item', $this->Item->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Item->create();
			if ($this->Item->save($this->request->data)) {
				// 集計表の登録
				$this->_spreadAdd($this->request->data);
				$this->Session->setFlash(__('品目が保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('品目が保存されませんでした。もう一度やり直して下さい。'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('無効な品目'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Item->save($this->request->data)) {
				$this->_spreadEdit($this->request->data);
				$this->Session->setFlash(__('品目が保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('品目が保存されませんでした。もう一度やり直して下さい。'));
			}
		} else {
			$this->request->data = $this->Item->read(null, $id);
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
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('無効な品目'));
		}
		if ($this->Item->delete()) {
			// spreadの削除
			$this->_spreadDelete($id);
			$this->Session->setFlash(__('品目が削除されました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('品目は削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * 集計表登録
	 *
	 * @param unknown_type $list
	 */
	private function _spreadAdd($list = null) {
		$data;
		$item_id = 0;
		$main_item_name;

		// item_idに格納する最大値を取得
		$result_id =  $this->Item->find('first', array('fields' => 'MAX(id) as id'));
		$item_id = $result_id[0]['id'];
		// main_item_nameの取得
		$main_item_name = $this->MainItem->find('first', array('fields' => 'main_item_name', 'conditions' => 'id = '.$list['Item']['main_item_id']));

		// main_item_id
		$data['Spread']['main_item_id'] = $list['Item']['main_item_id'];
		// item_id
		$data['Spread']['item_id'] = $item_id;
		// main_item_name
		$data['Spread']['main_item_name'] = $main_item_name['MainItem']['main_item_name'];
		// item_name
		$data['Spread']['item_name'] = $list['Item']['item_name'];
		$this->Spread->save($data);
	}


	/**
	 * 集計表更新
	 *
	 * @param $list Itemリスト
	 */
	private function _spreadEdit($list = null) {
		$data;
		$main_item_name;

		// 更新元のレコードの取得
		$data = $this->Spread->find('first', array('conditions' => 'item_id = '.$this->Item->id));
		// main_item_nameの取得
		$main_item_name = $this->MainItem->find('first', array('fields' => 'main_item_name', 'conditions' => 'id = '.$list['Item']['main_item_id']));

		// main_item_id
		$data['Spread']['main_item_id'] = $list['Item']['main_item_id'];
		// item_id
		$data['Spread']['item_id'] = $this->Item->id;
		// main_item_name
		$data['Spread']['main_item_name'] =$main_item_name['MainItem']['main_item_name'];
		// item_name
		$data['Spread']['item_name'] = $list['Item']['item_name'];
		$this->Spread->save($data);
	}

	/**
	 * 集計表削除
	 *
	 * @param $id id
	 */
	private function _spreadDelete($id = null) {
		$data;
		// 削除元のレコードの取得
		$data = $this->Spread->find('first', array('conditions' => 'item_id = '.$id));
		$this->Spread->id = $data['Spread']['id'];
		$this->Spread->delete();
	}
}
