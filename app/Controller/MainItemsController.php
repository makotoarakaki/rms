<?php
App::uses('AppController', 'Controller');
/**
 * MainItems Controller
 *
 * @property MainItem $MainItem
 */
class MainItemsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MainItem->recursive = 0;
		$this->set('mainItems', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MainItem->create();
			if ($this->MainItem->save($this->request->data)) {
				$this->Session->setFlash(__('項目が保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('項目は保存されませんでした。もう一度やり直して下さい。'));
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
		$this->MainItem->id = $id;
		if (!$this->MainItem->exists()) {
			throw new NotFoundException(__('無効な項目'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MainItem->save($this->request->data)) {
				$this->Session->setFlash(__('項目が保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('項目は保存されませんでした。もう一度やり直して下さい。'));
			}
		} else {
			$this->request->data = $this->MainItem->read(null, $id);
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
		$this->MainItem->id = $id;
		if (!$this->MainItem->exists()) {
			throw new NotFoundException(__('無効な項目'));
		}
		if ($this->MainItem->delete()) {
			$this->Session->setFlash(__('項目を削除しました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('項目は削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}
}
