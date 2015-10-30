<?

require "../model/reserva.php";



class ReservaController{
	

	function abrirController($id)
	{
		
		$reserva = new Reserva();
		
		return $reserva->abrir($id);
		
		
	}

	
}
?>