<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">

			<?=imprimeMsg()?>
		
			<form action="<?=base_url()?>responsavel/cadastrar" method="post" id="responsavelForm">
				
				<input value="<?=(!empty($responsavel->res_id)) ? $responsavel->res_id : "" ?>" class="registroId" type="hidden" name="responsavel[id]">
				
				<legend>Dados Pessoais</legend>
								
				<div class="form-group">
					<label>Nome</label>
					<span class="help-block"><?=(!empty($responsavel->res_nome)) ? $responsavel->res_nome : "<br>" ?></span>
					<input value="<?=(!empty($responsavel->res_nome)) ? $responsavel->res_nome : "" ?>" type="hidden" name="responsavel[nome]" maxlength="255" required>
				</div>
				<div class="form-group">
					<label>Instituição</label>
					<input value="<?=(!empty($responsavel->res_instituicao)) ? $responsavel->res_instituicao : "" ?>" class="formG form-control" type="text" name="responsavel[instituicao]" maxlength="255">
				</div>
				<div class="form-group">
					<label>Cargo</label>
					<input value="<?=(!empty($responsavel->res_cargo)) ? $responsavel->res_cargo : "" ?>" class="formG form-control" type="text" name="responsavel[cargo]" maxlength="2555">
				</div>
				<div class="form-group">
		       		<label>Data de Nascimento *</label>
		       		<input value="<?=(!empty($responsavel->res_datanasc)) ? $responsavel->res_datanasc : "" ?>" class="formP form-control" type="date" name="responsavel[datanasc]" required>
				</div>
				<div class="form-group">
		       		<label>E-mail</label>
		       		<span class="help-block"><?=(!empty($responsavel->res_email)) ? $responsavel->res_email : "<br>" ?></span>
		       		<input value="<?=(!empty($responsavel->res_email)) ? $responsavel->res_email : "" ?>" type="hidden" maxlength="255" name="responsavel[email]" required>
				</div>				
				<div class="form-group">
		       		<label>Telefone fixo</label>
		       		<input value="<?=(!empty($responsavel->res_telefone)) ? $responsavel->res_telefone : "" ?>" class="formP formTel form-control" type="tel" name="responsavel[telefone]">
				</div>
				<div class="form-group">
		       		<label>Celular 1 *</label>
		       		<input value="<?=(!empty($responsavel->res_celular1)) ? $responsavel->res_celular1 : "" ?>" class="formP formCel form-control" type="tel" name="responsavel[celular1]" required>
				</div>
				<div class="form-group">
		       		<label>Celular 2</label>
		       		<input value="<?=(!empty($responsavel->res_celular2)) ? $responsavel->res_celular2 : "" ?>" class="formP formCel form-control" type="tel" name="responsavel[celular2]">
				</div>

				<legend>Endereço</legend>
		
				<div class="form-group">
					<label>CEP *</label>
					<div class="inputCep">					
						<input value="<?=(!empty($responsavel->res_cep)) ? $responsavel->res_cep : "" ?>" class="formP formCep form-control" type="text" name="responsavel[cep]" required>
						<img src="<?=base_url()?>img/spinner.gif">
					</div>
					<span id="helpBlock" class="help-block">Preencha o CEP e o número, a busca pelo endereço é automática</span>				
				</div>
				<div class="form-group">
					<label>Endereço</label>
					<input value="<?=(!empty($responsavel->res_endereco)) ? $responsavel->res_endereco : "" ?>" class="formEndereco formG form-control" type="text" name="responsavel[endereco]">
				</div>
				<div class="form-group">
					<label>Número *</label>
					<input value="<?=(!empty($responsavel->res_numero)) ? $responsavel->res_numero : "" ?>" class="formP form-control formNumero" type="text" maxlength="255" name="responsavel[numero]" required>
				</div>
				<div class="form-group">
					<label>Complemento</label>
					<input value="<?=(!empty($responsavel->res_complemento)) ? $responsavel->res_complemento : "" ?>" class="formG form-control" maxlength="255" type="text" name="responsavel[complemento]">
				</div>
				<div class="form-group">
					<label>Bairro</label>
					<input value="<?=(!empty($responsavel->res_bairro)) ? $responsavel->res_bairro : "" ?>" class="formBairro formG form-control" type="text" name="responsavel[bairro]">
				</div>
				<div class="form-group">
					<label>Cidade</label>
					<input value="<?=(!empty($responsavel->res_cidade)) ? $responsavel->res_cidade : "" ?>" class="formCidade" type="hidden" name="responsavel[cidade]">
					<span id="helpBlock" class="help-block formSpanCidade"><?=(!empty($responsavel->res_cidade)) ? $responsavel->res_cidade : "<br>" ?></span>
				</div>
				<div class="form-group">
					<label>Estado</label>
					<input value="<?=(!empty($responsavel->res_estado)) ? $responsavel->res_estado : "" ?>" class="formEstado" type="hidden" name="responsavel[estado]">
					<span id="helpBlock" class="help-block formSpanEstado"><?=(!empty($responsavel->res_estado)) ? $responsavel->res_estado : "<br>" ?></span>
	            </div>
				<br>
				<input type="submit" value="Enviar" class="btn btn-success">
					
			</form>
			
		</div>
	</div>
</div>