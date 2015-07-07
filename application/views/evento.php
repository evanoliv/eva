<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
			
			<?=imprimeMsg()?>
			
			<legend>Avisos importantes</legend>
			
			<table class="table table-condensed table-hover tblApresentacao tblSemLinhas">
				<tbody>
					<?php if(isset($orcamento)):?>
						<tr>
							<td><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> O orçamento do evento está no negativo.</td>
						</tr>
					<?php endif;?>
					<?php foreach($avisoTarefas as $tarefa):?>
						<tr>
							<td><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Hoje é o prazo final da tarefa <a href="<?=base_url()?>iniciacao/showTarefa/<?=$tarefa->tar_id?>"><?=$tarefa->tar_titulo?></a> (prioridade <strong class="corPrioridadeTarefa"><?=$tarefa->tar_prioridade?></strong>).</td>
						</tr>
					<?php endforeach;?>
					<?php foreach($avisoTarefasNaoConcluidas as $tarefa):?>
						<tr>
							<td><span class="glyphicon glyphicon-time" aria-hidden="true"></span> A tarefa <a href="<?=base_url()?>iniciacao/showTarefa/<?=$tarefa->tar_id?>"><?=$tarefa->tar_titulo?></a> (prioridade <strong class="corPrioridadeTarefa"><?=$tarefa->tar_prioridade?></strong>) está atrasada desde <?=format_show($tarefa->tar_data_conclusao)?>.</td>
						</tr>
					<?php endforeach;?>
					<?php foreach($avisoDeslocamentos as $deslocamento):?>
						<tr>
							<td><span class="glyphicon glyphicon-road" aria-hidden="true"></span> A atração <a href="<?=base_url()?>evento/atracao/<?=$deslocamento->atracao->atr_id?>"><?=stripslashes($deslocamento->atracao->obj_nome)?></a> ainda não possui deslocamento registrado.</td>
						</tr>
					<?php endforeach;?>
					<?php foreach($avisoAcomodacoes as $acomodacao):?>
						<tr>
							<td><span class="glyphicon glyphicon-home" aria-hidden="true"></span> A atração <a href="<?=base_url()?>evento/atracao/<?=$acomodacao->atracao->atr_id?>"><?=stripslashes($acomodacao->atracao->obj_nome)?></a> ainda não possui acomodação registrada.</td>
						</tr>
					<?php endforeach;?>					
					<?php foreach($avisoAcomodacoesSolidarias as $acomodacao):?>
						<tr>
							<td><span class="glyphicon glyphicon-home" aria-hidden="true"></span> A atração <a href="<?=base_url()?>evento/atracao/<?=$acomodacao->atracao->atr_id?>"><?=stripslashes($acomodacao->atracao->obj_nome)?></a> não deseja uma <a href="<?=base_url()?>planejamento/showAcomodacao/<?=$acomodacao->aco_id?>">acomodação</a> solidária.</td>
						</tr>
					<?php endforeach;?>
					<?php foreach ($reunioes as $reuniao):?>
						<tr>
							<td><i class="fa fa-users"></i> Reunião hoje: <a href="<?=base_url()?>evento/showReuniao/<?=$reuniao->reu_id?>"><?=$reuniao->reu_titulo?></a>, às <?=format_time($reuniao->reu_hora)?>.</td>
						</tr>
					<?php endforeach;?>
						
				</tbody>
			</table>
			
			<legend>Últimas notícias</legend>
			
			<table class="table table-condensed table-hover tblApresentacao tblSemLinhas">
				<tbody>
					<?php if(!empty($noticias)):?>
						<?php foreach($noticias as $noticia):?>
							<tr><td>
								<?=format_data($noticia->not_criado_em)?> :: <a href="<?=base_url()?>evento/showNoticia/<?=$noticia->not_id?>"><strong><?=stripslashes($noticia->not_titulo)?></strong></a> por <a href="<?=base_url()?>evento/perfil/<?=$noticia->usu_id?>"><?=$noticia->usu_nome?></a><br>
							</tr></td>
						<?php endforeach;?>
					<?php else:?>
						<tr><td>
							Nenhuma notícia recente
						</tr></td>
					<?php endif;?>
				</tbody>
			</table>
			
			<legend>Atividades recentes</legend>
			
			<table class="table table-condensed table-hover tblApresentacao tblSemLinhas">
				<tbody>
					<?php if(!empty($atividades)):?>
						<?php foreach($atividades as $atividade):?>
							<tr><td>
								<?=format_data($atividade->ati_criado_em)?> :: <?=str_replace('base_url', base_url(), $atividade->ati_descricao)?><br>
							</td></tr>
						<?php endforeach;?>
					<?php else:?>
						<tr><td>Nenhuma atividade recente</td></tr>
					<?php endif;?>		
				</tbody>
			</table>

		</div>
		<!--
		<div id="roteiro"></div>
		-->
	</div>
</div>