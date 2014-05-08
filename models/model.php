<?php
class model {
	public function db_connect(){
		$db = new mysqli(DB_HOST,DB_USER,DB_PSSW,DB_NAME);
		
		if($db->connect_errno){
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		return $db;
	}
	
	public function db_close($db){
		return $db->close();
	}
	
	public function get($id, $field = '*'){
		$db = $this->db_connect();
		
		$class = get_class($this);
		
		$sql = 'SELECT '.$field.' FROM '.$class.' WHERE id='.$id;
		$result = $db->query($sql);
		$this->db_close($db);
		
		while($row = $result->fetch_assoc()){
			if ($field != "*"){
				return $row[$field];
			} else {
				return $row;
			}
		}
	}
	
	public function get_all($field = '*'){
		$db = $this->db_connect();
		
		$class = get_class($this);
		
		$sql = 'SELECT '.$field.' FROM '.$class;
		$result = $db->query($sql);
		$this->db_close($db);
		
		$rows = array();
		while($row = $result->fetch_assoc()){
			if ($field != "*"){
				$rows[] = $row[$field];
			} else {
				$rows[] = $row;
			}
		}
		
		return $rows;
	}
	
	public function get_by($field,$value){
		$db = $this->db_connect();
		
		$class = get_class($this);
		
		$sql = 'SELECT * FROM '.$class.' WHERE '.$field.'="'.$value.'"';
		$result = $db->query($sql);
		$this->db_close($db);
		
		$rows = array();
		while($row = $result->fetch_assoc()){
			$rows[] = $row;
		}
		
		if (count($rows)==1){
			return $rows[0];
		} else if (count($rows)>1){
			return $rows;
		} else {
			return false;
		}
	}
	
	public function set($id, $fields, $values){
		if (count($fields)==count($values)){
			$db = $this->db_connect();
			
			$class = get_class($this);
			$set_string = "";
			for ($i=0; $i<count($fields); $i++){
				if ($i!=0) {
					$set_string.=',';
				}
				
				$set_string.=$fields[$i].'='.$values[$i];
			}
			
			$sql = 'UPDATE '.$class.' SET '.$set_string.' WHERE id='.$id;
			$result = $db->query($sql);
			$this->db_close($db);
			
			return $result;
		} else {
			return false;
		}
	}
	
	public function create($fields, $values){
		if (count($fields)==count($values)){
			$db = $this->db_connect();
		
			$class = get_class($this);
//			$class_fields = TODO;
			$fields_string = "";
			$values_string = "";
/*			
			foreach ($fields as $field){
				if (!in_array($field, $class_fields)){
					return false;
				}
			}
*/			
			for ($i=0; $i<count($fields); $i++){
				if ($i!=0) {
					$fields_string.=',';
					$values_string.=',';
				}
				
				$fields_string.=$fields[$i];
				$values_string.="'".$values[$i]."'";
			}
			
//			$this->validate();
			
			$sql = 'INSERT INTO '.$class.' ('.$fields_string.') VALUES ('.$values_string.')';
			$result = $db->query($sql);
			$this->db_close($db);
			
			return $result;
		} else {
			return false;
		}
	}

}
?>