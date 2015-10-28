<?php
App::uses('AppController', 'Controller');
/**
 * TenpoMs Controller
 *
 * @property TenpoM $TenpoM
 */
class TenpoMsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TenpoM->recursive = 0;
		$this->set('tenpoMs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->TenpoM->id = $id;
		if (!$this->TenpoM->exists()) {
			throw new NotFoundException(__('Invalid tenpo m'));
		}
		$this->set('tenpoM', $this->TenpoM->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			// [24時間営業]にチェックを入れた場合は、[開店時間]および[閉店時間]を午前6時として登録させる。
			if($this->request->data['TenpoM']['twenty_four_flg'] == 1){
				$this->request->data['TenpoM']['kaiten_time'] = '6:00:00';
				$this->request->data['TenpoM']['heiten_time'] = '6:00:00';
			}
			$this->TenpoM->create();
			if ($this->TenpoM->save($this->request->data)) {
				$this->Session->setFlash(__('店舗を登録しました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('登録に失敗しました。'));
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
		$this->TenpoM->id = $id;
		if (!$this->TenpoM->exists()) {
			throw new NotFoundException(__('Invalid tenpo m'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TenpoM->save($this->request->data)) {
				$this->Session->setFlash(__('店舗は正しく更新されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('店舗の更新がされませんでした。もう一度試してください。'));
			}
		} else {
			$this->request->data = $this->TenpoM->read(null, $id);
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
		$this->TenpoM->id = $id;
		if (!$this->TenpoM->exists()) {
			throw new NotFoundException(__('無効な店舗'));
		}
		if ($this->TenpoM->delete()) {
			$this->Session->setFlash(__('店舗を削除しました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('店舗は削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}
}
