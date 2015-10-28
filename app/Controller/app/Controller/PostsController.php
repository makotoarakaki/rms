<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class PostsController extends AppController {

	public $helpers = array('Html', 'Form');

    public function index() {
		if ($this->request->is('post')) {
			$this->_send_mail($this->request->data);
		}
    	$this->set('posts', $this->Post->find('all'));
        $this->set('posts', $this->paginate());

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
		// 人経費合計値を取得
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
		 * 人経費の取得
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
