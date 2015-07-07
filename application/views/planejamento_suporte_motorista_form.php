<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<form action="<?=base_url()?>planejamento/cadastrarMotorista" method="post" id="motoristaForm">
				
				<input value="<?=(!empty($motorista->mot_id)) ? $motorista->mot_id : "" ?>" class="registroId" type="hidden" name="motorista[id]">
				
				<legend>Informações sobre o motorista</legend>
								
				<div class="form-group">
					<label>Nome *</label>
					<input value="<?=(!empty($motorista->mot_nome)) ? $motorista->mot_nome : "" ?>" class="formG form-control" type="text" name="motorista[nome]" maxlength="255" required>
				</div>
				<div class="form-group">
		       		<label>E-mail</label>
		       		<input value="<?=(!empty($motorista->mot_email)) ? $motorista->mot_email : "" ?>" class="formG form-control" type="email" maxlength="255" name="motorista[email]">
				</div>				
				<div class="form-group">
		       		<label>Telefone fixo</label>
		       		<input value="<?=(!empty($motorista->mot_telefone)) ? $motorista->mot_telefone : "" ?>" class="formP formCel form-control" type="tel" name="motorista[telefone]">
				</div>
				<div class="form-group">
		       		<label>Celular 1 *</label>
		       		<input value="<?=(!empty($motorista->mot_celular1)) ? $motorista->mot_celular1 : "" ?>" class="formP formCel form-control" type="tel" name="motorista[celular1]" required>
				</div>
				<div class="form-group">
		       		<label>Celular 2</label>
		       		<input value="<?=(!empty($motorista->mot_celular2)) ? $motorista->mot_celular2 : "" ?>" class="formP formCel form-control" type="tel" name="motorista[celular2]">
				</div>
				<br>
				<input type="submit" value="Enviar" class="btn btn-success">
					
			</form>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>