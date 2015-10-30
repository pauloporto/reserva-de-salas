<?
include ("db_mysqli.php");

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
	
}

?>