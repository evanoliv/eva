<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<?=imprimeMsg()?>
			
			<form action="<?=base_url()?>iniciacao/cadastrarDefinicao" method="post" id="definicaoForm">
				
				<legend>Locais de realização</legend>

				<table class="table table-hover tblApresentacao">
					<tbody>
						<?php if(!empty($locais)):?>
			       				<?php foreach ($locais as $local):?>
								<tr>
									<td><a href="<?=base_url()?>evento/local/<?=$local->loc_id?>"><?=$local->obj_nome?></a></td>
									<td><?=$local->equ_cidade?>/<?=$local->equ_estado?></td>
									<td><a href="<?=base_url()?>iniciacao/editarLocal/<?=$local->loc_id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
									<td><a href="<?=base_url()?>iniciacao/excluirLocal/<?=$local->loc_id?>" class="excluirRegistro"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
								</tr>
							<?php endforeach;?>
						<?php else:?>
							<tr>
								<td>Nenhum local definido</td>
							</tr>
						<?php endif;?>
					</tbody>
				</table>
				
				<span id="helpBlock" class="help-block" style="margin-top: 20px; padding-left: 0px;">Locais são Equipamentos, <a href="<?=base_url()?>objeto/novo" target="_blank">clique aqui para cadastrar um novo equipamento.</a></span>
				<a href="<?=base_url()?>iniciacao/novoLocal" class="btn btn-primary">Novo local</a>
					
			</form>
		
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>