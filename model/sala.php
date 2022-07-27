<?php
require_once "db_mysqli.php";

class sala
{
 
	function listar()
	{
		
		$db = new Database();
		
		$sql = ' select * from sala order by nome;' ;
		return $db->query($sql);
	}
	
	function abrir($id)
	{
		
		$db = new Database();
		
		$sql = ' select * from sala where id = '. $id; ;
		return $db->query($sql);
	}
	
	function salvar($id,$nome)
	{
	
		$db = new Database();
		
		// inserir
		if($id == 0)
		{
			$sql = 'insert into sala ( nome ) values ("'.$nome.'")';
			return $db->query_insert($sql);
		}
		else
		{ 
			// atualizar
			$sql = ' update sala set nome = "'.$nome.'" where id = ' .$id;
			return $db->query_update($sql);

		}

	}
	
	function excluir($id)
	{
		$db = new Database();
		$sql = 'delete from sala where id = '.$id; 
		return $db->query_update($sql);
	}
	
	function total()
	{
		$db = new Database();
		$sql = 'select count(id) as total from sala  ';
		return $db->query($sql);
		
	}
	
}

?>