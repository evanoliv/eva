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
					<th>Nome</th>
					<th>Visualizar</th>
					<th>Editar</th>
					<th>Excluir</th>
				</thead>
				<tbody>
					<?php if(!empty($motoristas)):?>
						<?php foreach ($motoristas as $motorista): ?>
							<tr>
								<td><?=$motorista->mot_nome?></td>
								<td><a href="<?=base_url()?>planejamento/showMotorista/<?=$motorista->mot_id?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>planejamento/editarMotorista/<?=$motorista->mot_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>planejamento/excluirMotorista/<?=$motorista->mot_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhum motorista cadastrado</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<a href="<?=base_url()?>planejamento/novoMotorista"><button class="btn btn-primary">Novo motorista</button></a>
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>