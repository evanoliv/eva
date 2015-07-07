<?php $this->load->view('header') ?>

<div class="container-fluid">
	<div class="tela_inicial">
		<div class="row">
			<div id="menu-lateral">
				<?php $this->load->view('menu_lateral') ?>
			</div>
			<div id="conteudo">

				<legend>Notícia</legend>

				<form action="<?=base_url()?>evento/cadastrarNoticia" method="post" id="noticiaForm">
					
					<input value="<?=(!empty($noticia->not_id)) ? $noticia->not_id : "" ?>" class="registroId" type="hidden" name="noticia[id]">
					
					<div class="form-group">
		       			<label>Título *</label>
		       			<input value="<?=(!empty($noticia->not_titulo)) ? $noticia->not_titulo : "" ?>" class="formG form-control" type="text" maxlength="255" name="noticia[titulo]" required>
					</div>				
					<div class="form-group">
						<label>Texto *</label>
						<textarea class="formText form-control" name="noticia[descricao]" required><?=(isset($noticia->not_descricao)) ? $noticia->not_descricao : "" ?></textarea>
					</div>
					<br>
					<input type="submit" value="Enviar" class="btn btn-success">
						
				</form>
			
			</div>
		</div>
	</div>
</div>
