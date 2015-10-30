<?php
require_once($cfg->fileroot."model/cidade.php");



class Cidade_controller {

	function __construct(){}

	function salvar($post){

		if(isset($post['nome'])){
			//filtrando parâmetro
			$nome = Geral::clear_par($post['nome']);

			$model = new Cidade();

			return $model->salvar($nome);


		}
	}

	function get_combo(){
		$model = new Cidade();

		return $model->forma_combo();
	}
}

?>