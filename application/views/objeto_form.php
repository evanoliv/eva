<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<form action="<?=base_url()?>objeto/cadastrar" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="objetoForm">
				
				<input value="<?=(!empty($objeto->obj_id)) ? $objeto->obj_id : "" ?>" class="registroId" type="hidden" name="objeto[id]">
				<input value="<?=(!empty($objeto->obj_res_id)) ? $objeto->obj_res_id : $this->session->userdata('res_id') ?>" type="hidden" name="objeto[responsavel]">
				<input value="<?=(!empty($objeto->produto->pro_id)) ? $objeto->produto->pro_id : "" ?>" class="produtoId" type="hidden" name="produto[id]">
				<input value="<?=(!empty($objeto->equipamento->equ_id)) ? $objeto->equipamento->equ_id : "" ?>" class="equipamentoId" type="hidden" name="equipamento[id]">
				
				<legend>Informações sobre o objeto</legend>
				
				<div class="form-group">
					<label>Tipo *</label>
					<select class="formG form-control" name="objeto[tipo]" id="tipo_objeto" required>
						<?php if(empty($objeto)):?>
							<option value="">Selecione...</option>
							<?php foreach ($tipos as $tipo):?>
								<option value="<?=$tipo->tip_id?>" <?=(isset($objeto)) ? ($objeto->obj_tip_id == $tipo->tip_id) ? 'selected' : '' : ''?>><?=$tipo->tip_nome?></option>
							<?php endforeach;?>
						<?php else:?>
							<option value="<?=$objeto->obj_tip_id?>"><?=$objeto->tipo_nome?></option>
						<?php endif;?>
					</select>
				</div>
				<div class="form-group">
					<label></label>
					<select class="formG form-control" name="objeto[subtipo]" id="subtipo_objeto" required>
						<option value="">Selecione...</option>
						<?php foreach ($subtipos as $subtipo):?>
							<option value="<?=$subtipo->sub_id?>" <?=($objeto->obj_sub_id == $subtipo->sub_id) ? 'selected' : ''?>><?=$subtipo->sub_nome?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<label> </label>
					<select class="formG form-control" name="objeto[subsubtipo]" id="subsubtipo_objeto" required>
						<option value="">Selecione...</option>
						<?php foreach ($subsubtipos as $subsubtipo):?>
							<option value="<?=$subsubtipo->ssu_id?>" <?=($objeto->obj_ssu_id == $subsubtipo->ssu_id) ? 'selected' : ''?>><?=$subsubtipo->ssu_nome?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<label>Nome *</label>
					<input value="<?=(isset($objeto->obj_nome)) ? stripslashes($objeto->obj_nome) : "" ?>" class="formG form-control" type="text" name="objeto[nome]" maxlength="255" required>
				</div>
				<div class="form-group">
					<label>Release *</label>
					<textarea class="formText form-control formObjResumo" name="objeto[resumo]" maxlength="400" required><?=(isset($objeto->obj_resumo)) ? $objeto->obj_resumo : "" ?></textarea>
					<span id="helpBlock" class="help-block">Mínimo de 100 caracteres. Máximo de 400 caracteres</span>
				</div>
				<div class="form-group">
		       		<label>Privacidade</label>
					<div style="padding-left: 190px;" class="privacidadeObjeto">
		       			<input type="radio" name="objeto[publico]" value="1" <?=(isset($objeto->obj_publico)) ? ($objeto->obj_publico == '1') ? 'checked' : '' : 'checked'?>> Público <br>
		       			<input type="radio" name="objeto[publico]" value="2" <?=(isset($objeto->obj_publico)) ? ($objeto->obj_publico == '2') ? 'checked' : '' : ''?>> Mapeado <br>
		       			<input type="radio" name="objeto[publico]" value="0" <?=(isset($objeto->obj_publico)) ? ($objeto->obj_publico == '0') ? 'checked' : '' : ''?>> Privado
	       			</div>
	       			<span id="helpBlock" class="help-block textoPrivacidade">As informações sobre o objeto serão visíveis a todos que acessam o Sistema EVA.<br><br></span>
				</div>
				
				<div class="produto_cultural">
					<legend><div class="legendaObjeto">Informações sobre o&nbsp;</div><div class="tipoObjeto"></div></legend>

					<div class="form-group">
						<label>Censura *</label>
						<input value="<?=(!empty($objeto->produto->pro_censura)) ? $objeto->produto->pro_censura: "" ?>" class="formP form-control" type="text" name="produto[censura]" maxlength="45" required>
					</div>
					<div class="form-group">
						<label>Número de integrantes *</label>
						<input value="<?=(!empty($objeto->produto->pro_integrantes)) ? $objeto->produto->pro_integrantes: "" ?>" class="formP form-control" type="number" name="produto[integrantes]" required>
					</div>
					<div class="form-group">
						<label>Duração *</label>
						<input value="<?=(!empty($objeto->produto->pro_duracao)) ? $objeto->produto->pro_duracao: "" ?>" class="formP form-control" type="text" name="produto[duracao]" maxlength="45" required>
					</div>
					<div class="form-group">
						<label>Rider técnico</label>
						<textarea class="formText form-control" name="produto[rider]"><?=(!empty($objeto->produto->pro_rider)) ? $objeto->produto->pro_rider : "" ?></textarea>
					</div>
					<div class="form-group">
						<label>Ficha técnica</label>
						<textarea class="formText form-control" name="produto[ficha_tecnica]"><?=(!empty($objeto->produto->pro_ficha_tecnica)) ? $objeto->produto->pro_ficha_tecnica : "" ?></textarea>
					</div>
				</div>
				
				<div class="equipamento_cultural">
					<legend>Informações sobre o Equipamento</legend>
					
					<div class="form-group">
						<label>CEP *</label>
						<div class="inputCep">
							<input value="<?=(!empty($objeto->equipamento->equ_cep)) ? $objeto->equipamento->equ_cep : "" ?>" class="formP formCep form-control" type="text" name="equipamento[cep]" required>
							<img src="<?=base_url()?>img/spinner.gif">
						</div>
						<span id="helpBlock" class="help-block">Preencha o CEP e o número, a busca pelo endereço é automática</span>				
					</div>
					<div class="form-group">
						<label>Endereço</label>
						<input value="<?=(!empty($objeto->equipamento->equ_endereco)) ? $objeto->equipamento->equ_endereco : "" ?>" class="formG formEndereco form-control" type="text" name="equipamento[endereco]">
					</div>
					<div class="form-group">
						<label>Número *</label>
						<input value="<?=(!empty($objeto->equipamento->equ_numero)) ? $objeto->equipamento->equ_numero : "" ?>" class="formP form-control formNumero" type="text" maxlength="255" name="equipamento[numero]" required>
					</div>
					<div class="form-group">
						<label>Complemento</label>
						<input value="<?=(!empty($objeto->equipamento->equ_complemento)) ? $objeto->equipamento->equ_complemento : "" ?>" class="formG form-control formObjComplemento" maxlength="255" type="text" name="equipamento[complemento]">
					</div>
					<div class="form-group">
						<label>Bairro</label>
						<input value="<?=(!empty($objeto->equipamento->equ_bairro)) ? $objeto->equipamento->equ_bairro : "" ?>" class="formG formBairro form-control" type="text" name="equipamento[bairro]">
					</div>
					<div class="form-group">
						<label>Cidade</label>
						<input value="<?=(!empty($objeto->equipamento->equ_cidade)) ? $objeto->equipamento->equ_cidade : "" ?>" class="formCidade" type="hidden" name="equipamento[cidade]">
						<span id="helpBlock" class="help-block formSpanCidade"><?=(!empty($objeto->equipamento->equ_cidade)) ? $objeto->equipamento->equ_cidade : "<br>" ?></span>
					</div>
					<div class="form-group">
						<label>Estado</label>
						<input value="<?=(!empty($objeto->equipamento->equ_estado)) ? $objeto->equipamento->equ_estado : "" ?>" class="formEstado" type="hidden" name="equipamento[estado]">
						<span id="helpBlock" class="help-block formSpanEstado"><?=(!empty($objeto->equipamento->equ_estado)) ? $objeto->equipamento->equ_estado: "<br>" ?></span>
		            </div>
				</div>
				
				<legend>Demais informações</legend>
								
				<div class="form-group table-form-objeto">
		       		<label>Áreas de Atuação Cultural</label>
		       		<table><tr><td>
		       		<?php $cont = 0; ?>
					<?php foreach ($areas as $area):?>
						<input value="<?=$area->are_id?>" <?=isset($atuacao) ? (in_array($area->are_id, $atuacao)) ? 'checked' : '' : '' ?> type="checkbox" name="objeto[area][]"> <?=$area->are_nome?> <br>
						<?php $cont++;?>
						<?php if(($cont == 22)||($cont == 44)) echo '</td><td>'?>
					<?php endforeach;?>
					</td></tr></table>
				</div>
				<div class="form-group">
		       		<label>Foto</label>
					<?php if(!empty($objeto->obj_foto1)):?>
						<a href="<?=base_url()?>uploads/obj_img/<?=$objeto->obj_id?>_foto.jpg" target="_blank"><img src="<?=base_url()?>uploads/obj_img/<?=$objeto->obj_id?>_thumb.jpg"></a>
					<?php endif;?>
		       		<span id="helpBlock" class="help-block"><input type="file" name="userfile"></span>
		       		<span id="helpBlock" class="help-block">Tipo permitido: jpg. Tamanho máximo: 4 Mb</span>
				</div>				
				<div class="form-group">
		       		<label>Vídeo</label>
		       		<input value="<?=(isset($objeto->obj_link_video)) ? $objeto->obj_link_video : "" ?>" class="formG form-control" type="text" name="objeto[link_video]"  maxlength="255">
		       		<span id="helpBlock" class="help-block">Embora não seja obrigatório, o envio de um vídeo ou áudio é de relevância para a seleção do trabalho.</span>
				</div>
				<div class="form-group">
		       		<label>Site</label>
		       		<input value="<?=(isset($objeto->obj_link_site)) ? $objeto->obj_link_site : "" ?>" class="formG form-control" type="text" name="objeto[link_site]"  maxlength="255">
				</div>
				<div class="form-group">
		       		<label>Facebook</label>
		       		<input value="<?=(isset($objeto->obj_link_facebook)) ? $objeto->obj_link_facebook : "" ?>" class="formG form-control" type="text" name="objeto[link_facebook]"  maxlength="255">
				</div>
				<div class="form-group">
		       		<label>YouTube</label>
		       		<input value="<?=(isset($objeto->obj_link_youtube)) ? $objeto->obj_link_youtube : "" ?>" class="formG form-control" type="text" name="objeto[link_youtube]"  maxlength="255">
				</div>
				<div class="form-group">
		       		<label>Outra rede social</label>
		       		<input value="<?=(isset($objeto->obj_link_redesocial)) ? $objeto->obj_link_redesocial : "" ?>" class="formG form-control" type="text" name="objeto[link_redesocial]"  maxlength="255">
				</div>
				<div class="form-group table-form-objeto">
		       		<label>Financiamento</label>
		       		<table><tr><td>
	       				<?php foreach ($financiamentos as $financiamento):?>
							<input value="<?=$financiamento->fin_id?>" <?=isset($financiamento_objeto) ? (in_array($financiamento->fin_id, $financiamento_objeto)) ? 'checked' : '' : '' ?> type="checkbox" name="objeto[financiamento][]"> <?=$financiamento->fin_nome?><br>
						<?php endforeach;?>
					</td></tr></table>
	       			<span id="helpBlock" class="help-block">Descreva no campo abaixo, se necessário</span>
				</div>
				<div class="form-group">
					<label>Informações adicionais</label>
					<textarea class="formText form-control" name="objeto[info]"><?=(isset($objeto->obj_info)) ? $objeto->obj_info : "" ?></textarea>
				</div>
				<br>
				<input type="submit" value="Enviar" class="btn btn-success">
					
			</form>
		</div>
	</div>
</div>