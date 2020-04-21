<?php

namespace app\controller;

use app\controller\Controller;

class LoginController extends Controller
{

	public function loginAction()
	{
		$this->view->render('Логин');
		$this->model->login($_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : []);
	}

	public function logoutAction()
	{
		session_destroy();
		
		header("location: /");
	}
}