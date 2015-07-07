<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<form action="<?=base_url()?>iniciacao/alterarPapel" method="post" id="papelForm">
				
				<input value="<?=$papel->pap_id?>" class="registroId" type="hidden" name="papel[id]">
				
				<?=imprimeMsg()?>
			
				<legend>Editar papel</legend>
								
				<div class="form-group">
					<label>Membro</label>
					<span id="helpBlock" class="help-block"><?=$papel->usu_nome?></span>
				</div>
				<div class="form-group">
					<label>Cargo *</label>
					<select class="formG form-control" name="papel[cargo]" required>
						<option value="">Selecione...</option>
						<option value="Coordenação Geral" <?=(!empty($papel)) ? ($papel->pap_cargo == 'Coordenação Geral') ? 'selected' : '' : ''?>>Coordenação Geral</option>
						<option value="Coordenação de Produção" <?=(!empty($papel)) ? ($papel->pap_cargo == 'Coordenação de Produção') ? 'selected' : '' : ''?>>Coordenação de Produção</option>
						<option value="Coordenação Administrativa e Financeira" <?=(!empty($papel)) ? ($papel->pap_cargo == 'Coordenação Administrativa e Financeira') ? 'selected' : '' : ''?>>Coordenação Administrativa e Financeira</option>
						<option value="Coordenação de Programação" <?=(!empty($papel)) ? ($papel->pap_cargo == 'Coordenação de Programação') ? 'selected' : '' : ''?>>Coordenação de Programação</option>
						<option value="Coordenação de Comunicação" <?=(!empty($papel)) ? ($papel->pap_cargo == 'Coordenação de Comunicação') ? 'selected' : '' : ''?>>Coordenação de Comunicação</option>
						<option value="Coordenação de Recursos Humanos" <?=(!empty($papel)) ? ($papel->pap_cargo == 'Coordenação de Recursos Humanos') ? 'selected' : '' : ''?>>Coordenação de Recursos Humanos</option>
						<option value="Produção" <?=(!empty($papel)) ? ($papel->pap_cargo == 'Produção') ? 'selected' : '' : ''?>>Produção</option>
					</select>
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