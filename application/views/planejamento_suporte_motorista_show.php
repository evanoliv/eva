<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
			
			<legend>Informações sobre o motorista</legend>
							
			<div class="form-group">
				<label>Nome</label>
				<span id="helpBlock" class="help-block"><?=(!empty($motorista->mot_nome)) ? $motorista->mot_nome : "<br><br>" ?></span>
			</div>
			<div class="form-group">
	       		<label>E-mail</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($motorista->mot_email)) ? $motorista->mot_email : "<br><br>" ?></span>
			</div>				
			<div class="form-group">
	       		<label>Telefone fixo</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($motorista->mot_telefone)) ? format_show($motorista->mot_telefone) : "<br><br>" ?></span>
			</div>
			<div class="form-group">
	       		<label>Celular 1</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($motorista->mot_celular1)) ? format_show($motorista->mot_celular1) : "<br><br>" ?></span>
			</div>
			<div class="form-group">
	       		<label>Celular 2</label>
	       		<span id="helpBlock" class="help-block"><?=(!empty($motorista->mot_celular2)) ? format_show($motorista->mot_celular2) : "<br><br>" ?></span>
			</div>
			<br>
			
			<a href="<?=base_url()?>planejamento/editarMotorista/<?=$motorista->mot_id?>" class="btn btn-success">Editar</a>
			<a href="<?=base_url()?>planejamento/excluirMotorista/<?=$motorista->mot_id?>" class="btn btn-danger excluirRegistro">Excluir</a>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>