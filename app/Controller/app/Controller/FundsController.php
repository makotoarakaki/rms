<?php
App::uses('AppController', 'Controller');
/**
 * Funds Controller
 *
 * @property Fund $Fund
 */
class FundsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is('post')) {
			$this->_fund_update();
		}
		$this->Fund->recursive = 0;
		$this->set('funds', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Fund->id = $id;
		if (!$this->Fund->exists()) {
			throw new NotFoundException(__('無効な予算。'));
		}
		$this->set('fund', $this->Fund->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Fund->create();
			if ($this->Fund->save($this->request->data)) {
				$this->Session->setFlash(__('予算が保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('予算は保存されませんでした。もう一度やり直して下さい。'));
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
		$this->Fund->id = $id;
		if (!$this->Fund->exists()) {
			throw new NotFoundException(__('無効な予算。'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Fund->save($this->request->data)) {
				$this->Session->setFlash(__('予算が保存されました。'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('予算は保存されませんでした。もう一度やり直して下さい。'));
			}
		} else {
			$this->request->data = $this->Fund->read(null, $id);
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
		$this->Fund->id = $id;
		if (!$this->Fund->exists()) {
			throw new NotFoundException(__('無効な予算。'));
		}
		if ($this->Fund->delete()) {
			$this->Session->setFlash(__('予算が削除されました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('予算は削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}

	private function _fund_update() {
		// 更新日を取得
		$rec = $this->Fund->find('first', null);
		// 資産テーブルの更新日付
		$modified = date('Y-m-d', strtotime($rec['Fund']['modified']));
		// 現在日付
		$today = date('Y-m-d');

		if ($modified != $today) {
			/*
			 * 仕入の合計を取得
			 */
			$options['fields'] = array('SUM(`Supplier`.`total`) AS total ');
			$options['conditions'] = array('"'.$modified.'" <= `Supplier`.``business_day AND "'.$today.'" >= `Supplier`.``business_day');

			$this->uses = array('Supplier');
			$supplier = $this->Supplier->find('all', $options);
			$supplier_total = $supplier[0][0]['total']; // 合計をセット


			/*
			 * 売上の合計を取得
			*/
			$options = null;
			$options['fields'] = array('SUM(`Profit`.`total`) AS total ');
			$options['conditions'] = array('"'.$modified.'" <= `Profit`.``business_day AND "'.$today.'" >= `Profit`.``business_day');

			$this->uses = array('Profit');
			$profit = $this->Profit->find('all', $options);
			$profit_total = $profit[0][0]['total']; // 合計をセット

			/*
			 * 人経費の取得
			 */
			$options = null;
			$options['fields'] = array('SUM(`HumanCost`.`salary`) AS salary ');
			$options['conditions'] = array('"'.$modified.'" <= `HumanCost`.``business_day AND "'.$today.'" >= `HumanCost`.``business_day');

			$this->uses = array('HumanCost');
			$human_cost = $this->HumanCost->find('all', $options);
			$salary = $human_cost[0][0]['salary']; // 合計をセット

			$calc = $profit_total - ($supplier_total + $salary);

			$rec['Fund']['fund'] = $rec['Fund']['fund'] + $calc;
			$rec['Fund']['modified'] = date('Y-m-d H:i:s');
			$this->Fund->saveAll($rec);
		}
	}
}
