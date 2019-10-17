<?php

class Database{
	
	private $connection;

	function __construct()
	{
		$this->connect_db();
	}

	public function connect_db(){
		$this->connection = mysqli_connect('localhost', 'root', '', 'ruben');
		if(mysqli_connect_error()){
			die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
		}
	}

	public function create($subject,$class){
		
		$sql = "INSERT INTO `subject` (subject_name, class_id) VALUES ('$subject','$class')";

		$res = mysqli_query($this->connection, $sql);
		if($res){
         header('Location:view.php');
		}else{
			return false;
		}
	}
    public function create_class($class){
		$sql = "INSERT INTO `class` (class_name) VALUES ('$class')";
		$res = mysqli_query($this->connection, $sql);
		if($res){
         header('Location:class.php');
		}else{
			return false;
		}
	}
	public function read($id=null){
		$sql = "SELECT * FROM `subject`";
		if($id){ $sql .= " WHERE subject_id=$id";}
 		$res = mysqli_query($this->connection, $sql);

 		return $res;
	}
	public function reads($id=null){
  
		$sql = "SELECT subject.subject_name,subject.subject_id,class.class_name  FROM subject INNER JOIN class ON subject.class_id = class.class_id";
	    $data = array();
 		$res = mysqli_query($this->connection, $sql);
        
 		while($r = mysqli_fetch_assoc($res)){
 			$data[] = array('subject_name' => $r['subject_name'],'class' => $r['class_name']);
 		}
 		echo json_encode($data);
 	exit;
 		return $res;
	}
	public function read_class($id=null){
		$sql = "SELECT * FROM `class`";
		if($id){ $sql .= " WHERE class_id=$id";}
 		$res = mysqli_query($this->connection, $sql);
 		return $res;
	}
	public function update_class($class,$id) {
		$sql = "UPDATE `class` SET class_name='$class' WHERE class_id=$id";
		$res = mysqli_query($this->connection, $sql);
		if($res){
			return true;
		}else{
			return false;
		}
	}


	public function update($subject,$class,$id){
		$sql = "UPDATE `subject` SET subject_name='$subject', class_id='$class' WHERE subject_id=$id";
		$res = mysqli_query($this->connection, $sql);
		if($res){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){
		$sql = "DELETE FROM `subject` WHERE subject_id=$id";
 		$res = mysqli_query($this->connection, $sql);
 		if($res){
 			return true;
 		}else{
 			return false;
 		}
	}
	public function delete_class($id){
		$sql = "DELETE FROM `class` WHERE class_id=$id";
 		$res = mysqli_query($this->connection, $sql);
 		if($res){
 			return true;
 		}else{
 			return false;
 		}
	}
	public function check_login($user_name, $password){
        $user_exists = $this->check_user_is_exist($user_name);
        if(!$user_exists) return ['status' => false, 'message' => "User doesn't exists"];
        $password = md5($password);
		$query = "SELECT id from login WHERE user_name='$user_name' and password='$password'";
		$result = $this->connection->query($query) or die($this->connection->error);
		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		$count_row = $result->num_rows;
		
		if ($count_row == 1) {
	        $_SESSION['login'] = true; // this login var will use for the session thing
	        $_SESSION['id'] = $user_data['id'];
	      	return ['status' => true, 'message' => "Logged in successfully"];
	    }
		else{ 
			return  ['status' => false, 'message' => "provided credentials doesn't match"] ;
		}
		
	}
	private function check_user_is_exist($user_name){
		$query = "SELECT id from login WHERE user_name='$user_name'";
		$result = $this->connection->query($query) or die($this->connection->error);
		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		$count_row = $result->num_rows;
		return $count_row  ? true : false;
	}
	
	public function get_fullname($uid){
		$query = "SELECT user_name FROM login WHERE id = $uid";
		
		$result = $this->connection->query($query) or die($this->connection->error);
		
		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		echo $user_data['user_name'];
		
	}
	
	/*** starting the session ***/
	public function get_session(){
	    return $_SESSION['login'];
	    }
	public function user_logout() {
		session_unset();
		unset($_SESSION['login']);
	    session_destroy();
	}

	public function sanitize($var){
		$return = mysqli_real_escape_string($this->connection, $var);
		return $return;
	}

}

$database = new Database();

?>