<?php
App::uses('AppController', 'Controller');
/**
 * YoyakuJyohos Controller
 *
 * @property YoyakuJyoho $YoyakuJyoho
 */
class YoyakuJyohosController extends AppController {

	public $uses = array('YoyakuJyoho', 'TenpoM', 'ZasekiM', 'YoyakucdM', 'GesutocdM');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->YoyakuJyoho->recursive = 0;
		$this->set('yoyakuJyohos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->YoyakuJyoho->id = $id;
		if (!$this->YoyakuJyoho->exists()) {
			throw new NotFoundException(__('Invalid yoyaku jyoho'));
		}
		$this->set('yoyakuJyoho', $this->YoyakuJyoho->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/* 店舗マスタから、すべてのidと名称を取得し、Viewへセット */
		$ary_tenpos = $this->TenpoM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_tenpos as $key => $value){
			$this->set('ary_tenpos', $ary_tenpos);
		}
		
		/* 座席マスタから、すべてのidと名称を取得し、Viewへセット */
		$ary_zasekis = $this->ZasekiM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_zasekis as $key => $value){
			$this->set('ary_zasekis', $ary_zasekis);
		}
		
		/* 予約コードマスタから、すべてのidと名称を取得し、Viewへセット */
		$ary_yoyaku_cds = $this->YoyakucdM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_yoyaku_cds as $key => $value){
			$this->set('ary_yoyaku_cds', $ary_yoyaku_cds);
		}
		
		/* ゲストコードマスタから、すべてのidと名称を取得し、Viewへセット */
		$ary_gesuto_cds = $this->GesutocdM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_gesuto_cds as $key => $value){
			$this->set('ary_gesuto_cds', $ary_gesuto_cds);
		}
	
		if ($this->request->is('post')) {
			// 選択した店舗（この時点では、店舗ID）を取得
    		$select_tenpo_id = $this->request->data['YoyakuJyoho']['tenpo_name'];
    		// 選択した[店舗ID]をもとに、店舗マスタから「名称」を取得
    		$res_tenpo_name = $this->TenpoM->field('name', array('id'=>$select_tenpo_id));
    		// 登録データに「名称」を代入
    		$this->request->data['YoyakuJyoho']['tenpo_name'] = $res_tenpo_name;
    	
    		// [予約コード]のうち、チェックが入った予約コードを取得
    		$ary_yoyaku_cds = array();
    		$ary_yoyaku_cds = $this->request->data['YoyakuJyoho']['yoyaku_code'];
    		$yoyaku_cd_res = '';
    		foreach($ary_yoyaku_cds as $key => $value){
				$chk_yoyaku_cd_id = $value;
    			$conditions = array('id'=>$chk_yoyaku_cd_id);
    			$result = $this->YoyakucdM->field('name', $conditions);
    			
    			$yoyaku_cd_res .= $result . ',';
    		}
    		
    		$this->request->data['YoyakuJyoho']['yoyaku_code'] = $yoyaku_cd_res;
    	
    		// [座席]のうち、チェックが入った座席を取得
    		$ary_zasekis = array();
    		$ary_zasekis = $this->request->data['YoyakuJyoho']['zaseki'];
    		$zaseki_res = '';
    		foreach($ary_zasekis as $key => $value){
				$chk_zaseki_id = $value;
    			$conditions = array('id'=>$chk_zaseki_id);
    			$result = $this->ZasekiM->field('name', $conditions);
    			
    			$zaseki_res .= $result . ',';
    		}
    		
    		$this->request->data['YoyakuJyoho']['zaseki'] = $zaseki_res;
    	
    		// [ゲストコード]のうち、チェックが入ったゲストコードを取得
    		$ary_gesuto_cds = array();
    		$ary_gesuto_cds = $this->request->data['YoyakuJyoho']['gesuto_code'];
    		$gesuto_cd_res = '';
    		foreach($ary_gesuto_cds as $key => $value){
				$chk_gesuto_cd_id = $value;
    			$conditions = array('id'=>$chk_gesuto_cd_id);
    			$result = $this->GesutocdM->field('name', $conditions);
    			
    			$gesuto_cd_res .= $result . ',';
    		}
    		
    		$this->request->data['YoyakuJyoho']['gesuto_code'] = $gesuto_cd_res;
		
			$this->YoyakuJyoho->create();
			if ($this->YoyakuJyoho->save($this->request->data)) {
				$this->Session->setFlash('予約情報を登録しました。');
				return $this->redirect(array('action'=>'index'));
				//$this->flash(__('予約情報を登録しました。'), array('action' => 'index'));
			} else {
				//保存が失敗した場合のメッセージ
            	$this->Session->setFlash('予約情報の登録に失敗しました');
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
		$this->YoyakuJyoho->id = $id;
		
		/* 店舗マスタから、すべてのidと名称を取得し、Viewへセット */
		$ary_tenpos = $this->TenpoM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_tenpos as $key => $value){
			$this->set('ary_tenpos', $ary_tenpos);
		}
		
		/* 座席マスタから、すべてのidと名称を取得し、Viewへセット */
		$ary_zasekis = $this->ZasekiM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_zasekis as $key => $value){
			$this->set('ary_zasekis', $ary_zasekis);
		}
		
		/* 予約コードマスタから、すべてのidと名称を取得し、Viewへセット */
		$ary_yoyaku_cds = $this->YoyakucdM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_yoyaku_cds as $key => $value){
			$this->set('ary_yoyaku_cds', $ary_yoyaku_cds);
		}

		/* ゲストコードマスタから、すべてのidと名称を取得し、Viewへセット */
		$ary_gesuto_cds = $this->GesutocdM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_gesuto_cds as $key => $value){
			$this->set('ary_gesuto_cds', $ary_gesuto_cds);
		}

		if (!$this->YoyakuJyoho->exists()) {
			throw new NotFoundException(__('無効な予約情報'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// 選択した店舗（この時点では、店舗ID）を取得
    		$select_tenpo_id = $this->request->data['YoyakuJyoho']['tenpo_name'];
    		// 選択した[店舗ID]をもとに、店舗マスタから「名称」を取得
    		$res_tenpo_name = $this->TenpoM->field('name', array('id'=>$select_tenpo_id));
    		// 登録データに「名称」を代入
    		$this->request->data['YoyakuJyoho']['tenpo_name'] = $res_tenpo_name;
    	
    		// [予約コード]のうち、チェックが入った予約コードを取得
    		$ary_yoyaku_cds = array();
    		$ary_yoyaku_cds = $this->request->data['YoyakuJyoho']['yoyaku_code'];
    		$yoyaku_cd_res = '';
    		foreach($ary_yoyaku_cds as $key => $value){
				$chk_yoyaku_cd_id = $value;
    			$conditions = array('id'=>$chk_yoyaku_cd_id);
    			$result = $this->YoyakucdM->field('name', $conditions);
    			
    			$yoyaku_cd_res .= $result . ',';
    		}
    		
    		$this->request->data['YoyakuJyoho']['yoyaku_code'] = $yoyaku_cd_res;
    	
    		// [座席]のうち、チェックが入った座席を取得
    		$ary_zasekis = array();
    		$ary_zasekis = $this->request->data['YoyakuJyoho']['zaseki'];
    		$zaseki_res = '';
    		foreach($ary_zasekis as $key => $value){
				$chk_zaseki_id = $value;
    			$conditions = array('id'=>$chk_zaseki_id);
    			$result = $this->ZasekiM->field('name', $conditions);
    			
    			$zaseki_res .= $result . ',';
    		}
    		
    		$this->request->data['YoyakuJyoho']['zaseki'] = $zaseki_res;
    	
    		// [ゲストコード]のうち、チェックが入ったゲストコードを取得
    		$ary_gesuto_cds = array();
    		$ary_gesuto_cds = $this->request->data['YoyakuJyoho']['gesuto_code'];
    		$gesuto_cd_res = '';
    		foreach($ary_gesuto_cds as $key => $value){
				$chk_gesuto_cd_id = $value;
    			$conditions = array('id'=>$chk_gesuto_cd_id);
    			$result = $this->GesutocdM->field('name', $conditions);
    			
    			$gesuto_cd_res .= $result . ',';
    		}
    		
    		$this->request->data['YoyakuJyoho']['gesuto_code'] = $gesuto_cd_res;
		
			if ($this->YoyakuJyoho->save($this->request->data)) {
				$this->Session->setFlash(__('予約情報は正しく更新されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('予約情報の更新がされませんでした。もう一度試してください。'));
			}
		} else {
			$this->request->data = $this->YoyakuJyoho->read(null, $id);
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
		$this->YoyakuJyoho->id = $id;
		if (!$this->YoyakuJyoho->exists()) {
			throw new NotFoundException(__('Invalid yoyaku jyoho'));
		}
		if ($this->YoyakuJyoho->delete()) {
			$this->flash(__('Yoyaku jyoho deleted'), array('action' => 'index'));
		}
		$this->flash(__('Yoyaku jyoho was not deleted'), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
