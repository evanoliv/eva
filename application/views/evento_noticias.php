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
					<div class="filtroContagem">Notícias encontradas: <strong><?=$noticiasEncontradas?></strong></div>
				</div>
				<form action="<?=base_url()?>evento/filtrarNoticias" method="get" id="noticiaFiltroFrom">
					Data: <input class="formP" type="date" name="noticia[data]" style="height: 26px">
					Título: <input class="formP" type="text" name="noticia[titulo]" maxlength="255">
					Usuário: <input class="formP" type="text" name="noticia[usuario]" maxlength="255">
					<input type="submit" value="Buscar" class="btn btn-info btn-filtro">
				</form>
			</div>
			
			<legend>Notícias</legend>
			
			<table class="table table-condensed table-hover tblApresentacao tblSemLinhas">
				<tbody>
					<?php if(!empty($noticias)):?>
						<?php foreach($noticias as $noticia):?>
							<tr><td>
								<?=format_data($noticia->not_criado_em)?> :: <a href="<?=base_url()?>evento/showNoticia/<?=$noticia->not_id?>"><strong><?=stripslashes($noticia->not_titulo)?></strong></a> por <a href="<?=base_url()?>evento/perfil/<?=$noticia->usu_id?>"><?=$noticia->usu_nome?></a><br>
							</tr></td>
						<?php endforeach;?>
					<?php else:?>
						<tr><td>
							Nenhuma notícia recente
						</tr></td>
					<?php endif;?>
				</tbody>
			</table>

		</div>
		<!--
		<div id="roteiro"></div>
		-->
	</div>
</div>