<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
			
			<legend>Informações sobre a hospedaria</legend>
							
			<div class="form-group">
				<label>Nome</label>
				<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_nome)) ? $hospedagem->hos_nome : "<br><br>" ?></span>
			</div>
			<div class="form-group">
				<label>Descrição</label>
				<span id="helpBlock" class="help-block"><?=(isset($hospedagem->hos_descricao)) ? nl2br($hospedagem->hos_descricao) : "<br><br>" ?></span>
			</div>				
			<div class="form-group">
	       		<label>Hospedagem solidária?</label>
	       		<span id="helpBlock" class="help-block"><?=(isset($hospedagem->hos_solidaria)) ? ($hospedagem->hos_solidaria == '1') ? 'Sim' : 'Não' : '<br><br>'?></span>
			</div>
			<div class="form-group">
	       		<label>Lugares</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_lugares)) ? $hospedagem->hos_lugares : "<br><br>" ?></span>
			</div>
			<div class="form-group">
	       		<label>E-mail</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_email)) ? $hospedagem->hos_email : "<br><br>" ?></span>
			</div>				
			<div class="form-group">
	       		<label>Telefone fixo</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_telefone)) ? format_show($hospedagem->hos_telefone) : "<br><br>" ?></span>
			</div>
			<div class="form-group">
	       		<label>Celular 1</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_celular1)) ? format_show($hospedagem->hos_celular1) : "<br><br>" ?></span>
			</div>
			<div class="form-group">
	       		<label>Celular 2</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_celular2)) ? format_show($hospedagem->hos_celular2) : "<br><br>" ?></span>
			</div>

			<legend>Endereço</legend>
	
			<div class="form-group">
				<label>CEP</label>
				<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_cep)) ? $hospedagem->hos_cep : "<br><br>" ?></span>					
			</div>
			<div class="form-group">
				<label>Endereço</label>
				<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_endereco)) ? $hospedagem->hos_endereco : "<br><br>" ?></span>
			</div>
			<div class="form-group">
				<label>Número *</label>
				<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_numero)) ? $hospedagem->hos_numero : "<br><br>" ?></span>
			</div>
			<div class="form-group">
				<label>Complemento</label>
				<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_complemento)) ? $hospedagem->hos_complemento : "<br><br>" ?></span>
			</div>
			<div class="form-group">
				<label>Bairro</label>
				<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_bairro)) ? $hospedagem->hos_bairro : "<br><br>" ?></span>
			</div>
			<div class="form-group">
				<label>Cidade/Estado</label>
				<span id="helpBlock" class="help-block"><?=(!empty($hospedagem->hos_cidade)) ? $hospedagem->hos_cidade : "" ?>/<?=(!empty($hospedagem->hos_estado)) ? $hospedagem->hos_estado : "<br><br>" ?></span>
			</div>
			<br>
			
			<a href="<?=base_url()?>planejamento/editarHospedagem/<?=$hospedagem->hos_id?>" class="btn btn-success">Editar</a>
			<a href="<?=base_url()?>planejamento/excluirHospedagem/<?=$hospedagem->hos_id?>" class="btn btn-danger excluirRegistro">Excluir</a>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>