<?php

namespace app\models;
use app\models\Model;

class Login extends Model 
{

	public function login($request)
	{
        $check = $this->db->query("SELECT id,login,password FROM `users` WHERE login=:login",['login'=>$request['login']]);

        $checkLogin = $check->fetch();

        if(password_verify($request['password'],$checkLogin['password'])){
         
            session_regenerate_id();
            $_SESSION['id'] = $checkEmail['id'];
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $request['login'];
			$_SESSION['auth_n'] = 1;
            header("location: /");
        }
        
	}
}	