<?php
class pages_controller extends controller {
	public function main(){
		include('/views/pages/main.php');
	}
	
	public function register(){
		include('/views/pages/register.php');
	}
}
?>