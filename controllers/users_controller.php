<?php
class users_controller extends controller {
	public function view(){
		$User = new users;
		$this->logging_needed();
		
		include('/views/users/view.php');
	}
	
	public function login(){
		$User = new users;
		
		if (isset($_POST['name']) && isset($_POST['password']) && !empty($_POST['name']) && !empty($_POST['password'])){
			$user = $User->get_by('name',$_POST['name']);
			if (isset($user['password'])){
				if ($user['password'] == $_POST['password']){
					echo "LOGGING!";
					$_SESSION['login'] = $_POST['name'];
					header("Location: ".SITE_ROOT."/index.php/users/view");
					exit;
				} else {
					$error = "Contraseña incorrecta";
				}
			} else {
				$error = "No existe el usuario";
			}
		} else {
			$error = "Debe escribir el nombre de usuario y contraseña";
		}
		
		$_SESSION['error'] = $error;
		header("Location: ".SITE_ROOT);
		exit;
	}
	
	public function logout(){
		unset($_SESSION['login']);
		header("Location: ".SITE_ROOT);
		exit;
	}
	
	public function register(){
		$User = new users;
		
		if (isset($_POST['name']) && isset($_POST['password']) && !empty($_POST['name']) && !empty($_POST['password'])){
			if ($_POST['password'] == $_POST['repeat_password']){
				$User->create(array('name','password'),array($_POST['name'],$_POST['password']));
				header("Location: ".SITE_ROOT);
				exit;
			} else {
				$error = "La contraseña no coincide";
			}
		} else {
			$error = "Debe escribir un nombre de usuario y contraseña";
		}
		
		$_SESSION['error'] = $error;
		header("Location: ".SITE_ROOT."fdfd");
		exit;
	}
}
?>