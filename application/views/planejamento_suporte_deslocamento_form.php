<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend>Deslocamento</legend>

				<form action="<?=base_url()?>planejamento/cadastrarDeslocamento" method="post" id="deslocamentoForm">
					
					<input value="<?=(!empty($deslocamento->des_id)) ? $deslocamento->des_id : "" ?>" class="registroId" type="hidden" name="deslocamento[id]">
					
					<div class="form-group">
						<label>Atração *</label>
						<select class="formG form-control" name="deslocamento[atracao]" required>
							<option value="">Selecione...</option>
							<?php foreach ($atracoes as $atracao):?>
								<option value="<?=$atracao->atr_id?>" <?=(!empty($deslocamento)) ? ($atracao->atr_id == $deslocamento->des_atr_id) ? 'selected' : '' : ''?>><?=$atracao->obj_nome?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<label>Motorista *</label>
						<select class="formG form-control" name="deslocamento[motorista]" required>
							<option value="">Selecione...</option>
							<?php foreach ($motoristas as $motorista):?>
								<option value="<?=$motorista->mot_id?>" <?=(!empty($deslocamento)) ? ($motorista->mot_id == $deslocamento->des_mot_id) ? 'selected' : '' : ''?>><?=$motorista->mot_nome?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<label>Veículo *</label>
						<select class="formG form-control" name="deslocamento[veiculo]" required>
							<option value="">Selecione...</option>
							<?php foreach ($veiculos as $veiculo):?>
								<option value="<?=$veiculo->vei_id?>" <?=(!empty($deslocamento)) ? ($veiculo->vei_id == $deslocamento->des_vei_id) ? 'selected' : '' : ''?>><?=$veiculo->vei_modelo?> - <?=$veiculo->vei_cor?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
		       			<label>Saída *</label>
		       			<input value="<?=(!empty($deslocamento->des_saida)) ? format_datetime($deslocamento->des_saida) : "" ?>" class="formG form-control timestampInput" type="datetime-local" maxlength="255" name="deslocamento[saida]" required>
					</div>				
					<div class="form-group">
		       			<label>Chegada *</label>
		       			<input value="<?=(!empty($deslocamento->des_chegada)) ? format_datetime($deslocamento->des_chegada) : "" ?>" class="formG form-control timestampInput" type="datetime-local" maxlength="255" name="deslocamento[chegada]" required>
					</div>
					<div class="form-group">
						<label>Endereço de origem *</label>
						<select class="formG form-control" id="selectOrigem">
							<option value="">Selecione...</option>
							<optgroup label="Locais">
							<?php foreach ($locais as $local):?>
								<option tipo="local" value="<?=$local->loc_id?>"><?=$local->obj_nome?></option>
							<?php endforeach;?>
							</optgroup>
							<optgroup label="Hospedarias">
							<?php foreach ($hospedagens as $hospedagem):?>
								<option tipo="hospedagem" value="<?=$hospedagem->hos_id?>"><?=$hospedagem->hos_nome?></option>
							<?php endforeach;?>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<label></label>
						<textarea class="formText form-control" name="deslocamento[origem]" id="enderecoOrigem" required><?=(isset($deslocamento->des_origem)) ? $deslocamento->des_origem : "" ?></textarea>
						<span id="helpBlock" class="help-block">Selecione um local do evento ou digite o endereço completo.</span>					
					</div>
					<div class="form-group">
						<label>Endereço de destino *</label>
						<select class="formG form-control" id="selectDestino"> 
							<option value="">Selecione...</option>
							<optgroup label="Locais">
							<?php foreach ($locais as $local):?>
								<option tipo="local" value="<?=$local->loc_id?>"><?=$local->obj_nome?></option>
							<?php endforeach;?>
							</optgroup>
							<optgroup label="Hospedarias">
							<?php foreach ($hospedagens as $hospedagem):?>
								<option tipo="hospedagem" value="<?=$hospedagem->hos_id?>"><?=$hospedagem->hos_nome?></option>
							<?php endforeach;?>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<label></label>
						<textarea class="formText form-control" name="deslocamento[destino]" id="enderecoDestino" required><?=(isset($deslocamento->des_destino)) ? $deslocamento->des_destino : "" ?></textarea>
						<span id="helpBlock" class="help-block">Selecione um local do evento ou digite o endereço completo.</span>
					</div>
					<div class="form-group">
						<label>Observações</label>
						<textarea class="formText form-control" name="deslocamento[observacao]"><?=(isset($deslocamento->des_observacao)) ? $deslocamento->des_observacao : "" ?></textarea>
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
