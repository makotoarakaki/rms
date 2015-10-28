<?php
App::uses('AppController', 'Controller');
/**
 * TenpoJyohos Controller
 *
 * @property TenpoJyoho $TenpoJyoho
 */
class TenpoJyohosController extends AppController {

	public $uses = array('TenpoJyoho', 'TenpoM', 'ZasekiM');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		/* 追記（店舗.idと店舗.名称を取得） */
		$ary_tenpos = $this->TenpoM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_tenpos as $key => $value){
			$this->set('ary_tenpos', $ary_tenpos);
		}
		
		/* 追記（座席.idと座席.名称を取得） */
		$ary_zasekis = $this->ZasekiM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_zasekis as $key => $value){
			$this->set('ary_zasekis', $ary_zasekis);
		}
		
		$this->TenpoJyoho->recursive = 0;
		$this->set('tenpoJyohos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->TenpoJyoho->id = $id;
		if (!$this->TenpoJyoho->exists()) {
			throw new NotFoundException(__('Invalid tenpo jyoho'));
		}
		$this->set('tenpoJyoho', $this->TenpoJyoho->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/* 追記（店舗.idと店舗.名称を取得） */
		$ary_tenpos = $this->TenpoM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_tenpos as $key => $value){
			$this->set('tenpoIds', $ary_tenpos);
		}
		
		/* 追記（座席.idと座席.名称を取得） */
		$ary_zasekis = $this->ZasekiM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_zasekis as $key => $value){
			$this->set('zasekiIds', $ary_zasekis);
		}
	
		// [登録]ボタンクリック時
		if ($this->request->is('post')) {
			// チェックされた座席を取得
			$ary_chk_zasekis = $this->request->data['TenpoJyoho']['zaseki_id'];
		
			foreach($ary_chk_zasekis as $key => $value){
				$this->request->data['TenpoJyoho']['zaseki_id'] = $value;
				$this->TenpoJyoho->create();
				$this->TenpoJyoho->save($this->request->data);
			}
			if ($this->TenpoJyoho->save($this->request->data)) {
				$this->Session->setFlash(__('登録に成功しました。'));
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
		$this->TenpoJyoho->id = $id;
		if (!$this->TenpoJyoho->exists()) {
			throw new NotFoundException(__('Invalid tenpo jyoho'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TenpoJyoho->save($this->request->data)) {
				$this->Session->setFlash(__('The tenpo jyoho has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tenpo jyoho could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TenpoJyoho->read(null, $id);
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
		$this->TenpoJyoho->id = $id;
		if (!$this->TenpoJyoho->exists()) {
			throw new NotFoundException(__('Invalid tenpo jyoho'));
		}
		if ($this->TenpoJyoho->delete()) {
			$this->Session->setFlash(__('Tenpo jyoho deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tenpo jyoho was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
