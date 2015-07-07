<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
			
			<div class="filtro">
				<div class="filtroHeader">
					<div class="filtroTitulo">Busca por: <strong><?=!empty($filtro) ? $filtro : ''?></strong></div>
					<div class="filtroContagem">Reuniões encontradas: <strong><?=$reunioesEncontradas?></strong></div>
				</div>
				<form action="<?=base_url()?>evento/filtrarReunioes" method="get" id="reuniaoFiltroFrom">
					Data: <input class="formP" type="date" name="reuniao[data]" style="height: 26px">
					<input type="submit" value="Buscar" class="btn btn-info btn-filtro">
				</form>
			</div>
			
			<?=imprimeMsg()?>
			
			<legend>Reuniões</legend>
			
			<table class="table table-condensed table-hover tblApresentacao tblSemLinhas">
				<thead>
					<th style="width:15%">Data e hora</th>
					<th>Título</th>
					<th>Local</th>
					<th style="width:10%">Ações</th>
				</thead>
				<tbody>
					<?php if(!empty($reunioes)):?>
						<?php foreach($reunioes as $reuniao):?>
							<tr>
								<td><?=format_show($reuniao->reu_data)?> <?=format_time($reuniao->reu_hora)?></td>
								<td><?=$reuniao->reu_titulo?></td>
								<td><?=$reuniao->reu_local?></td>
								<td>
									<a href="<?=base_url()?>evento/showReuniao/<?=$reuniao->reu_id?>" title="Visualizar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
									<a href="<?=base_url()?>evento/editarReuniao/<?=$reuniao->reu_id?>" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
									<a href="<?=base_url()?>evento/excluirReuniao/<?=$reuniao->reu_id?>" title="Excluir" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
								</td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr><td>
							Nenhuma reunião marcada
						</tr></td>
					<?php endif;?>
				</tbody>
			</table>
			<a href="<?=base_url()?>evento/novoReuniao"><button class="btn btn-primary">Nova reunião</button></a>

		</div>
		<!--
		<div id="roteiro"></div>
		-->
	</div>
</div>