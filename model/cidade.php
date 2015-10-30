<?php

include_once("db_mysqli.php");

class Cidade{
	
	function salvar($nome){

		$db = new Database();
		return $db->query_insert("insert into cidade (nome) values ('".$nome."')");
	}

	function forma_combo(){

		$db = new Database();

		$cidades = $db->query('select * from cidade');

		$combo = "<select name=\"cidade_id\">";

		foreach($cidades as $cidade){
			$combo .="<option value=\"".$cidade['id']."\">".$cidade['nome']."</option>";
		}

		$combo .= "</select>";

		return $combo;
	}
}