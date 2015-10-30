<?

require '../controller/reserva_controller.php';

$reserva = new ReservaController();


if(isset($_GET['id']) && is_numeric($_GET['id']))
{

$row = $reserva->abrirController($_GET['id']);


extract($row);


//1 reservada, 2 confirmada, 3 cancelada 
$a_options_status = array("Reservado", "Confirmado","Cancelado");
$val = 1;
$options_status = '';
foreach($a_options_status as $opt_stat)
{
	if($status == $val)$selected = ' selected="selected" '; else $selected= '';
	$options_status .= "<option value=\"$val\" $selected>$opt_stat</option>";
	$val++;
}


?>
<form name="reserva">

<h3> Reserva</h3>

<input type="text" placeholder="dia" name="dia" id="dia" value="<?= $dia ?>"><BR>

<input type="text" placeholder="Professor" name="professor_txt" id="professor_txt" value="<?= $professor_desc ?>" ><BR>

<input type="text" placeholder="Disciplina" name="disciplina_txt" id="disciplina_txt" value="<?= $disciplina_desc ?>"><BR>

<input type="text" placeholder="Obsrvação" name="observacao" id="observacao" value="<?= $observacao ?>" ><BR>

<select name="status" id="status" ><?= $options_status; ?></select><BR>


<input type="button" name="Fechar" value="Fechar" onClick="fecharForm()" class="btn1">
<input type="button" name="Excluir" value="Excluir" class="btn1">
<input type="button" name="Salvar" value="Salvar" class="btn2">
</form>
<?

}

?>