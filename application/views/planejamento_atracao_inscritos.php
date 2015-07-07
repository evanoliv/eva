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
					<div class="filtroContagem">Atrações encontradas: <strong><?=$objetosEncontrados?></strong></div>
				</div>
				<form action="<?=base_url()?>planejamento/filtrarInscricao" method="get" id="inscricaoFiltroFrom">
					Nome: <input class="formP" type="text" name="objeto[nome]" maxlength="255">
					Tipo:
					<select class="formP" name="objeto[tipo]" id="tipo_objeto">
						<option value=""></option>
						<?php foreach ($subtipos as $subtipo):?>
							<optgroup label="<?=htmlspecialchars($subtipo->sub_nome)?>">
							<?php foreach ($subsubtipos as $subsubtipo):?>
								<?php if($subsubtipo->ssu_sub_id == $subtipo->sub_id):?>
									<option value="<?=$subsubtipo->ssu_id?>"><?=$subsubtipo->ssu_nome?></option>
								<?php endif;?>
							<?php endforeach;?>
							</optgroup>
						<?php endforeach;?>
					</select>
					Responsável: <input class="formP" type="text" name="objeto[responsavel]" maxlength="255">
					<input type="submit" value="Buscar" class="btn btn-info btn-filtro">
				</form>
			</div>
			
			<?=imprimeMsg()?>
			
			<table class="table table-hover">
				<thead>
					<th>Nome</th>
					<th>Responsável</th>
					<th>Tipo</th>
					<th>Cachê (R$)</th>
					<th>Ações</th>
				</thead>
				<tbody>
					<?php if(!empty($objetos)):?>
						<?php foreach ($objetos as $objeto): ?>
							<tr>
								<td><a href="<?=base_url()?>evento/showAtracao/<?=$objeto->atr_id?>"><?=stripslashes($objeto->obj_nome)?></a></td>
								<td><a href="<?=base_url()?>responsavel/show/<?=$objeto->res_id?>"><?=$objeto->res_nome?></a></td>
								<td><?=$objeto->ssu_nome?></td>
								<td><?=number_format($objeto->atr_custo,2,',','.')?></td>
								<td><a href="<?=base_url()?>evento/selecionarAtracao/<?=$objeto->atr_id?>" title="Selecionar"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma atração inscrita</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>