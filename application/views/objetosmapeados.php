<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">
		
			<div class="filtro">
				<div class="filtroHeader">
					<div class="filtroTitulo">Busca por: <strong><?=!empty($filtro) ? $filtro : ''?> <?=!empty($responsavel_filtro) ? $responsavel_filtro : ''?></strong></div>
					<div class="filtroContagem">Objetos encontrados: <strong><?=$objetosEncontrados?></strong></div>
				</div>
				<form action="<?=base_url()?>mapeamento/filtrar<?='/'.$usuId?>" method="get" id="objetoFiltroFrom">
					Nome: <input class="formP" type="text" name="objeto[nome]" maxlength="255">
					Tipo:
					<select class="formP" name="objeto[tipo]" id="tipo_objeto">
						<option value=""></option>
						<?php foreach ($subtipos as $subtipo):?>
							<optgroup label="<?=htmlspecialchars($subtipo->sub_nome)?>">
							<?php foreach ($subsubtipos as $subsubtipo):?>
								<?php if($subsubtipo->ssu_sub_id == $subtipo->sub_id):?>
									<option value="<?=$subsubtipo->ssu_id?>"><?=$subsubtipo->ssu_nome?></option>
								<?php endif;?>
							<?php endforeach;?>
							</optgroup>
						<?php endforeach;?>
					</select>
					Instituição: <input class="formP" type="text" name="objeto[responsavel]" maxlength="255">
					<input type="submit" value="Buscar" class="btn btn-info btn-filtro">
				</form>
			</div>
			<?php if(!empty($objetos)):?>
				<?php foreach($objetos as $objeto):?>
					<div class="objeto_mapeado">
						<a href="<?=base_url()?>objeto/show/<?=$objeto->obj_id?>"><img src="<?=base_url()?>uploads/obj_img/<?=$objeto->obj_id?>_thumb.jpg" onError="this.onerror=null;this.src='<?=base_url()?>img/img-nao-disponivel.jpg'"></a>
						<div class="info_objeto">
							<strong><a href="<?=base_url()?>objeto/show/<?=$objeto->obj_id?>"><?=stripslashes($objeto->obj_nome)?></a></strong><br>
							<?=$objeto->subsubtipo_nome?><br>
							<?=$objeto->res_instituicao?><br>
							Responsável: <a href="<?=base_url()?>responsavel/show/<?=$objeto->res_id?>"><?=$objeto->res_nome?></a> (<?=$objeto->res_cidade?>/<?=$objeto->res_estado?>)
						</div>
					</div>
				<?php endforeach;?>
			<?php else:?>
				<div class="objeto_mapeado">
					Nenhum objeto encontrado
				</div>
			<?php endif;?>
		</div>
		<!--
		<div id="roteiro"></div>
		-->
	</div>
</div>