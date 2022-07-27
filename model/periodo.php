<?php
require_once "db_mysqli.php";

class Periodo
{

	function listar()
	{
		$db = new Database();
		
		$sql = ' select * from periodo order by nome;' ;
		return $db->query($sql);
	}
	
	function abrir($id)
	{
		
		$db = new Database();
		
		$sql = ' select * from periodo where id = '. $id; ;
		return $db->query($sql);
	}
	
	function salvar($id,$nome)
	{
	
		$db = new Database();
		
		// inserir
		if($id == 0)
		{
			$sql = 'insert into periodo ( nome ) values ("'.$nome.'")';
			return $db->query_insert($sql);
		}
		else
		{ 
			// atualizar
			$sql = ' update periodo set nome = "'.$nome.'" where id = ' .$id;
			return $db->query_update($sql);

		}
	}
	
	function excluir($id)
	{
		$db = new Database();
		$sql = 'delete from periodo where id = '.$id; 
		return $db->query_update($sql);
	}
	
	
	function total()
	{
		$db = new Database();
		$sql = 'select count(id) as total from periodo  ';
		return $db->query($sql);
		
	}
}

?>