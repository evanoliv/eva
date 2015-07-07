<?php $this->load->view('header') ?>
	
<div class="container-fluid">
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
				<label>Cachê</label>
				<span id="helpBlock" class="help-block"><?='R$ '.number_format($atracao->atr_custo,2,',','.')?></span>
			</div>
			<div class="form-group">
				<label>Observações</label>
				<span id="helpBlock" class="help-block"><?=(isset($atracao->atr_observacao)) ? nl2br(stripslashes($atracao->atr_observacao)) : "<br><br>" ?></span>
			</div>
			<br>

			<legend><a href="<?=base_url()?>planejamento/programacao">Apresentações</a></legend>
			
			<table class="table table-hover tblLegend">
				<thead>
					<th><center>Ver</center></th>
					<th>Dia</th>
					<th>Hora</th>
					<th>Local</th>
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
								<td><a href="<?=base_url()?>evento/local/<?=$apresentacao->local->loc_id?>"><?=$apresentacao->local->obj_nome?></a></td>
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
										<?php endif;?>
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
			
			<legend><a href="<?=base_url()?>planejamento/suporte">Deslocamentos</a></legend>
		
			<table class="table table-hover tblLegend">
				<thead>
					<th><center>Ver</center></th>
					<th>Saída</th>
					<th>Origem</th>
					<th>Chegada</th>
					<th>Destino</th>
					<th>Motorista</th>
					<th>Veículo</th>
				</thead>
				<tbody>
					<?php if(!empty($deslocamentos)):?>
						<?php foreach ($deslocamentos as $deslocamento): ?>
							<tr>
								<td><center><a href="<?=base_url()?>planejamento/showDeslocamento/<?=$deslocamento->des_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></center></td>
								<td><?=format_data($deslocamento->des_saida)?></td>
								<td><?=str_replace('<br>','<br><br>',$deslocamento->des_origem)?></td>
								<td><?=format_data($deslocamento->des_chegada)?></td>
								<td><?=str_replace('<br>','<br><br>',$deslocamento->des_destino)?></td>
								<td><a href="<?=base_url()?>planejamento/showMotorista/<?=$deslocamento->mot_id?>"><?=$deslocamento->mot_nome?></a></td>
								<td><a href="<?=base_url()?>planejamento/showVeiculo/<?=$deslocamento->vei_id?>"><?=$deslocamento->vei_modelo?></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhum deslocamento registrado</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			
			<legend><a href="<?=base_url()?>planejamento/suporte">Acomodações</a></legend>
			
			<table class="table table-hover tblLegend">
				<thead>
					<th><center>Ver</center></th>
					<th>Hospedaria</th>
					<th>Chegada</th>
					<th>Saída</th>
					<th>Almoços</th>
					<th>Jantas</th>
					<th>Caterings</th>
				</thead>
				<tbody>
					<?php if(!empty($acomodacoes)):?>
						<?php foreach ($acomodacoes as $acomodacao): ?>
							<tr>
								<td><center><a href="<?=base_url()?>planejamento/showAcomodacao/<?=$acomodacao->aco_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></center></td>
								<td><a href="<?=base_url()?>planejamento/showHospedagem/<?=$acomodacao->hos_id?>"><?=$acomodacao->hos_nome?></a></td>
								<td><?=format_data($acomodacao->aco_chegada)?></td>
								<td><?=format_data($acomodacao->aco_saida)?></td>
								<td><?=$acomodacao->aco_almoco?></td>
								<td><?=$acomodacao->aco_janta?></td>
								<td><?=$acomodacao->aco_catering?></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma acomodação registrada</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<br>
			
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
			
		</div>
		<!--
		<div id="roteiro"></div>
		-->
	</div>
</div>