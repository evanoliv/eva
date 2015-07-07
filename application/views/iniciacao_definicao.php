<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<?=imprimeMsg()?>
			
			<form action="<?=base_url()?>iniciacao/cadastrarDefinicao" method="post" id="definicaoForm">
				
				<legend>Informações sobre o evento</legend>
				
				<div class="form-group">
					<label>Nome *</label>
					<input value="<?=(isset($evento->eve_nome)) ? $evento->eve_nome: "" ?>" class="formG form-control" type="text" name="evento[nome]" maxlength="255" required>
				</div>
				<div class="form-group">
					<label>Release *</label>
					<textarea class="formText form-control formObjResumo" name="evento[descricao]" maxlength="400" required><?=(isset($evento->eve_descricao)) ? $evento->eve_descricao : "" ?></textarea>
					<span id="helpBlock" class="help-block">Mínimo de 100 caracteres. Máximo de 400 caracteres</span>
				</div>
				<div class="form-group">
		       		<label>Data Inicial *</label>
		       		<input value="<?=(!empty($evento->eve_data_inicial)) ? $evento->eve_data_inicial : "" ?>" class="formP form-control dataInicial" type="date" name="evento[data_inicial]" required>
				</div>
				<div class="form-group">
		       		<label>Data Final *</label>
		       		<input value="<?=(!empty($evento->eve_data_final)) ? $evento->eve_data_final : "" ?>" class="formP form-control dataFinal" type="date" name="evento[data_final]" required>
				</div>
				<div class="form-group">
					<label>Orçamento (R$) *</label>
					<input value="<?=(!empty($evento->eve_orcamento)) ? $evento->eve_orcamento : "" ?>" class="formP form-control formValor" type="text" name="evento[orcamento]" required>
					<span id="helpBlock" class="help-block">A quantidade de recursos disponíveis para a gestão do evento</span>
				</div>
				<div class="form-group">
		       		<label>Evento Público?</label>
		       		<input type="checkbox" name="evento[publico]" <?=(isset($evento->eve_publico)) ? ($evento->eve_publico == '1') ? 'checked' : '' : ''?>> Sim
	       			<span id="helpBlock" class="help-block">Eventos públicos são visíveis a todos que acessam o Sistema EVA</span>
				</div>
				<div class="form-group">
		       		<label>Inscrições abertas?</label>
		       		<input type="checkbox" name="evento[inscricao]" <?=(isset($evento->eve_inscricao)) ? ($evento->eve_inscricao == '1') ? 'checked' : '' : ''?>> Sim
	       			<span id="helpBlock" class="help-block">Para adicionar atrações públicas no Evento é preciso que estas se inscrevam</span>
				</div>

				<legend>Demais informações</legend>

				<div class="form-group">
					<label>Proposta Curatorial</label>
					<textarea class="formText form-control" name="evento[proposta]" maxlength="1000"><?=(isset($evento->eve_proposta)) ? $evento->eve_proposta : "" ?></textarea>
					<span id="helpBlock" class="help-block">Máximo de 1000 caracteres</span>
				</div>
				<div class="form-group">
					<label>Justificativa</label>
					<textarea class="formText form-control" name="evento[justificativa]" maxlength="8000"><?=(isset($evento->eve_justificativa)) ? $evento->eve_justificativa : "" ?></textarea>
					<span id="helpBlock" class="help-block">Máximo de 8000 caracteres</span>
				</div>
				<div class="form-group">
					<label>Objetivo</label>
					<textarea class="formText form-control" name="evento[objetivo]" maxlength="8000"><?=(isset($evento->eve_objetivo)) ? $evento->eve_objetivo : "" ?></textarea>
					<span id="helpBlock" class="help-block">Máximo de 8000 caracteres</span>
				</div>
				<div class="form-group">
					<label>Público de Interesse</label>
					<textarea class="formText form-control" name="evento[publico_interesse]" maxlength="8000"><?=(isset($evento->eve_publico_interesse)) ? $evento->eve_publico_interesse : "" ?></textarea>
					<span id="helpBlock" class="help-block">Máximo de 8000 caracteres</span>
				</div>
				<div class="form-group">
					<label>Acessibilidade</label>
					<textarea class="formText form-control" name="evento[acessibilidade]" maxlength="8000"><?=(isset($evento->eve_acessibilidade)) ? $evento->eve_acessibilidade : "" ?></textarea>
					<span id="helpBlock" class="help-block">Máximo de 8000 caracteres</span>
				</div>
				<div class="form-group">
					<label>Democratização de Acesso</label>
					<textarea class="formText form-control" name="evento[democratizacao]" maxlength="8000"><?=(isset($evento->eve_democratizacao)) ? $evento->eve_democratizacao : "" ?></textarea>
					<span id="helpBlock" class="help-block">Máximo de 8000 caracteres</span>
				</div>
				<div class="form-group">
					<label>Impacto Ambiental</label>
					<textarea class="formText form-control" name="evento[impacto_ambiental]" maxlength="8000"><?=(isset($evento->eve_impacto_ambiental)) ? $evento->eve_impacto_ambiental : "" ?></textarea>
					<span id="helpBlock" class="help-block">Máximo de 8000 caracteres</span>
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