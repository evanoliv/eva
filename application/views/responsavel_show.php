<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<legend>Dados Pessoais</legend>
				
			<div class="form-group">
				<label>Nome</label>
				<span class="help-block"><?=(!empty($responsavel->res_nome)) ? $responsavel->res_nome : "<br>" ?></span>
			</div>
			<div class="form-group">
	       		<label>E-mail</label>
	       		<span class="help-block"><?=(!empty($responsavel->res_email)) ? $responsavel->res_email : "<br>" ?></span>
			</div>				
			<div class="form-group">
				<label>Instituição</label>
				<span class="help-block"><?=(!empty($responsavel->res_instituicao)) ? $responsavel->res_instituicao : "<br>" ?></span>
			</div>
			<div class="form-group">
				<label>Cargo</label>
				<span class="help-block"><?=(!empty($responsavel->res_cargo)) ? $responsavel->res_cargo : "<br>" ?></span>
			</div>
			<div class="form-group">
				<label>Cidade/Estado</label>
				<span class="help-block"><?=(!empty($responsavel->res_cidade)) ? $responsavel->res_cidade : "" ?>/<?=(!empty($responsavel->res_estado)) ? $responsavel->res_estado : "" ?></span>
			</div>
			
			<?php if(($this->session->userdata('usu_id')) && ($responsavel->res_usu_id == $this->session->userdata('usu_id'))):?>
			
				<div class="form-group">
		       		<label>Data de Nascimento</label>
		       		<span class="help-block"><?=(!empty($responsavel->res_datanasc)) ? format_show($responsavel->res_datanasc) : "<br>" ?></span>
				</div>
				<div class="form-group">
		       		<label>Telefone fixo</label>
		       		<span class="help-block formTel"><?=(!empty($responsavel->res_telefone)) ? format_show($responsavel->res_telefone) : "<br>" ?></span>
				</div>
				<div class="form-group">
		       		<label>Celular 1</label>
		       		<span class="help-block"><?=(!empty($responsavel->res_celular1)) ? format_show($responsavel->res_celular1) : "<br>" ?></span>
				</div>
				<div class="form-group">
		       		<label>Celular 2</label>
		       		<span class="help-block"><?=(!empty($responsavel->res_celular2)) ? format_show($responsavel->res_celular2) : "<br>" ?></span>
				</div>
		
				<legend>Endereço</legend>
			
				<div class="form-group">
					<label>CEP</label>
					<span class="help-block"><?=(!empty($responsavel->res_cep)) ? format_show($responsavel->res_cep) : "<br><br>" ?></span>
				</div>
				<div class="form-group">
					<label>Rua</label>
					<span class="help-block"><?=(!empty($responsavel->res_endereco)) ? $responsavel->res_endereco : "<br><br>" ?></span>
				</div>
				<div class="form-group">
					<label>Número</label>
					<span class="help-block"><?=(!empty($responsavel->res_numero)) ? $responsavel->res_numero : "<br><br>" ?></span>
				</div>
				<div class="form-group">
					<label>Complemento</label>
					<span class="help-block"><?=(!empty($responsavel->res_complemento)) ? $responsavel->res_complemento : "<br><br>" ?></span>
				</div>
				<div class="form-group">
					<label>Bairro</label>
					<span class="help-block"><?=(!empty($responsavel->res_bairro)) ? $responsavel->res_bairro : "<br><br>" ?></span>
				</div>
			<?php endif;?>
							
			<legend>Objetos deste responsável</legend>	
			
			<?php if(!empty($objetos)):?>
				<?php foreach($objetos as $objeto):?>
					<div class="objeto_mapeado">
						<a href="<?=base_url()?>uploads/obj_img/<?=$objeto->obj_id?>_foto.jpg" target="_blank"><img src="<?=base_url()?>uploads/obj_img/<?=$objeto->obj_id?>_thumb.jpg" onError="this.onerror=null;this.src='<?=base_url()?>img/img-nao-disponivel.jpg'"></a>
						<div class="info_objeto">
							<strong><a href="<?=base_url()?>objeto/show/<?=$objeto->obj_id?>"><?=stripslashes($objeto->obj_nome)?></a></strong><br>
							<?=$objeto->subsubtipo_nome?><br>
							<?=substr($objeto->obj_resumo, 0, 200)?>...
						</div>
					</div>
				<?php endforeach;?>
			<?php else:?>
				<div class="objeto_mapeado">
					Nenhum objeto encontrado
				</div>
			<?php endif;?>
			
		</div>
	</div>
</div>