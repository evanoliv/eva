<?php $this->load->view('header') ?>
	
<div class="container-fluid">
	<div class="row">
		<div id="menu-lateral">
			<?php $this->load->view('menu_lateral') ?>
		</div>
		<div id="conteudo">

			Em breve		
			
		</div>
		<div id="roteiro" style="display: <?=($this->session->userdata('usu_roteiro') == '1') ? 'block' : 'none'?>;">
			<?php isset($roteiro) ? $this->load->view($roteiro) : ''?>
		</div>
	</div>
</div>