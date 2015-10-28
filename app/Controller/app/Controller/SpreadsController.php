<?php
App::uses('AppController', 'Controller');
/**
 * Spreads Controller
 *
 * @property Spread $Spread
 */
class SpreadsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Spread->recursive = 0;
		if ($this->request->is('post')) {
			$this->_spreadsUpdate($this->request->data);
		} else {
			$this->_delete_spread_value();
		}
		$this->set('spreads',  $this->Spread->find('all', array('order' => 'Spread.main_item_id, Spread.item_id')));
	}

	/**
	 * 仕入、売上、人経費の集計値を取得する。
	 * @param $list 検索日付 FROM TO
	 */
	private function _spreadsUpdate($list = null) {

		// 検索条件の設定
		$from_date = $list['Spread']['from_date']['year'].'-'.$list['Spread']['from_date']['month'].'-'.$list['Spread']['from_date']['day'];
		$to_date = $list['Spread']['to_date']['year'].'-'.$list['Spread']['to_date']['month'].'-'.$list['Spread']['to_date']['day'];

		/*
		 * 仕入の取得
		 */
		$options['fields'] = array('`Supplier`.`business_day`, `Supplier`.`main_item_id`, `Supplier`.`main_item_name`,
						`Supplier`.`item_id`, `Supplier`.`item_name`, SUM(`Supplier`.`item_count`) AS supplier_count, SUM(`Supplier`.`total`) AS supplier_total');
		$options['conditions'] = array('"'.$from_date.'" <= `Supplier`.`business_day` AND "'.$to_date.'" >= `Supplier`.`business_day`');
		$options['group'] = array('`Supplier`.`main_item_id`, `Supplier`.`item_id`');
		$options['order'] = array('`Supplier`.`main_item_id`, `Supplier`.`item_id`');

		$this->uses = array('Supplier');
		$supplier =  $this->Supplier->find('all', $options);

		// 集計表の更新
		$this->_update_spread_supplier($supplier);

		/*
		 * 売上の取得
		 */
		$options = null;
		$options['fields'] = array('`Profit`.`business_day`, `Profit`.`main_item_id`, `Profit`.`main_item_name`,
				`Profit`.`item_id`, `Profit`.`item_name`, SUM(`Profit`.`item_count`) AS profit_count, SUM(`Profit`.`total`) AS profit_total');
		$options['conditions'] = array('"'.$from_date.'" <= `Profit`.`business_day` AND "'.$to_date.'" >= `Profit`.`business_day`');
		$options['group'] = array('`Profit`.`main_item_id`, `Profit`.`item_id`');
		$options['order'] = array('`Profit`.`main_item_id`, `Profit`.`item_id`');

		$this->uses = array('Profit');
		$profit = $this->Profit->find('all', $options);

		// 集計表の更新
		$this->_update_spread_profit($profit);

		/*
		 * 人経費の取得
		 */
		$options = null;
		$options['fields'] = array('SUM(`HumanCost`.`salary`) AS salary ');
		$options['conditions'] = array('"'.$from_date.'" <= `HumanCost`.``business_day AND "'.$to_date.'" >= `HumanCost`.``business_day');

		$this->uses = array('HumanCost');
		$profit = $this->HumanCost->find('all', $options);

		// 人経費の合計をセット
		$salary = $profit[0][0]['salary'];
		$this->set('salary', $salary);
	}

	/**
	 * 集計表の合計値を初期化する。
	 */
	private function _delete_spread_value() {
		$ret = $this->Spread->query('UPDATE spread SET supplier_count = null, supplier_total = null, profit_count = null, profit_total = null');
		if ($ret === false) {
			$this->Session->setFlash(__('集計表の更新に失敗しました。'));
		}
	}

	/**
	 * 仕入の合計値を集計表に更新する
	 *
	 * @param $supplier 仕入リスト
	 */
	private function _update_spread_supplier($supplier) {
		$update_data = array(); // 更新用配列
		$cnt = 0;               // カウント

		$list = $this->Spread->find('all', array('order' => 'Spread.main_item_id, Spread.item_id'));
		foreach ($list as $data) {
			// 仕入の集計値をセット
			if ((isset($supplier[$cnt]['Supplier']['main_item_id']) && $data['Spread']['main_item_id'] == $supplier[$cnt]['Supplier']['main_item_id'])
					&& (isset($supplier[$cnt]['Supplier']['item_id']) && $data['Spread']['item_id'] == $supplier[$cnt]['Supplier']['item_id'])) {
				// 仕入数量をセット
				$data['Spread']['supplier_count'] = $supplier[$cnt][0]['supplier_count'];
				// 仕入合計をセット
				$data['Spread']['supplier_total'] = $supplier[$cnt][0]['supplier_total'];
				// カウントアップ
				$cnt++;
			}
			// 更新用配列に集計値をセット
			array_push($update_data, $data);
		}
		// 集計表の更新
		$this->Spread->saveAll($update_data);
	}


	/**
	 * 売上の合計値を集計表に更新する
	 *
	 * @param $profit 売上リスト
	 */
	private function _update_spread_profit($profit) {
		$update_data = array(); // 更新用配列
		$cnt = 0;               // カウント

		$list = $this->Spread->find('all', array('order' => 'Spread.main_item_id, Spread.item_id'));
		foreach ($list as $data) {
			// 売上の集計値をセット
			if ((isset($profit[$cnt]['Profit']['main_item_id']) && $data['Spread']['main_item_id'] == $profit[$cnt]['Profit']['main_item_id'])
					&& (isset($profit[$cnt]['Profit']['item_id']) && $data['Spread']['item_id'] == $profit[$cnt]['Profit']['item_id'])) {
				// 仕入数量をセット
				$data['Spread']['profit_count'] = $profit[$cnt][0]['profit_count'];
				// 仕入合計をセット
				$data['Spread']['profit_total'] = $profit[$cnt][0]['profit_total'];
				// カウントアップ
				$cnt++;
			}
			// 更新用配列に集計値をセット
			array_push($update_data, $data);
		}
		// 集計表の更新
		$this->Spread->saveAll($update_data);
	}
}
