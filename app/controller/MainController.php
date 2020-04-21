<?php

namespace app\controller;

use app\controller\Controller;

class MainController extends Controller {

	public function indexAction() {
		
		$vars = [
			'news' => ['a'=>1],
		];
		$this->view->render('Главная страница', $vars);
	}

}