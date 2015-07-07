<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend><?=stripslashes($noticia->not_titulo)?></legend>
				<div class="subtituloNoticia">Enviado por <a href="<?=base_url()?>evento/perfil/<?=$noticia->usu_id?>"><?=$noticia->usu_nome?></a> em <?=format_data($noticia->not_criado_em)?></div>
				
				<span><?=nl2br(stripslashes($noticia->not_descricao))?></span>
				<br>
				<br>
			
				<?php if(($this->session->userdata('usu_id')) && ($noticia->not_usu_id == $this->session->userdata('usu_id'))):?>
					<a href="<?=base_url()?>evento/editarNoticia/<?=$noticia->not_id?>" class="btn btn-success">Editar</a>
					<a href="<?=base_url()?>evento/excluirNoticia/<?=$noticia->not_id?>" class="btn btn-danger excluirRegistro">Excluir</a>
				<?php endif;?>
						
			</div>
		</div>
	</div>
</div>
