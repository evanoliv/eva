<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend>Escolha a apresentação</legend>

				<form action="<?=base_url()?>planejamento/cadastrarApresentacao" method="post" id="apresentacaoForm">
					
					<input value="<?=(!empty($apresentacao->apr_id)) ? $apresentacao->apr_id : "" ?>" class="registroId" type="hidden" name="apresentacao[id]">
					<input value="<?=(!empty($evento->eve_id)) ? $evento->eve_id : "" ?>" class="registroId" type="hidden" name="apresentacao[evento]">
					
					<div class="form-group">
						<label>Atração *</label>
						<select class="formG form-control atracaoApresentacao" name="apresentacao[atracao]" required>
							<option value="">Selecione...</option>
							<?php foreach ($atracoes as $atracao):?>
								<option duracao="<?=$atracao->pro_duracao?>" value="<?=$atracao->atr_id?>" <?=(!empty($apresentacao)) ? ($atracao->atr_id == $apresentacao->apr_atr_id) ? 'selected' : '' : ''?>><?=$atracao->obj_nome?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<label>Local *</label>
						<select class="formG form-control" name="apresentacao[local]" required>
							<option value="">Selecione...</option>
							<?php foreach ($locais as $local):?>
								<option value="<?=$local->loc_id?>" <?=(!empty($apresentacao)) ? ($local->loc_id == $apresentacao->apr_loc_id) ? 'selected' : '' : ''?>><?=$local->obj_nome?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
			       		<label>Data *</label>
			       		<input min="<?=$evento->eve_data_inicial?>" max="<?=$evento->eve_data_final?>" value="<?=(!empty($apresentacao->apr_data)) ? $apresentacao->apr_data : "" ?>" class="formP form-control" type="date" name="apresentacao[data]" required>
					</div>
					<div class="form-group">
			       		<label>Hora *</label>
			       		<input value="<?=(!empty($apresentacao->apr_hora)) ? $apresentacao->apr_hora : "" ?>" class="formP form-control" type="time" name="apresentacao[hora]" required>
					</div>
					<div class="form-group">
			       		<label>Duração *</label>
			       		<input value="<?=(!empty($apresentacao->apr_duracao)) ? $apresentacao->apr_duracao : "" ?>" class="formP form-control" type="time" name="apresentacao[duracao]" required>
			       		<span id="helpBlock" class="help-block">Duração da apresentação selecionada: <div class="duracaoAtracao"></div></span>
					</div>
					<div class="form-group">
						<label>Observações</label>
						<textarea class="formText form-control" name="apresentacao[observacao]"><?=(isset($apresentacao->apr_observacao)) ? $apresentacao->apr_observacao : "" ?></textarea>
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
</div>
