<?php

require "util.php";
require "../model/periodo.php";

class periodoController
{
	
	function salvar()
	{
		if(isset($_POST['salvar']))
		{
			$nome = Util::clearparam($_POST['nome']);
			$id = Util::clearparam($_POST['id']);

			$periodo = new Periodo();
			$periodo->salvar($id,$nome);
			header("Location: periodo_list.php");
			exit();
		}
	}
	
	function excluir()
	{
		
		if(isset($_POST['excluir']))
		{
			$id = Util::clearparam($_POST['id']);
			
			$periodo = new Periodo();
			$periodo->excluir($id);
		
			header("Location: periodo_list.php");
			exit();
				
		}

	}
	
	function abrir()
	{
		
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$periodo = new Periodo();
			return $periodo->abrir( $_GET['id']);
		}	
		
	}

	// listagem
	function listarcontroller()
	{
		
		$periodo = new Periodo();
		
		$linhas = $periodo->listar();
		
		$tabela = '';
		foreach($linhas as $linha)
		{
			$tabela .= '<tr>
							<td>'.$linha['id'].'</td>
							<td><a href="periodo_form.php?id='.$linha['id'].'">'.$linha['nome'].'</a></td>
						</tr>		
							';
		}
		
		return $tabela;
	}
	
}

?>