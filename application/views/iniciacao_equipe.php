<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<legend>Equipe</legend>
			
			<?=imprimeMsg()?>
					
			<table class="table table-hover tblApresentacao">
				<tbody>
					<?php if(!empty($papeis)):?>
						<?php foreach ($papeis as $papel): ?>
							<tr>
								<td><a href="<?=base_url()?>evento/perfil/<?=$papel->usu_id?>"><?=$papel->usu_nome?></a></td>
								<td><?=$papel->pap_cargo?></td>
								<td><a href="<?=base_url()?>iniciacao/editarPapel/<?=$papel->pap_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
								<td><a href="<?=base_url()?>iniciacao/excluirPapel/<?=$papel->pap_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td>Nenhum membro encontrado</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<br>
			<a href="<?=base_url()?>iniciacao/novoPapel"><button class="btn btn-primary">Adicionar membro</button></a>		
		
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>