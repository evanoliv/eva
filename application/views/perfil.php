<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
	
			<?=imprimeMsg()?>
			
			<legend>Meus produtos inscritos em eventos</legend>
	
			<table class="table table-hover">
				<thead>
					<th>Produto</th>
					<th>Evento</th>
					<th>Ações</th>
				</thead>
				<tbody>
					<?php if(!empty($objetos)):?>
						<?php foreach ($objetos as $objeto): ?>
							<tr>
								<td><a href="<?=base_url()?>objeto/show/<?=$objeto->obj_id?>"><?=$objeto->obj_nome?></a></td>
								<td><a href="<?=base_url()?>objeto/evento/<?=$objeto->eve_id?>"><?=$objeto->eve_nome?></a></td>
								<td><a href="<?=base_url()?>evento/editarAtracao/<?=$objeto->atr_id?>" title="Editar inscrição"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
									<a href="<?=base_url()?>evento/excluirAtracao/<?=$objeto->atr_id?>" title="Remover inscrição" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhuma inscrição encontrada</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			
		</div>
	</div>
</div>