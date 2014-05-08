<?php
class controller{
	public function get_route($route){
		$routes = explode('/',$route);
		
		// Comprobamos si el controlador al que llamamos es una clase (si existe)
		try {
			$class = new ReflectionClass($routes[0]."_controller");
		} catch (Exception $e) {
			echo "No existe la clase ".$routes[0]."_controller";
			return false;
		}
		
		// Comprobamos si realmente es un controlador (es decir, si su padre es controller)
		if ($class->getParentClass()->name == 'controller'){
			// Comprobamos si la clase $class contiene un metodo con el nombre que hemos llamado
			try {
				$method = $class->getMethod($routes[1]);
			} catch (Exception $e) {
				echo "No existe el metodo ".$routes[1];
				return false;
			}
			
			// Creamos una nueva instancia de la clase
			$instance = $class->newInstance();

			// Quitamos el nombré del controlador y del método del array $routes
			array_shift($routes);
			array_shift($routes);

			// Invocamos al método que pertenece al objeto $instance y con los parametros que quedan en $routes
			$method->invoke($instance,$routes);
		} else {
			return false;
		}
	}
	
	public function logging_needed(){
		if (!isset($_SESSION['login'])){
			header("Location: ".SITE_ROOT);
			exit;
		}
	}
}
?>