<?php

namespace app\models;
use app\models\Model;

class Task extends Model 
{

	public function addTask($request)
	{
		
	 	$add = $this->db->query("INSERT INTO tasks (username, email,description) VALUES (:username, :email, :description)",
	 		['username'=>$this->xssClear($request['username']),'email'=>$this->xssClear($request['email']),
	 		'description'=>$this->xssClear($request['description'])]);
	 	if($add)
	 		$_SESSION['add_success'] = 1;
	 		header("location:/");

	}
	public function getById($request)
	{
		$show = $this->db->query("SELECT * FROM tasks WHERE id=:id",['id'=>$request]);
		return $show->fetch();
	}
	public function editTask($request)
	{
		$edit = $this->db->query("UPDATE tasks SET username=:username,email=:email,description=:description WHERE id=:id",
		 		['username'=>$this->xssClear($request['username']),'email'=>$this->xssClear($request['email']),
		 		'description'=>$this->xssClear($request['description']),'id'=>$request['id']]);
		 	if($edit){
		 		$log = $this->db->query("SELECT task_id FROM user_log WHERE task_id=:task_id",
		 			['task_id'=>$request['id']])->fetch()['task_id'];
		 		if($log != $request['id']){
		 			
		 			 $this->db->query("INSERT INTO user_log (task_id)VALUES(:task_id)",
		 				['task_id'=>$request['id']]);
		 			header("location:/");
		 		}
		 		$_SESSION['edit_success'] = 1;
		 		header("location:/");
		 	}
		 		
	}

	public function status($request)
	{
		$check = $this->db->query("SELECT task_id FROM status WHERE task_id=:task_id",
			['task_id'=>$request])->fetch();

		if($check['task_id'] == $request)
		{
			$this->db->query("DELETE FROM status WHERE task_id=:task_id",
			['task_id'=>$request]);
			header("location:/");
		}else {
			$this->db->query("INSERT INTO status (task_id)VALUES(:task_id)",['task_id'=>$request]);
			header("location:/");
		}
		
	}

	public function listTask()
	{

		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; 
		$columnIndex = $_POST['order'][0]['column'];
		$columnName = $_POST['columns'][$columnIndex]['data'];
		$columnSortOrder = $_POST['order'][0]['dir'];
		$searchValue = $_POST['search']['value'];

		$searchQuery = " ";
		if($searchValue != ''){
		   $searchQuery = " and (username like '%".$searchValue."%' or 
		        email like '%".$searchValue."%' or 
		        description like'%".$searchValue."%' ) ";
		}
	
		$sel = $this->db->query("SELECT count(*) as allcount FROM tasks",[]);
		$records = $sel->fetch();
		$totalRecords = $records['allcount'];

		$sel = $this->db->query("SELECT count(*) as allcount FROM tasks WHERE 1 ".$searchQuery,[]);
		$records = $sel->fetch();
		$totalRecordwithFilter = $records['allcount'];

		$empQuery = "SELECT * FROM tasks WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;

		$empRecords = $this->db->query($empQuery);

		$data = array();
		foreach($empRecords  as $emps)
		{
		   $data[] = array( 
		      "id"=>$emps['id'],
		      "username"=>$emps['username'],
		      "email"=>$emps['email'],
		      "description"=>$emps['description'],
		      "status"=>$this->getStatus($emps['id']),
		      "userLog"=>$this->userLog($emps['id']),
		   );
		}

		$response = array(
		  "draw" => intval($draw),
		  "iTotalRecords" => $totalRecords,
		  "iTotalDisplayRecords" => $totalRecordwithFilter,
		  "aaData" => $data
		);

		echo json_encode($response);

	}
	public  function getStatus($id)
	{
		return $this->db->query("SELECT * FROM status WHERE task_id='$id'",[])->fetch()['task_id'];
	}

	private function userLog($id)
	{
		return $this->db->query("SELECT * FROM user_log WHERE task_id='$id'",[])->fetch()['task_id'];
	}

	private function xssClear($task)
	{
		$task = strip_tags($task);
		$task = htmlentities($task, ENT_QUOTES, "UTF-8");
		$task = htmlspecialchars($task, ENT_QUOTES);
		return $task;
	}

}