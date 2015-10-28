<?php
App::uses('AppController', 'Controller');
/**
 * YoyakucdMs Controller
 *
 * @property YoyakucdM $YoyakucdM
 */
class YoyakucdMsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->YoyakucdM->recursive = 0;
		$this->set('yoyakucdMs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->YoyakucdM->id = $id;
		if (!$this->YoyakucdM->exists()) {
			throw new NotFoundException(__('Invalid yoyakucd m'));
		}
		$this->set('yoyakucdM', $this->YoyakucdM->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->YoyakucdM->create();
			if ($this->YoyakucdM->save($this->request->data)) {
				$this->Session->setFlash(__('予約コードは正しく保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('予約コードの保存がされませんでした。もう一度試してください。'));
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
		$this->YoyakucdM->id = $id;
		if (!$this->YoyakucdM->exists()) {
			throw new NotFoundException(__('Invalid yoyakucd m'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->YoyakucdM->save($this->request->data)) {
				$this->Session->setFlash(__('予約コードは正しく更新されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('予約コードの更新がされませんでした。もう一度試してください。'));
			}
		} else {
			$this->request->data = $this->YoyakucdM->read(null, $id);
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
		$this->YoyakucdM->id = $id;
		if (!$this->YoyakucdM->exists()) {
			throw new NotFoundException(__('無効な予約コード'));
		}
		if ($this->YoyakucdM->delete()) {
			$this->Session->setFlash(__('予約コードを削除しました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('予約コードは削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}
}
