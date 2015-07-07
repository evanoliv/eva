<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
						
			<div class="filtro">
				<form action="<?=base_url()?>evento/calendario" method="post" id="calendarioFiltroFrom">
					De <input value="<?=$data_inicial?>" class="formP" type="date" name="periodo[inicial]" style="height: 26px" required>
					até <input value="<?=$data_final?>" class="formP" type="date" name="periodo[final]" style="height: 26px" required>
					<input type="submit" value="Buscar" class="btn btn-info btn-filtro">
				</form>
			</div>
			
			<?php foreach ($diasEvento as $dia):?>

				<legend>Dia <?=format_show($dia->selected_date)?> - <?=format_weekday(date('l', strtotime($dia->selected_date)))?></legend>
				
				<table class="table table-hover tblApresentacao">
					<tbody>
						<?php foreach ($tarefasInicio as $tarefa):?>
							<?php if($tarefa->tar_data_inicio == $dia->selected_date):?>
								<tr>
									<td><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Início da tarefa <a href="<?=base_url()?>iniciacao/showTarefa/<?=$tarefa->tar_id?>"><?=$tarefa->tar_titulo?></a> (prioridade <strong class="corPrioridadeTarefa"><?=$tarefa->tar_prioridade?></strong>).</td>
								</tr>
							<?php endif;?>
						<?php endforeach;?>
						<?php foreach ($tarefasConclusao as $tarefa):?>
							<?php if($tarefa->tar_data_conclusao == $dia->selected_date):?>
								<tr>
									<td><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Término da tarefa <a href="<?=base_url()?>iniciacao/showTarefa/<?=$tarefa->tar_id?>"><?=$tarefa->tar_titulo?></a> (prioridade <strong class="corPrioridadeTarefa"><?=$tarefa->tar_prioridade?></strong>).</td>
								</tr>
							<?php endif;?>
						<?php endforeach;?>
						<?php foreach ($apresentacoes as $apresentacao):?>
							<?php if($apresentacao->apr_data == $dia->selected_date):?>
								<tr>
									<td><span class="glyphicon glyphicon-apple" aria-hidden="true"></span> <a href="<?=base_url()?>planejamento/showApresentacao/<?=$apresentacao->apr_id?>">Apresentação</a> da atração <a href="<?=base_url()?>evento/atracao/<?=$apresentacao->atracao->atr_id?>"><?=$apresentacao->atracao->obj_nome?></a> no local <a href="<?=base_url()?>evento/local/<?=$apresentacao->local->loc_id?>"><?=$apresentacao->local->obj_nome?></a></td>
								</tr>
							<?php endif;?>
						<?php endforeach;?>
						<?php foreach ($deslocamentosSaida as $deslocamento):?>
							<?php if(extract_data($deslocamento->des_saida) == $dia->selected_date):?>
								<tr>
									<td><span class="glyphicon glyphicon-road" aria-hidden="true"></span> Saída do <a href="<?=base_url()?>planejamento/showDeslocamento/<?=$deslocamento->des_id?>">deslocamento</a> da atração <a href="<?=base_url()?>evento/atracao/<?=$deslocamento->atracao->atr_id?>"><?=$deslocamento->atracao->obj_nome?></a>.</td>
								</tr>
							<?php endif;?>
						<?php endforeach;?>
						<?php foreach ($deslocamentosChegada as $deslocamento):?>
							<?php if(extract_data($deslocamento->des_chegada) == $dia->selected_date):?>
								<tr>
									<td><span class="glyphicon glyphicon-road" aria-hidden="true"></span> Chegada do <a href="<?=base_url()?>planejamento/showDeslocamento/<?=$deslocamento->des_id?>">deslocamento</a> da atração <a href="<?=base_url()?>evento/atracao/<?=$deslocamento->atracao->atr_id?>"><?=$deslocamento->atracao->obj_nome?></a>.</td>
								</tr>
							<?php endif;?>
						<?php endforeach;?>
						<?php foreach ($acomodacoesChegada as $acomodacao):?>
							<?php if(extract_data($acomodacao->aco_chegada) == $dia->selected_date):?>
								<tr>
									<td><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="<?=base_url()?>planejamento/showAcomodacao/<?=$acomodacao->aco_id?>">Check-in</a> da atração <a href="<?=base_url()?>evento/atracao/<?=$acomodacao->atracao->atr_id?>"><?=$acomodacao->atracao->obj_nome?></a> na hospedaria <a href="<?=base_url()?>planejamento/showHospedagem/<?=$acomodacao->hos_id?>"><?=$acomodacao->hos_nome?></a>.</td>
								</tr>
							<?php endif;?>
						<?php endforeach;?>
						<?php foreach ($acomodacoesSaida as $acomodacao):?>
							<?php if(extract_data($acomodacao->aco_saida) == $dia->selected_date):?>
								<tr>
									<td><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="<?=base_url()?>planejamento/showAcomodacao/<?=$acomodacao->aco_id?>">Check-out</a> da atração <a href="<?=base_url()?>evento/atracao/<?=$acomodacao->atracao->atr_id?>"><?=$acomodacao->atracao->obj_nome?></a> da hospedaria <a href="<?=base_url()?>planejamento/showHospedagem/<?=$acomodacao->hos_id?>"><?=$acomodacao->hos_nome?></a>.</td>
								</tr>
							<?php endif;?>
						<?php endforeach;?>
						<?php foreach ($reunioes as $reuniao):?>
							<?php if($reuniao->reu_data == $dia->selected_date):?>
								<tr>
									<td><i class="fa fa-users"></i> Reunião: <a href="<?=base_url()?>evento/showReuniao/<?=$reuniao->reu_id?>"><?=$reuniao->reu_titulo?></a>, às <?=format_time($reuniao->reu_hora)?>.</td>
								</tr>
							<?php endif;?>
						<?php endforeach;?>
					</tbody>
				</table>

			<?php endforeach;?>

		</div>
	</div>
</div>