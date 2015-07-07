<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend><?=stripslashes($atracao->obj_nome)?></legend>

				<div class="form-group">
		       		<label>Meio de transporte</label>
		       		<span id="helpBlock" class="help-block"><?=$atracao->atr_transporte?></span>
				</div>
				<div class="form-group">
		       		<label>Possui restrição alimentar?</label>
		       		<span id="helpBlock" class="help-block"><?=($atracao->atr_alimentacao == '1') ? 'Sim' : 'Não' ?></span>
				</div>
				<div class="form-group">
		       		<label>Precisa de hospedagem cedida pelo evento?</label>
		       		<span id="helpBlock" class="help-block"><?=($atracao->atr_hospedagem == '1') ? 'Sim' : 'Não' ?></span><br>
				</div>
				<div class="form-group">
		       		<label>Aceita hospedagem solidária?</label>
		       		<span id="helpBlock" class="help-block"><?=($atracao->atr_solidaria == '1') ? 'Sim' : 'Não' ?></span><br>
				</div>
				<div class="form-group">
					<label>Cachê *</label>
					<span id="helpBlock" class="help-block"><?='R$ '.number_format($atracao->atr_custo,2,',','.')?></span>
				</div>
				<div class="form-group">
					<label>Observações</label>
					<span id="helpBlock" class="help-block"><?=(isset($atracao->atr_observacao)) ? nl2br(stripslashes($atracao->atr_observacao)) : "<br><br>" ?></span>
				</div>
				<br>
				<br>
				<a href="<?=base_url()?>evento/<?=($atracao->atr_selecionado == '1') ? 'remover' : 'selecionar' ?>Atracao/<?=$atracao->atr_id?>"><button class="btn btn-<?=($atracao->atr_selecionado == '1') ? 'danger' : 'success' ?>"><?=($atracao->atr_selecionado == '1') ? 'Remover' : 'Selecionar' ?></button></a>
				<br>		
				<br>
				<legend>Informações sobre o objeto</legend>
				
				<div class="fotoObjeto">
					<?php if(!empty($objeto->obj_foto1)):?>
						<a href="<?=base_url()?>uploads/obj_img/<?=$objeto->obj_id?>_foto.jpg" target="_blank"><img src="<?=base_url()?>uploads/obj_img/<?=$objeto->obj_id?>_foto.jpg" onError="this.onerror=null;this.src='<?=base_url()?>img/img-nao-disponivel.jpg'"></a>
					<?php else:?>
						<br>
					<?php endif;?>	
				</div>
				<div class="form-group">
					<label>Nome</label>
					<span id="helpBlock" class="help-block"><?=stripslashes($objeto->obj_nome)?></span>
				</div>
				<div class="form-group">
					<label>Tipo</label>
					<span id="helpBlock" class="help-block"><?=$objeto->tipo_nome?></span>
				</div>
				<div class="form-group">
					<label></label>
					<span id="helpBlock" class="help-block"><?=$objeto->subtipo_nome?></span>
				</div>
				<div class="form-group">
					<label></label>
					<span id="helpBlock" class="help-block"><?=$objeto->subsubtipo_nome?></span>
				</div>
				<div class="form-group">
					<label>Release</label>
					<span id="helpBlock" class="help-block"><?=nl2br(stripslashes($objeto->obj_resumo))?></span>
				</div>
				<div class="form-group">
					<label>Responsável</label>
					<span id="helpBlock" class="help-block"><a href="<?=base_url()?>responsavel/show/<?=$objeto->responsavel_id?>"><?=$objeto->responsavel_nome?></a></span>
				</div>
				
				<?php if(($objeto->obj_tip_id == 1) || ($objeto->obj_tip_id == 2)):?>
					<div class="produto_cultural" style="display: block !important;">
						<legend>Informações sobre o <?=($objeto->obj_tip_id == 1) ? 'Evento' : 'Produto'?></legend>
	
						<div class="form-group">
							<label>Censura</label>
							<span id="helpBlock" class="help-block"><?=!empty($objeto->produto->pro_censura) ? $objeto->produto->pro_censura : '<br>'?></span>
						</div>
						<div class="form-group">
							<label>Número de integrantes</label>
							<span id="helpBlock" class="help-block"><?=!empty($objeto->produto->pro_integrantes) ? $objeto->produto->pro_integrantes : '<br>'?></span>
						</div>
						<div class="form-group">
							<label>Duração</label>
							<span id="helpBlock" class="help-block"><?=!empty($objeto->produto->pro_duracao) ? $objeto->produto->pro_duracao : '<br>'?></span>
						</div>
						<div class="form-group">
							<label>Rider técnico</label>
							<span id="helpBlock" class="help-block"><?=!empty($objeto->produto->pro_rider) ? nl2br(stripslashes($objeto->produto->pro_rider)) : '<br>'?></span>
						</div>
						<div class="form-group">
							<label>Ficha técnica</label>
							<span id="helpBlock" class="help-block"><?=!empty($objeto->produto->pro_ficha_tecnica) ? nl2br(stripslashes($objeto->produto->pro_ficha_tecnica)) : '<br>'?></span>
						</div>
					</div>
				<?php endif;?>
				
				<?php if($objeto->obj_tip_id == 3):?>
					<div class="equipamento_cultural" style="display: block !important;">
						<legend>Informações sobre o Equipamento</legend>
						
						<div class="form-group">
							<label>CEP</label>
							<span id="helpBlock" class="help-block"><?=!empty($objeto->equipamento->equ_cep) ? $objeto->equipamento->equ_cep : '<br><br>'?></span>
						</div>
						<div class="form-group">
							<label>Rua</label>
							<span id="helpBlock" class="help-block"><?=!empty($objeto->equipamento->equ_endereco) ? $objeto->equipamento->equ_endereco : '<br><br>'?></span>
						</div>
						<div class="form-group">
							<label>Número</label>
							<span id="helpBlock" class="help-block"><?=!empty($objeto->equipamento->equ_numero) ? $objeto->equipamento->equ_numero : '<br><br>'?></span>
						</div>
						<div class="form-group">
							<label>Complemento</label>
							<span id="helpBlock" class="help-block"><?=!empty($objeto->equipamento->equ_complemento) ? $objeto->equipamento->equ_complemento : '<br><br>'?></span>
						</div>
						<div class="form-group">
							<label>Bairro</label>
							<span id="helpBlock" class="help-block"><?=!empty($objeto->equipamento->equ_bairro) ? $objeto->equipamento->equ_bairro : '<br><br>'?></span>
						</div>
						<div class="form-group">
							<label>Cidade/Estado</label>
							<span id="helpBlock" class="help-block"><?=$objeto->equipamento->equ_cidade?>/<?=$objeto->equipamento->equ_estado?></span>
						</div>
					</div>
				<?php endif;?>
							
				<legend>Demais informações</legend>	
				<div class="form-group">
		       		<label>Áreas de Atuação Cultural</label>
		       		<span id="helpBlock" class="help-block">
		       			<?php if(!empty($objeto->areas)):?>
							<?php foreach ($objeto->areas as $area):?>
								<?=$area->are_nome?><br>
							<?php endforeach;?>
						<?php else: ?>
							<br>
						<?php endif;?>	
					<br>						
					</span>
				</div>
				<div class="form-group">
		       		<label>Vídeo</label>
		       		<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_link_video) ? '<a href="'.verifica_http($objeto->obj_link_video).'" target="_blank">'.$objeto->obj_link_video.'</a>' : '<br>'?></span>
				</div>
				<div class="form-group">
		       		<label>Site</label>
		       		<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_link_site) ? '<a href="'.verifica_http($objeto->obj_link_site).'" target="_blank">'.$objeto->obj_link_site.'</a>' : '<br>'?></span>
				</div>
				<div class="form-group">
		       		<label>Facebook</label>
		       		<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_link_facebook) ? '<a href="'.verifica_http($objeto->obj_link_facebook).'" target="_blank">'.$objeto->obj_link_facebook.'</a>' : '<br>'?></span>
				</div>
				<div class="form-group">
		       		<label>YouTube</label>
		       		<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_link_youtube) ? '<a href="'.verifica_http($objeto->obj_link_youtube).'" target="_blank">'.$objeto->obj_link_youtube.'</a>' : '<br>'?></span>
				</div>
				<div class="form-group">
		       		<label>Outra rede social</label>
		       		<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_link_redesocial) ? '<a href="'.verifica_http($objeto->obj_link_redesocial).'" target="_blank">'.$objeto->obj_link_redesocial.'</a>' : '<br>'?></span>
				</div>
				<div class="form-group">
		       		<label>Financiamento</label>
		       		<span id="helpBlock" class="help-block">
		       			<?php if(!empty($objeto->financiamentos)):?>
							<?php foreach ($objeto->financiamentos as $financiamento):?>
								<?=$financiamento->fin_nome?><br>
							<?php endforeach;?>
						<?php else: ?>
							<br>
						<?php endif;?>							
						
					</span>
				</div>
				<div class="form-group">
					<label>Informações adicionais</label>
					<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_info) ? nl2br(stripslashes($objeto->obj_info)) : '<br>'?></span>
				</div>
				
				<br>
			
			</div>
		</div>
	</div>
</div>
