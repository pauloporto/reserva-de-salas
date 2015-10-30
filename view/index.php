<?php

require("seguranca.php");
include ("../model/db_mysqli.php");

$db = new Database();


if(isset($_GET['data']))
{ $hoje =  date_create_from_format('d/m/Y',$_GET['data']); }
else
{ $hoje = new DateTime(); }


// montar o topo
$tabela_topo = '<tr> <th></th> ';

$sql = 'select * from periodo order by nome ';
$periodos = $db->query($sql);

foreach($periodos as $periodo)
{	
	$tabela_topo .= ' <th>' . $periodo['nome'] . '</th>';
}
$tabela_topo .= '</tr>';





// trazer todas as salas
$tabela_corpo = '';

$sql = 'select * from sala order by nome ';

$salas = $db->query($sql);

foreach($salas as $sala)
{
	$tabela_corpo .=' <tr><td> '. $sala['nome'] . '</td> ';
	
	
	// trazer todos os periodos
	$sql = 'select * from periodo order by nome ';

	$periodos = $db->query($sql);
	
	foreach($periodos as $periodo)
	{	
	
		$disciplina_reserva = '';
		$professores_reserva = '';

		// checar se esse periodo, nessa sala, está ocupada.
		$sql = 'select * from reserva where sala_id =  ' .$sala['id'] .' and periodo_id = '.$periodo['id'].' and dia = "'.$hoje->format("Y-m-d").'" ;';
		
		$status = $db->query($sql);
	
		
		if(isset($status[0]['id'] ))
		{ 
			if( $status[0]['status'] == 1)
			$css_ocupado = 'reservado' ;

			else if ( $status[0]['status'] == 2)
			$css_ocupado = 'confirmado' ;

			else if ( $status[0]['status'] == 3)
			$css_ocupado = 'cancelado' ;
	
			$disciplina_reserva =  $status[0]['disciplina_desc']  ;
			$professores_reserva = $status[0]['professor_desc']  ; 
			$id_reserva = $status[0]['id']  ;
			// procurar por disciplinas e professores dessa resrva

		}		
		else
		{ 
			$id_reserva = 0;
			$css_ocupado = 'disponivel' ;
		}		
		
		// if($disciplina_reserva =! '') $disciplina_reserva = '<p>' . $disciplina_reserva . '</p>';
		
		$tabela_corpo .='<td onClick="abreReserva(this)" class="'.$css_ocupado.'" id="'.$id_reserva.'" sala="'.$sala['id'].'" periodo="'.$periodo['id'].'" > '.$disciplina_reserva. '&nbsp;<hr>&nbsp;'. $professores_reserva.' </td>';
	
	}
	
	
	$tabela_corpo .=' </tr>';
	
}



// configurar dias
$dia_anterior = date_create_from_format('d/m/Y',$hoje->format("d/m/Y"));
$dia_anterior->modify('-1 day');


$dia_posterior  = date_create_from_format('d/m/Y',$hoje->format("d/m/Y"));
$dia_posterior->modify('+1 day');



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
        
		<script src="js/jquery.js"></script>
   		<script src="js/jquery.datetimepicker.full.js"></script>
        <script src="js/dateformat.js"></script>
        
        <!-- <link href="css/select2.min.css" rel="stylesheet" /> -->
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
        
		<!-- <script src="js/select2.min.js"></script> -->
  	 <script src="js/lib.js"></script>
        <script>
		
		// variavel com a data
		
		var data = '<?= $hoje->format("d/m/Y");?>';
		var dia_anterior = '<?= $dia_anterior->format("d/m/Y");?>';
		var dia_posterior = '<?= $dia_posterior->format("d/m/Y");?>';
		// configura o calendario
		
		jQuery.datetimepicker.setLocale('pt');
		
		// configura a area visivel do formulario
		
		$(window).on('scroll resize load', getVisible);
		
		
		$( window ).load(function() {
			$('#data').datetimepicker({
								  timepicker:false,
								  format:'d/m/Y'
								});

							
		});
		
		
		function atualizaTela(o)
		{
			// pegar os dados da data atual e atualziar a tela
			 window.location.href = "index.php?data="+ $(o).val();
		}
		
		function voltaTela()
		{

			 window.location.href = "index.php?data="+  dia_anterior;
			
		}
		function avancaTela()
		{
			 window.location.href = "index.php?data="+  dia_posterior;
			
		}
	
		</script>
        
      
         
         
		<title>Home</title>
	</head>
	<body>

<!-- form -->
<div class="form">

</div>


<!-- menu esquerdo -->
<? include "menu_esquerdo.php"; ?>

<!-- conteudo -->

<div class="corpo">

<div class="titulo_inicial" > 

<img src="img/voltar.png" width="40" height="40" alt="" onclick="voltaTela()"/>

<div>
<form method="get" action="index.php" target="_self" name="form1">
<input type="text" readonly="readonly" name="data" id="data" value="<?= $hoje->format("d/m/Y"); ?>" onchange="atualizaTela(this)" />
</form>
</div>


<img src="img/avancar.png" width="40" height="40" alt="" onclick="avancaTela()"/>
</div>

<table border="0" cellpadding="4" cellspacing="0">

<thead>
	
	<?= $tabela_topo ?>
    
</thead>

</table>

<div class="tabelarow">

<table border="0" cellpadding="4" cellspacing="0">

<tbody>

<?= $tabela_corpo ?>

</tbody>

</table>

</div>





</div>


	</body>
</html>

