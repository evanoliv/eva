<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<?=imprimeMsg()?>
					
			<table class="table table-hover">
				<thead>
					<th>Título</th>
					<th>Categoria</th>
					<th>Responsável</th>
					<th>Visualizar</th>
					<th>Editar</th>
					<th>Excluir</th>
				</thead>
				<tbody>
					<?php if(!empty($tarefas)):?>
						<?php foreach ($tarefas as $tarefa): ?>
							<tr>
								<td><?=$tarefa->tar_titulo?></td>
								<td><?=$tarefa->tar_categoria?></td>
								<td><a href="<?=base_url()?>evento/perfil/<?=$tarefa->usu_id?>"><?=$tarefa->usu_nome?></a></td>
								<td><a href="<?=base_url()?>iniciacao/showTarefa/<?=$tarefa->tar_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>iniciacao/editarTarefa/<?=$tarefa->tar_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>iniciacao/excluirTarefa/<?=$tarefa->tar_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma tarefa encontrada</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<br>
			<a href="<?=base_url()?>iniciacao/novoTarefa"><button class="btn btn-primary">Nova tarefa</button></a>		
		
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>