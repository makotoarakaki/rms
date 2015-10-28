<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 */
class UsersController extends AppController {

// app/Controller/UsersController.php
/*
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add'); // ユーザーに自身で登録させる
	}
*/
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('無効なユーザー'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('ユーザーが保存されました。'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('ユーザーの保存がされませんでした。もう一度試してください。'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('ユーザーが保存されました。'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('ユーザーの保存がされませんでした。もう一度試してください。'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('無効なユーザー'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('ユーザーを削除しました。'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('ユーザーは削除されませんでした。'));
        $this->redirect(array('action' => 'index'));
    }

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('ユーザー名またはパスワードが違います'));
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}
