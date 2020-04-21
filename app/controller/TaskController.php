<?php

namespace app\controller;

use app\controller\Controller;

class TaskController extends Controller {

	public function addAction()
	{
		$this->view->render('Task');		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
			$this->model->addTask($_POST);
	}

	public function editAction()
	{
		if (!isset($_SESSION['loggedin'])){
			header("location:/");
		}
		$this->view->render('Task',['task'=>$this->model->getById($_GET['id'])]);
		if($_SERVER['REQUEST_METHOD'] === 'POST')
			$this->model->editTask($_POST);
	}
	public function statusAction()
	{
		$this->model->status($_GET['id']);
	}

	public function listAction()
	{
		$this->model->listTask();
	} 

}