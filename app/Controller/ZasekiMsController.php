<?php
App::uses('AppController', 'Controller');
/**
 * ZasekiMs Controller
 *
 * @property ZasekiM $ZasekiM
 */
class ZasekiMsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ZasekiM->recursive = 0;
		$this->set('zasekiMs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ZasekiM->id = $id;
		if (!$this->ZasekiM->exists()) {
			throw new NotFoundException(__('Invalid zaseki m'));
		}
		$this->set('zasekiM', $this->ZasekiM->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ZasekiM->create();
			if ($this->ZasekiM->save($this->request->data)) {
				$this->Session->setFlash(__('座席情報は正しく保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('座席情報の保存がされませんでした。もう一度試してください。'));
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
		$this->ZasekiM->id = $id;
		if (!$this->ZasekiM->exists()) {
			throw new NotFoundException(__('Invalid zaseki m'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ZasekiM->save($this->request->data)) {
				$this->Session->setFlash(__('座席情報は正しく更新されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('座席情報の更新がされませんでした。もう一度試してください。'));
			}
		} else {
			$this->request->data = $this->ZasekiM->read(null, $id);
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
		$this->ZasekiM->id = $id;
		if (!$this->ZasekiM->exists()) {
			throw new NotFoundException(__('無効な座席情報'));
		}
		if ($this->ZasekiM->delete()) {
			$this->Session->setFlash(__('座席情報を削除しました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('座席情報は削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}
}
