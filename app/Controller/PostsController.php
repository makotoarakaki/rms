<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class PostsController extends AppController {

	public $helpers = array('Html', 'Form', 'DatePicker', 'Js');
	
	
	public $uses = array('Post', 'TenpoM', 'YoyakucdM', 'ZasekiM', 'GesutocdM', 'YoyakuJyoho', 'TenpoJyoho');	// 追記
	
	public $components = array('RequestHandler');
	
	/*public function timeTableByTenpo(){
		if(!$this->request->is('ajax')){
			$this->redirect('/index');
		}
		
		$this->set('tenpo_zasekis', $this->TenpoJyoho->find('all', array('fields'=>array('id', 'tenpo_id', 'zaseki_id'), 'conditions'=>array('tenpo_id'=>$this->data))));
		
		$this->set('tenpo_time_tables', $this->TenpoM->find('all', array('conditions'=>array('id'=>$this->data))));
	}*/
	
	
    public function index() {
/*		if ($this->request->is('post')) {
			$this->_send_mail($this->request->data);
		}
    	$this->set('posts', $this->Post->find('all'));
        $this->set('posts', $this->paginate());
*/

        
        // [店舗]プルダウンメニューもしくは[表示モード]プルダウンメニューを選択時
		if($this->params->query != null){
			$this->set('tenpo_zasekis', $this->TenpoJyoho->find('all', array('fields'=>array('id', 'tenpo_id', 'zaseki_id'), 'conditions'=>array('tenpo_id'=>$this->params->query['data']['tenpo_name']))));
		
			$this->set('tenpo_time_tables', $this->TenpoM->find('all', array('fields'=>array('id', 'name', 'kaiten_time', 'heiten_time', 'twenty_four_flg'), 'conditions'=>array('id'=>$this->params->query['data']['tenpo_name']))));
			
			// [店舗]プルダウンメニューから選択した店舗の名称を取得
			$selected_tenpo_name = $this->TenpoM->field('name', array('id'=>$this->params->query['data']['tenpo_name']));
        	
        	// 選択した店舗の予約情報を取得
        	// ①「表示モード」が月表示のとき
        	if($this->params->query['data']['disp_mode'] == 2){
        		// セッション情報内の日付を、「年」「月」「日」に分けて取得
				list($session_year, $session_month, $session_day) = explode('-', $_SESSION['Auth']['User']['disp_now_day']);
				// セッション情報内の日付の「月初日」を取得
				$first_day = date('Y-m-d', mktime(0, 0, 0, $session_month, 1, $session_year));
				// セッション情報内の日付の「月末日」を取得
        		$last_day = date('Y-m-d', mktime(0, 0, 0, $session_month+1, 0, $session_year));
        		// 予約日が、セッション情報内の日付と同じ月で、なおかつ店舗名が同じという条件
        		$conditions = array(
        						'and' => array(
        									'and' => array(
        												'yoyaku_day >=' => $first_day,
        												'yoyaku_day <=' => $last_day),
        									'tenpo_name' => $selected_tenpo_name));
        						
        		// 予約情報取得
        		$yoyaku_jyoho_list = $this->YoyakuJyoho->find('all', array('fields'=>array('user_name', 'yoyaku_day', 'raiten_time', 'taiten_time', 'ninzu', 'zaseki'), 'conditions'=>$conditions));
        	// ②「表示モード」が時間表示のとき
        	}else if($this->params->query['data']['disp_mode'] == 0){
        		// 予約日がセッション情報内の表示日付と同じで、店舗名も同じという条件
        		$conditions = array('yoyaku_day' => $_SESSION['Auth']['User']['disp_now_day'],
        							'tenpo_name' => $selected_tenpo_name);
        							
        		// 予約情報取得
        		$yoyaku_jyoho_list = $this->YoyakuJyoho->find('all', array('fields'=>array('user_name', 'yoyaku_day', 'raiten_time', 'taiten_time', 'ninzu', 'zaseki'), 'conditions'=>$conditions));
        	// ③「表示モード」が週表示のとき
        	}else if($this->params->query['data']['disp_mode'] == 1){
        	
        		// セッション情報の日付の曜日を取得
        		$now_day_week = date('w',strtotime($_SESSION['Auth']['User']['disp_now_day']));
        		// セッション情報の日付がある週の初め（日曜日）の日付を取得
    			$now_week_sunday_date = date('Y-m-d', strtotime("-{$now_day_week} day", strtotime($_SESSION['Auth']['User']['disp_now_day'])));
        		
        		// セッション情報の日付がある週末（土曜日）の日付を取得
        		$weekend = $now_day_week-6;
        		$now_week_saturday_date = date('Y-m-d', strtotime("-{$weekend} day", strtotime($_SESSION['Auth']['User']['disp_now_day'])));
        		
        		// 予約日がセッション情報内の表示日付の週で、店舗名も同じという条件
        		$conditions = array(
        						'and' => array(
        									'and' => array(
        												'yoyaku_day >=' => $now_week_sunday_date,
        												'yoyaku_day <=' => $now_week_saturday_date),
        									'tenpo_name' => $selected_tenpo_name));
        							
        		// 予約情報取得
        		$yoyaku_jyoho_list = $this->YoyakuJyoho->find('all', array('fields'=>array('user_name', 'yoyaku_day', 'raiten_time', 'taiten_time', 'ninzu', 'zaseki'), 'conditions'=>$conditions));
        	}
			
		// ログイン直後は、[所属店舗]の本日の予約情報タイムテーブルを生成
		}else{
			$this->set('tenpo_zasekis', $this->TenpoJyoho->find('all', array('fields'=>array('id', 'tenpo_id', 'zaseki_id'), 'conditions'=>array('tenpo_id'=>$_SESSION['Auth']['User']['tenpo_id']))));
        	
        	$this->set('tenpo_time_tables', $this->TenpoM->find('all', array('fields'=>array('id', 'name', 'kaiten_time', 'heiten_time', 'twenty_four_flg'), 'conditions'=>array('id'=>$_SESSION['Auth']['User']['tenpo_id']))));
        	
        	// 「所属店舗」の名称を取得
        	$syozoku_tenpo_name = $this->TenpoM->field('name', array('id'=>$_SESSION['Auth']['User']['tenpo_id']));
        	
        	// 「所属店舗」の予約情報を取得
        	$yoyaku_jyoho_list = $this->YoyakuJyoho->find('all', array('fields'=>array('user_name', 'yoyaku_day', 'raiten_time', 'taiten_time', 'ninzu', 'zaseki'), 'conditions'=>array('tenpo_name'=>$syozoku_tenpo_name, 'yoyaku_day'=>date('Y-m-d'))));
		}
		
		// 予約情報をViewへ渡す
		$this->set('yoyaku_jyoho_list', $yoyaku_jyoho_list);
		
		
		
		
		// 追記（[<<前]ボタン、[本日]ボタン、[次>>]ボタン用連想配列をViewへ渡す）
		$array_button_label = array('-1'=>'<<前', '0'=>'本日', '1'=>'次>>');
		$this->set('array_button_label', $array_button_label);
				
		$this->set('selected_tenpo_disp_mode', $this->params->query);
		

		/* 追記（店舗.名称を取得） */
		$ary_tenpos = $this->TenpoM->find('list', array('fields'=>array('id', 'name')));
		foreach($ary_tenpos as $key => $value){
			$this->set('tenpos', $ary_tenpos);
			
		}

        /* 追記（予約コード.名称を取得） */
		$this->set('yoyakucds', $this->YoyakucdM->find('list', array('fields'=>array('id', 'name'))));

        /* 追記（座席.名称を取得） */
        $this->set('zasekis', $this->ZasekiM->find('list', array('fields'=>array('id', 'name'))));
        
        /* 追記（ゲストコード.名称を取得） */
        $this->set('gesutos', $this->GesutocdM->find('list', array('fields'=>array('id', 'name'))));
        
        /* 追記（予約情報を取得） */
        $this->YoyakuJyoho->recursive = 0;
		$this->set('yoyakuJyohos', $this->YoyakuJyoho->find('all'));
        
        
        // ポストデータがあれば保存をする（保存ボタンが押された場合）
    	if ($this->request->is('post')) {
    		// 選択した[店舗]（この時点では、店舗ID）を取得
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
    	
           	//保存する
        	if ($this->YoyakuJyoho->save($this->request->data)) {
        		// メッセージをセットしてリダイレクトする
            	$this->Session->setFlash('登録成功');
            	return $this->redirect(array('action'=>'index'));
        	}else{
            	//保存が失敗した場合のメッセージ
            	$this->Session->setFlash('登録に失敗しました');
        	}
    	}else{
        	//ポストデータがない場合の処理
        	
    	}
    }

	public function view($id = null) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }

	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Post']['user_id'] = $this->Auth->user('id'); //Added this line
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash('Your post has been saved.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	public function edit($id = null) {
		$this->Post->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Post->read();
		} else {
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash('Your post has been updated.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to update your post.');
			}
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}

	public function isAuthorized($user) {
		// 登録済ユーザーは投稿できる
		if ($this->action === 'add') {
			return true;
		}

		// 投稿のオーナーは編集や削除ができる
		if (in_array($this->action, array('edit', 'delete'))) {
			$postId = $this->request->params['pass'][0];
			if ($this->Post->isOwnedBy($postId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}

	/**
	 * 収支状況のメールを送信する。
	 *
	 * @param unknown_type $list
	 */
	private function _send_mail($list = null) {
		// 検索条件の設定
		$from_date = $list['Post']['from_date']['year'].'-'.$list['Post']['from_date']['month'].'-'.$list['Post']['from_date']['day'];
		$to_date = $list['Post']['to_date']['year'].'-'.$list['Post']['to_date']['month'].'-'.$list['Post']['to_date']['day'];

		App:: uses('CakeEmail', 'Network/Email');

		// 送受信者設定
		$this->uses = array('User');
		$users = $this->User->find('all');

		$to_mail = array();
		foreach ($users as $user) {
			if (!empty($user['User']['email'])) {
				array_push($to_mail, $user['User']['email']);
			}
		}

		$subject = 'ラウンジ　スペチアーレ　売上報告';

		// ヘッダーメッセージの設定
		if ($from_date == $to_date) {
			$head = $from_date.'の売上';
		} else {
			$head = $from_date.'～'.$to_date.'の売上';
		}

		// 売上合計値を取得
		$uriage = $this->_profit_tota_value($from_date, $to_date);
		// 経費合計値を取得
		$keihi = $this->_supplier_tota_value($from_date, $to_date);
		// 人件費合計値を取得
		$jinkeihi = $this->_humancost_tota_value($from_date, $to_date);
		// 偉業利益を算出
		$rieki = $uriage - ($keihi+ $jinkeihi);

		// テンプレートに送る変数
		$ary_vars = array (
				'head' => $head,
				'uriage' => number_format($uriage),
				'keihi' => number_format($keihi),
				'jinkeihi' => number_format($jinkeihi),
				'rieki' => number_format($rieki)
		);

		// 送信処理
		$email = new CakeEmail();
		$email->template('text_template', 'text_layout');
		$email->viewVars($ary_vars);
		$email->emailFormat('text');
		$email->to($to_mail);
		$email->subject($subject);
		$email->config('smtp');
		if ($email->send()) {
			$this->Session->setFlash('メールを送信しました。');
		} else {
			$this->Session->setFlash('メールを送信に失敗しました。');
		}
	}


	/**
	 * 売上の集計値を取得する。
	 * @param $from_date 検索日付_from
	 * @param $to_date 検索日付_to
	 */
	private function _profit_tota_value($from_date, $to_date) {
		$total = 0;
		/*
		 * 売上の取得
		*/
		$options = null;
		$options['fields'] = array('`Profit`.`main_item_id`, `Profit`.`item_id`, SUM(`Profit`.`total`) AS profit_total');
		$options['conditions'] = array('"'.$from_date.'" <= `Profit`.`business_day` AND "'.$to_date.'" >= `Profit`.`business_day`');
		$options['group'] = array('`Profit`.`main_item_id`, `Profit`.`item_id`');
		$options['order'] = array('`Profit`.`main_item_id`, `Profit`.`item_id`');

		$this->uses = array('Profit');
		$profits = $this->Profit->find('all', $options);

		foreach($profits as $profit) {
			$total += $profit[0]['profit_total'];
		}

		return $total;
	}

	/**
	 * 経費の集計値を返却する。
	 * @param $from_date 検索日付_from
	 * @param $to_date 検索日付_to
	 */
	private function _supplier_tota_value($from_date, $to_date) {
		$total = 0;

		/*
		 * 仕入の取得
		 */
		$options['fields'] = array('`Supplier`.`main_item_id`, `Supplier`.`item_id`, SUM(`Supplier`.`total`) AS supplier_total');
		$options['conditions'] = array('"'.$from_date.'" <= `Supplier`.`business_day` AND "'.$to_date.'" >= `Supplier`.`business_day`');
		$options['group'] = array('`Supplier`.`main_item_id`, `Supplier`.`item_id`');
		$options['order'] = array('`Supplier`.`main_item_id`, `Supplier`.`item_id`');

		$this->uses = array('Supplier');
		$suppliers =  $this->Supplier->find('all', $options);

		foreach($suppliers as $supplier) {
			$total += $supplier[0]['supplier_total'];
		}

		return $total;
	}

	/**
	 * 人件費の集計値を取得する。
	 * @param $from_date 検索日付_from
	 * @param $to_date 検索日付_to
	 */
	private function _humancost_tota_value($from_date, $to_date) {
		$total = 0;

		/*
		 * 人件費の取得
		*/
		$options = null;
		$options['fields'] = array('SUM(`HumanCost`.`salary`) AS salary ');
		$options['conditions'] = array('"'.$from_date.'" <= `HumanCost`.``business_day AND "'.$to_date.'" >= `HumanCost`.``business_day');

		$this->uses = array('HumanCost');
		$humancosts = $this->HumanCost->find('all', $options);

		foreach($humancosts as $humancost) {
			$total += $humancost[0]['salary'];
		}

		return $total;
	}
}
