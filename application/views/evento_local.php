<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
			
			<legend>Local: <?=$nomeLocal?></legend>
			
			<legend><a href="<?=base_url()?>planejamento/programacao">Apresentações</a></legend>
			
			<table class="table table-hover tblLegend">
				<thead>
					<th><center>Ver</center></th>
					<th>Dia</th>
					<th>Hora</th>
					<th>Atração</th>
					<th>Coordenadores</th>
					<th>Produtores</th>
				</thead>
				<tbody>
					<?php if(!empty($apresentacoes)):?>
						<?php foreach ($apresentacoes as $apresentacao):?>
							<tr>
								<td><center><a href="<?=base_url()?>planejamento/showApresentacao/<?=$apresentacao->apr_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></a></center></span>
								<td><?=format_show($apresentacao->apr_data)?></td>
								<td><?=format_time($apresentacao->apr_hora)?></td>
								<td><a href="<?=base_url()?>evento/atracao/<?=$apresentacao->atracao->atr_id?>"><?=$apresentacao->atracao->obj_nome?></a></td>
								<td>
									<?php foreach ($apresentacao->coordenadores as $coordenador):?>
										<?php if($coordenador->par_apr_id == $apresentacao->apr_id):?>
											<a href="<?=base_url()?>evento/perfil/<?=$coordenador->usu_id?>"><?=$coordenador->usu_nome?></a><br>
										<?php endif;?>
									<?php endforeach;?>
								</td>
								<td>
									<?php foreach ($apresentacao->produtores as $produtor):?>
										<?php if($produtor->par_apr_id == $apresentacao->apr_id):?>
											<a href="<?=base_url()?>evento/perfil/<?=$produtor->usu_id?>"><?=$produtor->usu_nome?></a><br>
										<?php endif; ?>
									<?php endforeach;?>
								</td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma apresentação registrada</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
						
			<legend>Informações sobre o objeto</legend>
				
				<div class="form-group">
					<label>Responsável</label>
					<span id="helpBlock" class="help-block"><a href="<?=base_url()?>responsavel/show/<?=$objeto->responsavel_id?>"><?=$objeto->responsavel_nome?></a></span>
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
					<label>Nome</label>
					<span id="helpBlock" class="help-block"><?=stripslashes($objeto->obj_nome)?></span>
				</div>
				<div class="form-group">
					<label>Release</label>
					<span id="helpBlock" class="help-block"><?=nl2br($objeto->obj_resumo)?></span>
				</div>
				<div class="form-group">
		       		<label>Objeto Público?</label>
		       		<span id="helpBlock" class="help-block"><?=($objeto->obj_publico=='1') ? 'Sim' : 'Não'?></span>
				</div>
								
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
		       		<label>Foto</label>
		       		<?php if(!empty($objeto->obj_foto1)):?>
						<a href="<?=base_url()?>uploads/obj_img/<?=$objeto->obj_id?>_foto.jpg" target="_blank"><img src="<?=base_url()?>uploads/obj_img/<?=$objeto->obj_id?>_thumb.jpg" onError="this.onerror=null;this.src='<?=base_url()?>img/img-nao-disponivel.jpg'"></a>
					<?php else:?>
						<br>
					<?php endif;?>	
				</div>				
				<div class="form-group">
		       		<label>Vídeo</label>
		       		<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_link_video) ? $objeto->obj_link_video : '<br>'?></span>
				</div>
				<div class="form-group">
		       		<label>Site</label>
		       		<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_link_site) ? $objeto->obj_link_site : '<br>'?></span>
				</div>
				<div class="form-group">
		       		<label>Facebook</label>
		       		<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_link_facebook) ? $objeto->obj_link_facebook : '<br>'?></span>
				</div>
				<div class="form-group">
		       		<label>YouTube</label>
		       		<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_link_youtube) ? $objeto->obj_link_youtube : '<br>'?></span>
				</div>
				<div class="form-group">
		       		<label>Outra rede social</label>
		       		<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_link_redesocial) ? $objeto->obj_link_redesocial : '<br>'?></span>
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
					<span id="helpBlock" class="help-block"><?=!empty($objeto->obj_info) ? nl2br($objeto->obj_info) : '<br>'?></span>
				</div>
 
		</div>
		<!--
		<div id="roteiro"></div>
		-->
	</div>
</div>