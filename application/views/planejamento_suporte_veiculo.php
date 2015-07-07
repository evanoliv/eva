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
					<th>Modelo</th>
					<th>Placa</th>
					<th>Visualizar</th>
					<th>Editar</th>
					<th>Excluir</th>
				</thead>
				<tbody>
					<?php if(!empty($veiculos)):?>
						<?php foreach ($veiculos as $veiculo): ?>
							<tr>
								<td><?=$veiculo->vei_modelo?></td>
								<td><?=$veiculo->vei_placa?></td>
								<td><a href="<?=base_url()?>planejamento/showVeiculo/<?=$veiculo->vei_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>planejamento/editarVeiculo/<?=$veiculo->vei_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>planejamento/excluirVeiculo/<?=$veiculo->vei_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhum veículo cadastrado</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<a href="<?=base_url()?>planejamento/novoVeiculo"><button class="btn btn-primary">Novo veículo</button></a>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>