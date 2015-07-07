<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
					
			<div class="filtro">
				<div class="filtroHeader">
					<div class="filtroTitulo">Busca por: <strong><?=!empty($nome) ? $nome : ''?></strong></div>
				</div>
				<form action="<?=base_url()?>responsavel/filtrar" method="get" id="responsavelFiltroFrom">
					Nome: <input class="formP" type="text" name="responsavel[nome]" maxlength="255">
					<input type="submit" value="Buscar" class="btn btn-info btn-filtro">
				</form>
			</div>
				
			<?=imprimeMsg()?>
					
			<table class="table table-hover">
				<thead>
					<th>Nome</th>
					<th>Visualizar</th>
					<th>Editar</th>
					<th>Excluir</th>
				</thead>
				<tbody>
					<?php if(!empty($responsaveis)):?>
						<?php foreach ($responsaveis as $responsavel): ?>
							<tr>
								<td><?=$responsavel->res_nome?></td>
								<td><a href="<?=base_url()?>responsavel/show/<?=$responsavel->res_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>responsavel/editar/<?=$responsavel->res_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>responsavel/excluir/<?=$responsavel->res_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhum responsável encontrado</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<a href="<?=base_url()?>responsavel/novo"><button class="btn btn-primary">Novo responsável</button></a>
			
		</div>
	</div>
</div>