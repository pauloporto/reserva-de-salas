<?php

require "util.php";
require "../model/periodo.php";
require "../model/sala.php";
require "../model/reserva.php";

class dashboardController{
	
	// function que gera o dashboard da index.
	function gerarTopoController()
	{	
	
		$periodo = new Periodo();
	
		// montar o topo
		$tabela_topo = '<tr> <th></th> ';
		
		$periodos = $periodo->listar();
		
		foreach($periodos as $periodo)
		{	
			$tabela_topo .= ' <th>' . $periodo['nome'] . '</th>';
		}
		$tabela_topo .= '</tr>';

	return $tabela_topo;
	
	}
	
	// gerar o corpo da index
	function gerarCorpoController($hoje)
	{	
	
		
	$sl = new sala();
	$per = new Periodo();
	$res = new Reserva();

	$tabela_corpo = '';

	$salas =  $sl->listar();

	// para cada sala
	foreach($salas as $sala)
	{
		$tabela_corpo .=' <tr><td> '. $sala['nome'] . '</td> ';

		// para cada periodo
		$periodos = $per->listar();
		
		foreach($periodos as $periodo)
		{	
		
			$disciplina_reserva = '';
			$professores_reserva = '';
	
			// checar se esse periodo, nessa sala, nesse dia,  está ocupada.
			
			$status = $res->verificarCompleto($hoje,$sala['id'],$periodo['id']);
			
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

return $tabela_corpo;
}


	// relatorio de disciplina com mais reservas

	function disciplinaMaisReservasController()
	{
		$res = new Reserva();
	
		$row1 = $res->disciplinaMaisReservas();
	
		$tabela = '';
		foreach($row1 as $row)
		{
			$tabela .= '<tr>
			<td></td>
			<td width="300">'.$row['disciplina_desc'].' </td>
			<td>'.$row['total'].' </td>
			
				</tr>';
		}
	
	return $tabela ;	
	}
	
	
	function totalHorariosController()
	{
		
		$total_horarios = 0;
		
		$sala = new sala();
		$periodo = new Periodo();
			
		
		// Total de salas * total de horarios * 30 dias
		$salas = $sala->total();
		$periodos = $periodo->total();
		
		$total_horarios = $salas[0]['total']  *  $periodos[0]['total'] * 30  ;
		return $total_horarios;

	}
	
	
	function totalReservasController()
	{
		$reserva = new Reserva();
		
		$hoje = new DateTime();
		
		$reservas = $reserva->totalReservasMes($hoje);
		
		$total_reservas = $reservas[0]['total'];
		
		return $total_reservas;

	}
	
}

?>