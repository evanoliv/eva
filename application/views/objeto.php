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
					<div class="filtroContagem">Objetos encontrados: <strong><?=$objetosEncontrados?></strong></div>
				</div>
				<form action="<?=base_url()?>objeto/filtrar" method="get" id="objetoFiltroFrom">
					Nome: <input class="formP" type="text" name="objeto[nome]" maxlength="255">
					Tipo:
					<select class="formP" name="objeto[tipo]" id="tipo_objeto">
						<option value=""></option>
						<?php foreach ($tipos as $tipo):?>
							<option value="<?=$tipo->tip_id?>" <?=(isset($tipo_filtro)) ? ($tipo_filtro == $tipo->tip_id) ? 'selected' : '' : ''?>><?=$tipo->tip_nome?></option>
						<?php endforeach;?>
					</select>
					Responsável:
					<select class="formP" name="objeto[responsavel]">
						<option value=""></option>
						<?php foreach ($responsaveis as $responsavel):?>
							<option value="<?=$responsavel->res_id?>" <?=(!empty($responsavel_filtro)) ? ($responsavel_filtro == $responsavel->res_id) ? 'selected' : '' : ''?>><?=$responsavel->res_nome?></option>
						<?php endforeach;?>
					</select>
					<input type="submit" value="Buscar" class="btn btn-info btn-filtro">
				</form>
			</div>
			
			<?=imprimeMsg()?>		
			
			<table class="table table-hover">
				<thead>
					<th>Nome</th>
					<th>Tipo</th>
					<th>Ações</th>
				</thead>
				<tbody>
					<?php if(!empty($objetos)):?>
						<?php foreach ($objetos as $objeto): ?>
							<tr>
								<td><?=$objeto->obj_nome?></td>
								<td><?=$objeto->subsubtipo_nome?></td>
								<td><a href="<?=base_url()?>objeto/show/<?=$objeto->obj_id?>" title="Visualizar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
									<a href="<?=base_url()?>objeto/editar/<?=$objeto->obj_id?>" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
									<a href="<?=base_url()?>objeto/excluir/<?=$objeto->obj_id?>" title="Excluir" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhum objeto encontrado</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<a href="<?=base_url()?>objeto/novo"><button class="btn btn-primary">Novo objeto</button></a>
			
		</div>
	</div>
</div>