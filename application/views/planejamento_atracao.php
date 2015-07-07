<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">

			<?=imprimeMsg()?>
			
			<legend>Atrações selecionadas para o evento</legend>
			
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
								<td><a href="<?=base_url()?>evento/atracao/<?=$objeto->atr_id?>"><?=stripslashes($objeto->obj_nome)?></a></td>
								<td><a href="<?=base_url()?>responsavel/show/<?=$objeto->res_id?>"><?=$objeto->res_nome?></a></td>
								<td><?=$objeto->ssu_nome?></td>
								<td><?=number_format($objeto->atr_custo,2,',','.')?></td>
								<td><a href="<?=base_url()?>evento/removerAtracao/<?=$objeto->atr_id?>" title="Remover"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma atração foi selecionada</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<div class="custoTotal">
				Total em cachê: R$ <?=number_format($cacheTotal,2,',','.')?>
			</div>
			<br>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>