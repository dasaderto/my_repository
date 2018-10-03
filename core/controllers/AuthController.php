<?php
require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");
$auth=new AuthController;
 /*Отвечает за работу с AuthModel
Содержит методы для работы с AuthModel 
Вход выход тест логина через AJAX*/

class AuthController
{
	public $authobj;
	public $adminobj;

	public function __construct()
	{
		$this->authobj= new AuthModel;
		$this->adminobj=new AdminModel;
		$this->adminMethod();
	}

	public function adminMethod()
	{
		if (isset($_POST['reg_login'])) $this->AjaxRegistration();
		if (isset($_POST['authlogin'])) $this->AjaxAuth();
		if (isset($_POST['out'])) $this->AjaxLogout();
		if (isset($_POST['login'])) $this->AjaxTestLogin();
	}

	public function AjaxRegistration()
	{
		$reg_login=htmlspecialchars(trim($_POST['reg_login']));
		$reg_password=htmlspecialchars(trim($_POST['reg_password']));
		$role=htmlspecialchars(trim($_POST['role']));
		$password2=htmlspecialchars(trim($_POST['password2']));
		if ($role == 'Студент'){$role = 1;}elseif ($role == 'Учитель'){$role = 2;}else{$role = 3;}
		if (($reg_password===$password2)&&(preg_match('/^[A-Za-z0-9 ]{3,20}$/i',$reg_login))&&(preg_match("/^[\da-zA-Z0-9_]{6,20}$/",$reg_password))){
			$returnUser=$this->authobj->Registration($reg_login,$reg_password,$role);
			if ($returnUser==false) {
				$result=array('cant'=>'absolutlyNO');
            	echo json_encode($result);
			}else{
				$result=array('can'=>'absolutlyYES');
	            echo json_encode($result);
		}
		}else{
			$result=array('cant'=>'absolutlyNO');
            	echo json_encode($result);
		}

	}
	public function AjaxAuth()
	{
		$username = trim(htmlspecialchars(($_POST['authlogin'])));
    	$password = trim(htmlspecialchars(($_POST['pass'])));

		$returnUser=$this->authobj->Login($username,$password);
		echo $returnUser;
	}

	public function AjaxLogout()
	{
		$exitAuth=$this->authobj->exitAuth();
		$this->adminobj->reloadLocation();
		return $exitAuth;
	}

	public function AjaxTestLogin()
	{
		$log_to_test=htmlspecialchars($_POST['login']);
		$rolework=htmlspecialchars($_POST['rolework']);
		if (isset($_POST['rolework'])) {
			$havelog=$this->authobj->testlogin($log_to_test,$rolework);
		}else{
		$havelog=$this->authobj->testlogin($log_to_test);
		}

		echo $havelog;
	}

}

?>
