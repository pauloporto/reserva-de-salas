<?

require("seguranca.php");
include ("../model/db_mysqli.php");

$db = new Database();

// Disciplina que mais reserva
$sql = '

select

 disciplina_desc
,count(id) as total

from reserva

group by disciplina_desc
order by total desc
';

$row1 = $db->query($sql);

$tabela = '';
foreach($row1 as $row)
{
	$tabela .= '<tr>
	<td></td>
	<td width="300">'.$row['disciplina_desc'].' </td>
	<td>'.$row['total'].' </td>
	
		</tr>';
	
}


// calculo da taxa de ocupação

// Total de salas * total de horarios * 30 dias
$sql = 'select count(id) as total from sala  ';
$salas = $db->query($sql);

$sql = 'select count(id) as total from periodo  ';
$periodos = $db->query($sql);

$total_horarios = $salas[0]['total']  *  $periodos[0]['total'] * 30  ;

$hoje = new DateTime();
$sql = '  

select count(id) as total from reserva where month(dia) = '.$hoje->format("m").';';
$reservas = $db->query($sql);

$total_reservas = $reservas[0]['total'];

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
     
     </head>
     <title>Relatorios</title>
     <body>
     



<!-- menu esquerdo -->
<? include "menu_esquerdo.php"; ?>

<!-- conteudo -->

<div class="corpo">

<h3> Total de reservas por disciplina </h3>


<table class="lista_comum" cellpadding="4" cellspacing="4">

<tr>
<th></th>
<th width="300"> Nome </th>
<th > Total</th>

</tr>

<?= $tabela?>


</table>


<h3> Taxa de ocupação das salas </h3>
<div id="chart_div"></div>

 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Ocupado', <?= $total_reservas ?>],
          ['Desocupado',  <?= $total_horarios ?>],
        ]);

        // Set chart options
        var options = {'title':'Taxa de ocupação da saça',
                       'width':500,
                       'height':500};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>





</div>



</body>
</html>
