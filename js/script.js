$(document).ready(function(){

	//privacidade do objeto
	$('.privacidadeObjeto input').change(function(){
		if($(this).val() == 0)
			$('.textoPrivacidade').html('Somente você poderá acessar este objeto.<br><br>');
		if($(this).val() == 1)
			$('.textoPrivacidade').html('As informações sobre o objeto serão visíveis a todos que acessam o Sistema EVA.<br><br>');
		if($(this).val() == 2)
			$('.textoPrivacidade').html('Somente o tipo, nome e release serão visíveis no Sistema EVA.<br>Ao inscrever o objeto em um evento, o organizador deste poderá visualizar as demais informações.');
	});
	
	if($('.privacidadeObjeto input:checked').val() == 0)
		$('.textoPrivacidade').html('Somente você poderá acessar este objeto.<br><br>');
	if($('.privacidadeObjeto input:checked').val() == 1)
		$('.textoPrivacidade').html('As informações sobre o objeto serão visíveis a todos que acessam o Sistema EVA.<br><br>');
	if($('.privacidadeObjeto input:checked').val() == 2)
		$('.textoPrivacidade').html('Somente o tipo, nome e release serão visíveis no Sistema EVA.<br>Ao inscrever o objeto em um evento, o organizador deste poderá visualizar as demais informações.');
	
	//filtro das atividades
	$('#tipo_filtro').change(function(){
		$('.filtroAtividade').hide();
		$('.filtro'+$(this).val()).show();
	});
	
	//cor das tarefas
	$.each($('.corSituacaoTarefa'),function(){
		if($(this).html() == 'Executando')
			$(this).css('color','orange');
		if($(this).html() == 'Concluída')
			$(this).css('color','blue');
		if($(this).html() == 'Aprovada')
			$(this).css('color','green');
	});
		
	$.each($('.corPrioridadeTarefa'),function(){
		if($(this).html() == 'Alta')
			$(this).css('color','orange');
		if($(this).html() == 'Urgente')
			$(this).css('color','red');
	});
	
	$.each($('.corDataTarefa'),function(){

		var data = $(this).html().split('/');
		data_tarefa = new Date(data[2], data[1] - 1, data[0]);
		data_hoje = new Date();
		data_tres_dias = new Date(new Date().setDate(new Date().getDate()+3));
		
		if(data_tarefa <= data_tres_dias)
			$(this).css('color','orange');
		
		if(data_tarefa <= data_hoje)
			$(this).css('color','red');
	
	});
	
	//ajax do endereço do evento
	$('#selectOrigem').change(function(){
		var tipo = $('#selectOrigem option:selected').attr('tipo');
		if($(this).val() != ''){
			$.ajax({
				url: base_url+'planejamento/carregaEndereco/'+tipo+'/'+$(this).val(),
				success: function(data) {
					$('#enderecoOrigem').text(data);
				}
			});
		}
	});

	//ajax do endereço do evento
	$('#selectDestino').change(function(){
		var tipo = $('#selectDestino option:selected').attr('tipo');
		if($(this).val() != ''){
			$.ajax({
				url: base_url+'planejamento/carregaEndereco/'+tipo+'/'+$(this).val(),
				success: function(data) {
					$('#enderecoDestino').text(data);
				}
			});
		}
	});
	
	//validação da data do evento
	$('#definicaoForm').submit(function(){
		if($('.dataInicial').val() > $('.dataFinal').val()){
			alert('Data de realização inválida!');
			return false;
		}
	});
	
	//duracao da apresentacao
	$('.atracaoApresentacao').change(function(){
		if($(this).val())
			$('.duracaoAtracao').html($('.atracaoApresentacao option:selected').attr('duracao'));
		else
			$('.duracaoAtracao').html('');
	});
	
	//design responsivo
	$('#menu-lateral').addClass('col-md-2 col-xs-12');
	$('#conteudo').addClass('col-md-7 col-xs-12');
	$('#roteiro').addClass('col-md-3 col-xs-12');
	
	//roteiro 
	$('#roteiro').perfectScrollbar(); 
	
	//exibe/esconde roteiro ao clicar no botao
	$('.sessao-logado .glyphicon-leaf').click(function(){
		if($('#roteiro').css('display') == 'none'){
			$('#conteudo').removeClass('col-md-10');
			$('#conteudo').addClass('col-md-7');
			$('#roteiro').slideDown();
		} else {
			$('#roteiro').slideUp(function(){
				$('#conteudo').removeClass('col-md-7');
				$('#conteudo').addClass('col-md-10');	
			});
		}
	})
	
	//exibe/esconde roteiro ao abrir a página
	if($('#roteiro_ativo').html() == '1'){
		$('#conteudo').removeClass('col-md-10');
		$('#conteudo').addClass('col-md-7');
	} else {
		$('#conteudo').removeClass('col-md-7');
		$('#conteudo').addClass('col-md-10');	
	}

	//menu ativo
	$($("#item_menu_ativo").html()).addClass("active");
	
	//confirmação de senha
	$('#form_cadastro').submit(function(){
		if($('#senha').val() != $('#confirma_senha').val()){
			alert("Confirmação da senha está incorreta.");
			return false;
		}
	});
	
	//nao pode colar a senha
	$("#confirma_senha").bind('paste', function (e){
		e.preventDefault();
    });
	
	//msg de erro
	if($('.msg_erro').html() == "")
		$('.msg_erro').css('display','none');
	else
		$('.msg_erro').css('display','block');

	//msg de sucesso
	if($('.msg_sucesso').html() == "")
		$('.msg_sucesso').css('display','none');
	else
		$('.msg_sucesso').css('display','block');
	
	//validações de formulários
	$('.formTel').mask('(00) 0000-0000');
	$('.formCel').mask('(00) 00000-0000');
	$('.formCep').mask('00000-000');
	$('.formValor').mask("#.##0,00", {reverse: true});
	$('.formTempo').mask('00:00');
	
	//campos mobile
    var isMobile = window.matchMedia("only screen and (max-width: 760px)");

    if (isMobile.matches) {
    	$('.formData').mask('00/00/0000');
    }
	
	$('#objetoForm').submit(function(){

		if($('.formObjResumo').val().length < 100){
			alert('O release deve conter pelo menos 100 caracteres!');
			return false;
		}
		
	});
	
	//confirma exclusao de registros
	$('.excluirRegistro').click(function(){
		if (!confirm("Tem certeza que deseja excluir este registro?"))
			return false;
	});
	
	//tipos de objetos
	$('.produto_cultural').css('display','none');
	$('.equipamento_cultural').css('display','none');
	
	$('#tipo_objeto').change(function(){
		
		if($(this).val() == ''){
			
			$('.produto_cultural').slideUp();
			$('.equipamento_cultural').slideUp();
			
			$.each($('.produto_cultural input'),function(){
				$(this).prop('required','');
			});
						
			$.each($('.equipamento_cultural input'),function(){
				$(this).prop('required','');
			});
			
		}else if(($(this).val() == '1') || ($(this).val() == '2')){
			
			if($(this).val() == '1')
				$('.tipoObjeto').html('Evento');
			else
				$('.tipoObjeto').html('Produto');
			
			$('.equipamento_cultural').slideUp(function(){
				$('.produto_cultural').slideDown();	
			});
			
			$.each($('.produto_cultural input'),function(){
				$(this).prop('required','required');
			});
						
			$.each($('.equipamento_cultural input'),function(){
				$(this).prop('required','');
			});
			
		}else if($(this).val() == '3'){
			
			$('.produto_cultural').slideUp(function(){
				$('.equipamento_cultural').slideDown();
			});
			
			$.each($('.equipamento_cultural input'),function(){
				$(this).prop('required','required');
			});
			$('.formObjComplemento').prop('required','');

			$.each($('.produto_cultural input'),function(){
				$(this).prop('required','');
			});

		}
		
		if($(this).val() != ''){
		
			$.ajax({
				url: base_url+'objeto/carregaSubtipo/'+$(this).val(),
				success: function(data) {
					$('#subtipo_objeto').html(data);
					$('#subsubtipo_objeto').html('<option value="">Selecione...</option>');
				}
			});
			
		} else {
			
			$('#subtipo_objeto').html('<option value="">Selecione...</option>');
			$('#subsubtipo_objeto').html('<option value="">Selecione...</option>');
			
		}
			
	});
	
	$('#subtipo_objeto').change(function(){
		
		if($(this).val() != ''){
			
			$.ajax({
				url: base_url+'objeto/carregaSubsubtipo/'+$(this).val(),
				success: function(data) {
					$('#subsubtipo_objeto').html(data);
				}
			});
			
		} else 
			$('#subsubtipo_objeto').html('<option value="">Selecione...</option>');
		
	});
	
	if(($('#tipo_objeto').val() == '1') || ($('#tipo_objeto').val() == '2')){
		
		if($('#tipo_objeto').val() == '1')
			$('.tipoObjeto').html('Evento');
		else
			$('.tipoObjeto').html('Produto');
		
		$('.equipamento_cultural').slideUp(function(){
			$('.produto_cultural').slideDown();	
		});
		
		$.each($('.produto_cultural input'),function(){
			$(this).prop('required','required');
		});
					
		$.each($('.equipamento_cultural input'),function(){
			$(this).prop('required','');
		});
		
	}else if($('#tipo_objeto').val() == '3'){
		
		$('.produto_cultural').slideUp(function(){
			$('.equipamento_cultural').slideDown();
		});
		
		$.each($('.equipamento_cultural input'),function(){
			$(this).prop('required','required');
		});
		$('.formObjComplemento').prop('required','');

		$.each($('.produto_cultural input'),function(){
			$(this).prop('required','');
		});

	}
	
	//função para pegar o endereço
	$('.formCep').blur(function(){
		$('.inputCep img').show();
		var cep = $(this).val().replace('-','');
		$.get("http://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep },
        function(result){

			$('.inputCep img').hide();

			if( result.status != 1 ){
				alert(result.message || "Houve um erro desconhecido");
				$('.formNumero').focus();
				return;
            }
		
            $(".formEndereco").val(result.address);
            $(".formBairro").val(result.district);
            $(".formSpanCidade").html(result.city);
            $(".formCidade").val(result.city);
            $(".formSpanEstado").html(result.state);
            $(".formEstado").val(result.state);
            
         });
		
	});
	
});
