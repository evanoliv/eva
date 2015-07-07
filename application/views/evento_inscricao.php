<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend>Inscreva-se no evento</legend>

				<?php if(!empty($produtos)):?>
			
					<form action="<?=base_url()?>evento/cadastrarAtracao" method="post" id="atracaoForm">
						
						<input value="<?=(!empty($atracao->atr_id)) ? $atracao->atr_id : "" ?>" class="registroId" type="hidden" name="atracao[id]">
						<input value="<?=(!empty($evento->eve_id)) ? $evento->eve_id : "" ?>" class="registroId" type="hidden" name="atracao[evento]">
						
						<div class="form-group">
							<label>Produto</label>
							<select class="formG form-control" name="atracao[produto]" required>
								<option value="">Selecione...</option>
								<?php foreach ($produtos as $produto):?>
									<option value="<?=$produto->pro_id?>" <?=(!empty($atracao)) ? ($atracao->atr_pro_id == $produto->pro_id) ? 'selected' : '' : ''?>><?=$produto->obj_nome?></option>
								<?php endforeach;?>
							</select>
							<span id="helpBlock" class="help-block">Selecione a atração que deseja inscrever para este evento.<br>Atenção: não é possível inscrever objetos privados!</span>
						</div>
						<div class="form-group">
				       		<label>Meio de transporte</label>
					     	<div style="padding-left: 190px;">
				       			<input type="radio" name="atracao[transporte]" value="0" <?=(isset($atracao->atr_transporte)) ? ($atracao->atr_transporte == '0') ? 'checked' : '' : 'checked'?>> Carro próprio, com ressarcimento do custo com combustível<br>
				       			<input type="radio" name="atracao[transporte]" value="1" <?=(isset($atracao->atr_transporte)) ? ($atracao->atr_transporte == '1') ? 'checked' : '' : ''?>> Carro do evento <br>
				       			<input type="radio" name="atracao[transporte]" value="2" <?=(isset($atracao->atr_transporte)) ? ($atracao->atr_transporte == '2') ? 'checked' : '' : ''?>> Rodoviário, com ressarcimento do custo da passagem 
			       			</div>
						</div>
						<div class="form-group">
				       		<label>Possui restrição alimentar?</label>
				       		<input type="checkbox" name="atracao[alimentacao]" <?=(isset($atracao->atr_alimentacao)) ? ($atracao->atr_alimentacao == '1') ? 'checked' : '' : ''?>> Sim 
				       		<span id="helpBlock" class="help-block textoPrivacidade">Especifique no campo observações</span>
						</div>
						<div class="form-group">
				       		<label>Precisa de hospedagem cedida pelo evento?</label>
				       		<input type="checkbox" name="atracao[hospedagem]" <?=(isset($atracao->atr_hospedagem)) ? ($atracao->atr_hospedagem == '1') ? 'checked' : '' : ''?>> Sim <br><br>
						</div>
						<div class="form-group">
				       		<label>Aceita hospedagem solidária?</label>
				       		<input type="checkbox" name="atracao[solidaria]" <?=(isset($atracao->atr_solidaria)) ? ($atracao->atr_solidaria == '1') ? 'checked' : '' : ''?>> Sim <br><br>
						</div>
						<div class="form-group">
							<label>Cachê *</label>
							<input value="<?=(isset($atracao->atr_custo)) ? $atracao->atr_custo : "" ?>" class="formP form-control formValor" type="text" name="atracao[custo]" required>
						</div>
						<div class="form-group">
							<label>Observações</label>
							<textarea class="formText form-control" name="atracao[observacao]"><?=(isset($atracao->atr_observacao)) ? $atracao->atr_observacao : "" ?></textarea>
						</div>
						<br>
						<input type="submit" value="Enviar" class="btn btn-success">
							
					</form>
					
				<?php else: ?>
					Você não possui nenhum produto cadastrado no sistema, <a href="<?=base_url()?>objeto/novo">clique aqui</a> para cadastrar um Produto e então realizar a sua inscrição. 
				<?php endif;?>
			
			</div>
		</div>
	</div>
</div>
