<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
			
			<legend>Usuário <?=$usuario->usu_nome?></legend>
			E-mail: <a href="mailto:<?=$usuario->usu_email?>"><?=$usuario->usu_email?></a><br>
			Criado em: <?=date_format(date_create($usuario->usu_criado_em),'d/m/Y H:i:s')?><br>
			Último acesso em: <?=date_format(date_create($usuario->usu_ultimo_login),'d/m/Y H:i:s')?>
			<br><br>
			<legend><a href="<?=base_url()?>evento/reuniao">Reuniões</a></legend>
						
			<table class="table table-condensed table-hover tblApresentacao tblSemLinhas">
				<thead>
					<th style="width:8%">Data</th>
					<th style="width:8%">Hora</th>
					<th>Título</th>
					<th>Local</th>
				</thead>
				<tbody>
					<?php if(!empty($reunioes)):?>
						<?php foreach($reunioes as $reuniao):?>
							<tr>
								<td class="corDataTarefa"><?=format_show($reuniao->reu_data)?></td>
								<td><?=format_time($reuniao->reu_hora)?></td>
								<td><a href="<?=base_url()?>evento/showReuniao/<?=$reuniao->reu_id?>"><?=$reuniao->reu_titulo?></a></td>
								<td><?=$reuniao->reu_local?></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr><td>
							Nenhuma reunião marcada
						</tr></td>
					<?php endif;?>
				</tbody>
			</table>
			
			<legend><a href="<?=base_url()?>execucao/<?=($this->session->userdata('usu_papel') == 'produtor') ? 'producao' : 'coordenacao' ?>">Participações</a></legend>
			
			<table class="table table-hover tblLegend">
				<thead>
					<th style="width:8%">Data</th>
					<th style="width:8%">Hora</th>
					<th>Atração</th>
					<th>Local</th>
				</thead>
				<tbody>
					<?php if(!empty($participacoes)):?>
						<?php foreach ($participacoes as $participacao):?>
							<tr>
								<td><?=format_show($participacao->apr_data)?></td>
								<td><?=format_time($participacao->apr_hora)?></td>
								<td><a href="<?=base_url()?>evento/atracao/<?=$participacao->atracao->atr_id?>"><?=$participacao->atracao->obj_nome?></a></td>
								<td><a href="<?=base_url()?>evento/local/<?=$participacao->local->loc_id?>"><?=$participacao->local->obj_nome?></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma participação registrada</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			
			<legend>Tarefas</legend>
						
			<table class="table table-hover table-condensed tblLegend">
				<thead>
					<th>Título</th>
					<th>Situação</th>
					<th>Prioridade</th>
					<th>Data de conclusão</th>
				</thead>
				<tbody>
					<?php if(!empty($tarefas)):?>
						<?php foreach ($tarefas as $tarefa): ?>
							<tr>
								<td><a href="<?=base_url()?>iniciacao/editarTarefa/<?=$tarefa->tar_id?>"><?=$tarefa->tar_titulo?></a></td>
								<td class="corSituacaoTarefa"><?=$tarefa->tar_situacao?></td>
								<td class="corPrioridadeTarefa"><?=$tarefa->tar_prioridade?></td>
								<td class="corDataTarefa"><?=format_show($tarefa->tar_data_conclusao)?></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma tarefa encontrada</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>	

		</div>
	</div>
</div>