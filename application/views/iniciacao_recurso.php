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
					<th>Item</th>
					<th>Custo (R$)</th>
					<th>Editar</th>
					<th>Excluir</th>
				</thead>
				<tbody>
					<?php if(!empty($custos)):?>
						<?php foreach ($custos as $custo): ?>
							<tr>
								<td><?=$custo->ite_descricao?></td>
								<td><?=number_format($custo->cus_valor,2,',','.')?></td>
								<td><a href="<?=base_url()?>iniciacao/editarCusto/<?=$custo->cus_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>iniciacao/excluirCusto/<?=$custo->cus_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhum custo encontrado</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<div class="custoTotal">
				Total: R$ <?=number_format($custoTotal,2,',','.')?>
			</div>
			<br>
			<a href="<?=base_url()?>iniciacao/novoCusto"><button class="btn btn-primary">Novo custo</button></a>		
		
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>