<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<form action="<?=base_url()?>planejamento/cadastrarAcomodacao" method="post" id="acomodacaoForm">
				
				<input value="<?=(!empty($acomodacao->aco_id)) ? $acomodacao->aco_id : "" ?>" class="registroId" type="hidden" name="acomodacao[id]">
				
				<legend>Informações sobre a acomodação</legend>
								
				<div class="form-group">
					<label>Atração *</label>
					<select class="formG form-control" name="acomodacao[atracao]" required>
						<option value="">Selecione...</option>
						<?php foreach ($atracoes as $atracao):?>
							<option value="<?=$atracao->atr_id?>" <?=(!empty($acomodacao)) ? ($atracao->atr_id == $acomodacao->aco_atr_id) ? 'selected' : '' : ''?>><?=$atracao->obj_nome?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<label>Hospedaria *</label>
					<select class="formG form-control" name="acomodacao[hospedagem]" required>
						<option value="">Selecione...</option>
						<?php foreach ($hospedagens as $hospedagem):?>
							<option value="<?=$hospedagem->hos_id?>" <?=(!empty($acomodacao)) ? ($hospedagem->hos_id == $acomodacao->aco_hos_id) ? 'selected' : '' : ''?>><?=$hospedagem->hos_nome?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
		       		<label>Chegada na hospedaria</label>
		       		<input value="<?=(!empty($acomodacao->aco_chegada)) ? format_datetime($acomodacao->aco_chegada) : "" ?>" class="formG form-control timestampInput" type="datetime-local" maxlength="255" name="acomodacao[chegada]">
				</div>				
				<div class="form-group">
		       		<label>Saída da hospedaria</label>
		       		<input value="<?=(!empty($acomodacao->aco_saida)) ? format_datetime($acomodacao->aco_saida) : "" ?>" class="formG form-control timestampInput" type="datetime-local" maxlength="255" name="acomodacao[saida]">
				</div>				
				<div class="form-group">
		       		<label>Quantidade de almoços</label>
		       		<input value="<?=(!empty($acomodacao->aco_almoco)) ? $acomodacao->aco_almoco : "" ?>" class="formP form-control" type="number" maxlength="255" name="acomodacao[almoco]">
				</div>				
				<div class="form-group">
		       		<label>Quantidade de jantas</label>
		       		<input value="<?=(!empty($acomodacao->aco_janta)) ? $acomodacao->aco_janta : "" ?>" class="formP form-control" type="number" maxlength="255" name="acomodacao[janta]">
				</div>				
				<div class="form-group">
		       		<label>Quantidade de caterings</label>
		       		<input value="<?=(!empty($acomodacao->aco_catering)) ? $acomodacao->aco_catering : "" ?>" class="formP form-control" type="number" maxlength="255" name="acomodacao[catering]">
				</div>	
				<div class="form-group">
					<label>Observações</label>
					<textarea class="formText form-control" name="acomodacao[observacao]"><?=(isset($acomodacao->aco_observacao)) ? $acomodacao->aco_observacao : "" ?></textarea>
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