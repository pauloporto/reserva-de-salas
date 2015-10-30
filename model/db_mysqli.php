<?php


class Database {
	private $link;

	function __construct(){
		$this->link = mysqli_connect("127.0.0.1", "root", "1234", "sgreserva") or die("erro: ". mysqli_connect_error());
	}

	function query($sql){

		
		mysqli_query($this->link, "SET NAMES utf8");
		$result = mysqli_query($this->link, $sql)or die(mysqli_error($this->link));

		$array_result = array();

			
			//colocar as informações em array
			while($row = mysqli_fetch_array($result))
			{
				$array_result[] = $row;
			}
	
			// se retorna apenas uma linha, 
			
			/*if(sizeof($array_result) == 1)
			$array_result = $array_result[0];
	*/
		
		return $array_result;
	}

	function query_insert($sql){

		mysqli_query($this->link, "SET NAMES utf8");
		mysqli_query($this->link,  $sql)or die(mysqli_error($this->link));

		return mysqli_insert_id($this->link);
	}
	
	function query_update($sql){

		mysqli_query($this->link, "SET NAMES utf8");
		mysqli_query($this->link,  $sql)or die(mysqli_error($this->link));

	}
	
}
?>