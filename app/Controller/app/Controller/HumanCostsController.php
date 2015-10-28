<?php
App::uses('AppController', 'Controller');
/**
 * HumanCosts Controller
 *
 * @property HumanCost $HumanCost
 */
class HumanCostsController extends AppController {


	/**
	 *使用モデルの設定
	 *
	 */
	public $uses = array('HumanCost', 'Staff');

/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {

		$this->HumanCost->id = $id;

		$options['fields'] = array('Staff.name AS name', 'Staff.hourly_wage AS hourly_wage',
				'HumanCost.id AS id', 'HumanCost.staff_id AS staff_id',
				'HumanCost.business_day AS business_day', 'HumanCost.time AS time', 'HumanCost.salary AS salary',
				'HumanCost.designate AS designate', 'HumanCost.created AS created', 'HumanCost.modified AS modified');
		$options['joins'][] = array('type'=>'LEFT', 'table'=>'staff', 'alias'=>'Staff',
				'conditions'=>'HumanCost.staff_id = Staff.id');
		$options['conditions'] = array('staff_id' => $id);
		$options['order'] = array('HumanCost.business_day desc');
		$result =  $this->HumanCost->find('all', $options);

		$this->set('humanCosts', $result, $this->paginate());
		$this->set('staff', $this->Staff->read(null, $id));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->HumanCost->id = $id;
		if (!$this->HumanCost->exists()) {
			throw new NotFoundException(__('無効です。'));
		}
		$this->set('humanCost', $this->HumanCost->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
		$this->HumanCost->id = $id;
		$info = $this->Staff->read(null, $id);

		$salary = 0; // 給料用変数
		if ($this->request->is('post')) {
			$this->HumanCost->create();

			// 給料を設定
			$salary = $info['Staff']['hourly_wage'] * $this->request->data['HumanCost']['time'];
			$this->request->data['HumanCost']['salary'] = $salary;

			if ($this->HumanCost->save($this->request->data)) {
				$this->Session->setFlash(__('人経費が保存されました。'));
				$this->redirect(array('action' => 'index'.'/'.$id));
			} else {
				$this->Session->setFlash(__('人経費は保存されませんでした。もう一度やり直して下さい。'));
			}
		}
		$this->set('staff', $info);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->HumanCost->id = $id;
		$info = $this->HumanCost->read(null, $id);

		if (!$this->HumanCost->exists()) {
			throw new NotFoundException(__('無効です。'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->HumanCost->save($this->request->data)) {
				$this->Session->setFlash(__('人経費が保存されました。'));
				$staff_id = $this->request['data']['HumanCost']['staff_id'];
				$this->redirect(array('action' => 'index', $staff_id));
			} else {
				$this->Session->setFlash(__('人経費は保存されませんでした。もう一度やり直して下さい。'));
			}
		} else {
			$this->request->data = $info;
		}
		$this->set('humanCost', $info);
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
		$this->HumanCost->id = $id;
		if (!$this->HumanCost->exists()) {
			throw new NotFoundException(__('無効です。'));
		}
		if ($this->HumanCost->delete()) {
			$this->Session->setFlash(__('人経費が削除されました。'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('人経費は削除されませんでした。'));
		$this->redirect(array('action' => 'index'));
	}
}
