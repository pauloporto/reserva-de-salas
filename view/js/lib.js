

	function getVisible()
	{
		// configurar a altura da div para nao dar scroll
		$(".tabelarow").css("height",window.innerHeight - 120);
		$(".form").css("height",window.innerHeight - 30);
		
		
	}
		
		
	function abreReserva(o)
	{
		// limpa o CSS das outras tabelas
		$(".corpo td").css("background-color", ""); 
		// o item selecionado fica verde.
		$(o).css("background-color", "#CAF4D5"); 
	//abre o formulario por AJAX preenchido
	$.ajax({
		type: "GET",
		url: "reserva_form.php",
		method: "GET",
		data: "id=" + $(o).attr("id")+"&data=" + data +"&sala_id="+$(o).attr("sala")+"&periodo_id="+$(o).attr("periodo"),
		dataType  : 'html',
		success: function(response) {
					
			$(".corpo").css("max-width","calc(100% - 510px)");

			$('.form').show("fast","",function(){ 
							
			$('.form').html(response);
							
			$('#dia').datetimepicker({
				  timepicker:false,
				  format:'d/m/Y'
			});
							
			$('#data_final').datetimepicker({
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
			$(".corpo").css("max-width","calc(100% - 180px)");
		});
	}

	
	var salvando = false;
	
	function salvaFormularioReserva()
	{

	// pegar todos os dados do formulario
	if(salvando === true)
		return false; 
		
	salvando = true;
	
	$.ajax({
    type: "POST",
    url: 'reserva_form.php',
	method: "POST",
    data: $("#frm_reserva").serialize(),
    success: function(response) {
	  
          // recarregar pagina no dia atual.
		  if($.isNumeric(response))
		  window.location.href = "index.php?data="+ data;
		  else
		  {
		 	alert(response);
			salvando = false;
		  }
		 }
	});
	
	return false;		
			
	}
	
	
	function excluirFormularioReserva(id)
	{
		
		if(confirm("Excluir reserva?"))
		{

			$.ajax({
			type: "POST",
			url: 'reserva_excluir.php',
			method: "POST",
			data: "id=" + id ,
			success: function(response) {
				  // recarregar pagina no dia atual.
				  if($.isNumeric(response))
				  window.location.href = "index.php?data="+ data;
				  else
					alert(response)
				 }
			});

		}
	}

	function abre(url)
	{
		window.location.href = url;
	}
	