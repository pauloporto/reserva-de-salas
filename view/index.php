<?php

require("seguranca.php");
include ("../model/db_mysqli.php");

$db = new Database();


if(isset($_POST['data']))
{ $hoje =  date_create_from_format('d/m/Y',$_POST['data']); }
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
		if($status['id'] != '' )
		{ 
			
			$css_ocupado = 'ocupado' ;
			
			$disciplina_reserva =  $status['disciplina_desc']  ;
			$professores_reserva = $status['professor_desc']  ; 
			$id_reserva = $status['id']  ;
			// procurar por disciplinas e professores dessa resrva
						
	
		
		}		
		else
		{ 
			$id_reserva = 0;
			$css_ocupado = 'disponivel' ;
		
		}		
		
		// if($disciplina_reserva =! '') $disciplina_reserva = '<p>' . $disciplina_reserva . '</p>';
		
		$tabela_corpo .='<td onClick="abreReserva(this)" class="'.$css_ocupado.'" id='.$id_reserva.'> '.$disciplina_reserva. '&nbsp;<hr>&nbsp;'. $professores_reserva.' </td>';
	
	}
	
	
	$tabela_corpo .=' </tr>';
	
}






?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        

        
		<script src="js/jquery.js"></script>
   		<script src="js/jquery.datetimepicker.full.js"></script>
        
        <!-- <link href="css/select2.min.css" rel="stylesheet" /> -->
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
        
		<!-- <script src="js/select2.min.js"></script> -->

        <script>
		
		jQuery.datetimepicker.setLocale('pt');
		
		$(window).on('scroll resize load', getVisible);
		
		function getVisible()
		{
			// configurar a altura da div para nao dar scroll
			$(".tabelarow").css("height",$(window).height() - "130");
			
		}
		
		
		function abreReserva(o)
		{
			
		//abre o formulario por AJAX preenchido
			
				$.ajax({
				type: "GET",
				url: "reserva_form.php",
				method: "GET",
				data: "id=" + $(o).attr("id") ,
				dataType  : 'html',
				success: function(response) {
					
					$(".corpo").css("max-width","max-width:calc(100% - 510px)");
					
					 
						$('.form').show("fast","",function(){ 
							
							$('.form').html(response);
							
							jQuery('#dia').datetimepicker({
							  timepicker:false,
							  format:'d/m/Y'
							});

	
						 });

					}
				});
	
			
		}

	function fecharForm()
	{
		$('.form').hide("fast","",function(){     
			
			$(".corpo").css("max-width","max-width:calc(100% - 180px)");
		
		});
		
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

<div class="titulo_inicial" > <img src="img/voltar.png" width="40" height="40" alt=""/> <?= $hoje->format("d/m/Y"); ?> <img src="img/avancar.png" width="40" height="40" alt=""/></div>

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

