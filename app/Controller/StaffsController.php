<?php
App::uses('AppController', 'Controller');
/**
 * Staffs Controller
 *
 * @property Staff $Staff
 */
class StaffsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Staff->recursive = 0;
		$this->set('staffs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Staff->id = $id;
		if (!$this->Staff->exists()) {
			throw new NotFoundException(__('無効です。'));
		}
		$this->set('staff', $this->Staff->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Staff->create();
			if ($this->Staff->save($this->request->data)) {
				$this->Session->setFlash(__('スタッフが保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('スタッフは保存できませんでした。もう一度やり直して下さい。'));
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
		$this->Staff->id = $id;
		if (!$this->Staff->exists()) {
			throw new NotFoundException(__('無効です'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Staff->save($this->request->data)) {
				$this->Session->setFlash(__('スタッフが保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('スタッフは保存できませんでした。もう一度やり直して下さい。'));
			}
		} else {
			$this->request->data = $this->Staff->read(null, $id);
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
		$this->Staff->id = $id;
		if (!$this->Staff->exists()) {
			throw new NotFoundException(__('無効です。'));
		}
		if ($this->Staff->delete()) {
			$this->Session->setFlash(__('スタッフは削除されました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('スタッフは削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}
}
