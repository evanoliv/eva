<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<form action="<?=base_url()?>planejamento/cadastrarHospedagem" method="post" id="hospedagemForm">
				
				<input value="<?=(!empty($hospedagem->hos_id)) ? $hospedagem->hos_id : "" ?>" class="registroId" type="hidden" name="hospedagem[id]">
				
				<legend>Informações sobre a hospedaria</legend>
								
				<div class="form-group">
					<label>Nome *</label>
					<input value="<?=(!empty($hospedagem->hos_nome)) ? $hospedagem->hos_nome : "" ?>" class="formG form-control" type="text" name="hospedagem[nome]" maxlength="255" required>
				</div>
				<div class="form-group">
					<label>Descrição</label>
					<textarea class="formText form-control formObjResumo" name="hospedagem[descricao]" maxlength="8000"><?=(isset($hospedagem->hos_descricao)) ? $hospedagem->hos_descricao : "" ?></textarea>
				</div>				
				<div class="form-group">
		       		<label>Tipo</label>
		       		<input type="radio" value="1" name="hospedagem[solidaria]" <?=(isset($hospedagem->hos_solidaria)) ? ($hospedagem->hos_solidaria == '1') ? 'checked' : '' : ''?>> Solidária <br>
		       		<input type="radio" value="2" name="hospedagem[solidaria]" <?=(isset($hospedagem->hos_solidaria)) ? ($hospedagem->hos_solidaria == '2') ? 'checked' : '' : 'checked'?>> Comercial
				</div>
				<div class="form-group">
		       		<label>Lugares</label>
		       		<input value="<?=(!empty($hospedagem->hos_lugares)) ? $hospedagem->hos_lugares : "" ?>" class="formG form-control" type="number" maxlength="255" name="hospedagem[lugares]">
				</div>				
				<div class="form-group">
		       		<label>E-mail</label>
		       		<input value="<?=(!empty($hospedagem->hos_email)) ? $hospedagem->hos_email : "" ?>" class="formG form-control" type="email" maxlength="255" name="hospedagem[email]">
				</div>				
				<div class="form-group">
		       		<label>Telefone fixo</label>
		       		<input value="<?=(!empty($hospedagem->hos_telefone)) ? $hospedagem->hos_telefone : "" ?>" class="formP formTel form-control" type="tel" name="hospedagem[telefone]">
				</div>
				<div class="form-group">
		       		<label>Celular 1 *</label>
		       		<input value="<?=(!empty($hospedagem->hos_celular1)) ? $hospedagem->hos_celular1 : "" ?>" class="formP formCel form-control" type="tel" name="hospedagem[celular1]" required>
				</div>
				<div class="form-group">
		       		<label>Celular 2</label>
		       		<input value="<?=(!empty($hospedagem->hos_celular2)) ? $hospedagem->hos_celular2 : "" ?>" class="formP formCel form-control" type="tel" name="hospedagem[celular2]">
				</div>

				<legend>Endereço</legend>
		
				<div class="form-group">
					<label>CEP *</label>
					<div class="inputCep">					
						<input value="<?=(!empty($hospedagem->hos_cep)) ? $hospedagem->hos_cep : "" ?>" class="formP formCep form-control" type="text" name="hospedagem[cep]" required>
						<img src="<?=base_url()?>img/spinner.gif">
					</div>
					<span id="helpBlock" class="help-block">Preencha o CEP e o número, a busca pelo endereço é automática</span>				
				</div>
				<div class="form-group">
					<label>Endereço</label>
					<input value="<?=(!empty($hospedagem->hos_endereco)) ? $hospedagem->hos_endereco : "" ?>" class="formEndereco formG form-control" type="text" name="hospedagem[endereco]">
				</div>
				<div class="form-group">
					<label>Número *</label>
					<input value="<?=(!empty($hospedagem->hos_numero)) ? $hospedagem->hos_numero : "" ?>" class="formP form-control formNumero" type="text" maxlength="255" name="hospedagem[numero]" required>
				</div>
				<div class="form-group">
					<label>Complemento</label>
					<input value="<?=(!empty($hospedagem->hos_complemento)) ? $hospedagem->hos_complemento : "" ?>" class="formG form-control" maxlength="255" type="text" name="hospedagem[complemento]">
				</div>
				<div class="form-group">
					<label>Bairro</label>
					<input value="<?=(!empty($hospedagem->hos_bairro)) ? $hospedagem->hos_bairro : "" ?>" class="formBairro formG form-control" type="text" name="hospedagem[bairro]">
				</div>
				<div class="form-group">
					<label>Cidade</label>
					<input value="<?=(!empty($hospedagem->hos_cidade)) ? $hospedagem->hos_cidade : "" ?>" class="formCidade" type="hidden" name="hospedagem[cidade]">
					<span id="helpBlock" class="help-block formSpanCidade"><?=(!empty($hospedagem->hos_cidade)) ? $hospedagem->hos_cidade : "<br>" ?></span>
				</div>
				<div class="form-group">
					<label>Estado</label>
					<input value="<?=(!empty($hospedagem->hos_estado)) ? $hospedagem->hos_estado : "" ?>" class="formEstado" type="hidden" name="hospedagem[estado]">
					<span id="helpBlock" class="help-block formSpanEstado"><?=(!empty($hospedagem->hos_estado)) ? $hospedagem->hos_estado : "<br>" ?></span>
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