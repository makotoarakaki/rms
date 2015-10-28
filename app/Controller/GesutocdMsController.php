<?php
App::uses('AppController', 'Controller');
/**
 * GesutocdMs Controller
 *
 * @property GesutocdM $GesutocdM
 */
class GesutocdMsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GesutocdM->recursive = 0;
		$this->set('gesutocdMs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->GesutocdM->id = $id;
		if (!$this->GesutocdM->exists()) {
			throw new NotFoundException(__('Invalid gesutocd m'));
		}
		$this->set('gesutocdM', $this->GesutocdM->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GesutocdM->create();
			if ($this->GesutocdM->save($this->request->data)) {
				$this->Session->setFlash(__('ゲストコードは正しく保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('ゲストコードの保存がされませんでした。もう一度試してください。'));
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
		$this->GesutocdM->id = $id;
		if (!$this->GesutocdM->exists()) {
			throw new NotFoundException(__('無効なゲストコード'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->GesutocdM->save($this->request->data)) {
				$this->Session->setFlash(__('ゲストコードは正しく更新されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('ゲストコードの更新がされませんでした。もう一度試してください。'));
			}
		} else {
			$this->request->data = $this->GesutocdM->read(null, $id);
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
		$this->GesutocdM->id = $id;
		if (!$this->GesutocdM->exists()) {
			throw new NotFoundException(__('無効なゲストコード'));
		}
		if ($this->GesutocdM->delete()) {
			$this->Session->setFlash(__('ゲストコードを削除しました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('ゲストコードは削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}
}
