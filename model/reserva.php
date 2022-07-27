<?php
require_once "db_mysqli.php";

class Reserva
{
 
function abrir($id){
	
	$db = new Database();
	
	$sql = ' select 
		a.id
		,a.sala_id
		,c.nome as sala
		,a.periodo_id
		,b.nome as periodo
		,a.professor_desc
		,a.disciplina_desc
		,a.status
		,a.observacao
		,date_format(a.dia,"%d/%m/%Y") as dia
		
			
	 from reserva a
	 
	 inner join periodo b on
	 a.periodo_id = b.id
	 
	 inner join sala c on
	 a.sala_id = c.id
	 
	 where a.id = '.$id;
	 
	 return $db->query($sql);

	}	
	
	
	
	function verificar($data, $sala,$periodo)
	{
		
	$db = new Database();
	
	$sql = ' select 
	a.id
			
	 from reserva a
	 
	 where a.sala_id =  '.$sala .'
	 and a.periodo_id = '.$periodo.'
	 and dia = "'.$data->format("Y-m-d").'"; '; 
	
	 return $db->query($sql);

	}
	
	
	function verificarCompleto($data, $sala,$periodo)
	{
		$db = new Database();
		
		$sql = 'select * from reserva where sala_id =  ' .$sala .' and periodo_id = '.$periodo.' and dia = "'.$data->format("Y-m-d").'" ;';
		return $db->query($sql);
	}
	
	function excluir($id)
	{
		$db = new Database();
	
		$sql = ' delete from reserva where id =' . $id;
		
		$db->query_update($sql);
		return 0;
		
	}
	
	function salvar($id,$dia,$professor,$disciplina,$data,$observacao,$status,$sala,$periodo)
	{
	
		$db = new Database();
			
		// atualizar
		if($id >0)
		{
			$sql = 'update reserva set
			dia = "'.$data->format("Y-m-d").'"
			,professor_desc = "'.$professor.'"
			,disciplina_desc = "'.$disciplina.'"
			,observacao = "'.$observacao.'"
			,status = '.$status.'
			
			where id  =	' . $id;
			
			$db->query_update($sql);
			return $id;
		
		}
		// salvar novo registro
		else 
		{
			$sql = '
			
			INSERT INTO reserva
			(
			 sala_id
			 ,periodo_id
			 ,dia
			 ,professor_desc
			 ,disciplina_desc
			 ,status
			 ,observacao
			)
			VALUES
			(
			 
			  '.$sala.' -- sala_id - INT(11) NOT NULL
			 ,'.$periodo.' -- periodo_id - INT(11) NOT NULL
			 ,"'.$data->format("Y-m-d").'" -- dia - DATE NOT NULL
			 ,"'.$professor.'" -- professor_desc - VARCHAR(255)
			 ,"'.$disciplina.'" -- disciplina_desc - VARCHAR(255)
			 ,'.$status.' -- status - INT(11) NOT NULL
			 ,"'.$observacao.'" -- observacao - TEXT
			) ';
			
			return $db->query_insert($sql);
			
		}

	}
	
	
	function disciplinaMaisReservas()
	{
	
	$db = new Database();
	
	$sql = '

	select
	
	 disciplina_desc
	,count(id) as total
	
	from reserva
	
	group by disciplina_desc
	order by total desc
';
	
	
	return $db->query($sql);
	
	}
	
	
	function totalReservasMes($hoje)
	{
		$db = new Database();
		
		$sql = '  
		
		select count(id) as total from reserva where month(dia) = '.$hoje->format("m").';';
		return $db->query($sql);
	
	}
}

?>