<?php
Class Reuniao_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarReuniao($reuniao)
    {
    	$reun['reu_eve_id']			= $reuniao['eve_id'];
    	$reun['reu_titulo']			= addslashes($reuniao['titulo']);
    	$reun['reu_data']			= $reuniao['data'];
    	$reun['reu_hora']			= $reuniao['hora'];
    	$reun['reu_local']			= addslashes($reuniao['local']);
    	$reun['reu_pauta']			= addslashes($reuniao['pauta']);
    	$reun['reu_ata']			= addslashes($reuniao['ata']);
    	$reun['reu_criado_em']		= date("Y-m-d H:i:s");
    	$reun['reu_modificado_em']	= date("Y-m-d H:i:s");
    	    	
    	$this->db->insert('tbl_reuniao',$reun);
    	$reuId = $this->db->insert_id();
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<i class="fa fa-users"></i> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> marcou uma reunião: <a href="base_urlevento/showReuniao/'.$reuId.'">'.addslashes($reuniao['titulo']).'</a>, para o dia '.format_show($reuniao['data']).'.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_atividade',$ativ);
    	
    	return $reuId;
    }

    public function editarReuniao($reuniao)
    {
    	$reun['reu_titulo']			= addslashes($reuniao['titulo']);
    	$reun['reu_data']			= $reuniao['data'];
    	$reun['reu_hora']			= $reuniao['hora'];
    	$reun['reu_local']			= addslashes($reuniao['local']);
    	$reun['reu_pauta']			= addslashes($reuniao['pauta']);
    	$reun['reu_ata']			= addslashes($reuniao['ata']);
    	$reun['reu_modificado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->where('reu_id',$reuniao['id']);
    	$this->db->update('tbl_reuniao',$reun);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<i class="fa fa-users"></i> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> editou a reunião: <a href="base_urlevento/showReuniao/'.$reuniao['id'].'">'.addslashes($reuniao['titulo']).'</a>, do dia '.format_show($reuniao['data']).'.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_atividade',$ativ);
    }
    
    public function excluirReuniao($reuId)
    {
    	$reuniao = $this->getDadosReuniao($reuId);
    	
    	$this->db->where('pre_reu_id',$reuId);
    	$this->db->delete('tbl_presenca');	  
    	
    	$this->db->where('reu_id',$reuId);
    	$this->db->delete('tbl_reuniao');	    		

    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_descricao']	= '<i class="fa fa-users"></i> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> excluiu a reunião: '.addslashes($reuniao->reu_titulo).', do dia '.format_show($reuniao->reu_data).'.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_atividade',$ativ);
    }
    
    public function getDadosReuniao($reuId)
    {
    	$this->db->where('reu_id',$reuId);
    	$query = $this->db->get('tbl_reuniao');

    	return reset($query->result());
    }
    
    public function getReunioesByEvento($eveId,$limite)
    {
    	$this->db->where('reu_eve_id',$eveId);
    	$this->db->order_by('reu_data','desc');
    	$this->db->limit($limite);
    	$query = $this->db->get('tbl_reuniao');
    	
    	return $query->result();
    }
    
    public function getReunioesByFiltro($filtro)
    {
    	$this->db->where('reu_eve_id',$filtro['eve_id']);
   		$this->db->where('reu_data >=',$filtro['data']);
   		$this->db->where('reu_data <=',$filtro['data']);
    	$this->db->order_by('reu_data','desc');
    	$this->db->limit('50');
    	$query = $this->db->get('tbl_reuniao');
    	
    	return $query->result();
    }
    
    public function getReunioesByDatas($data_inicial,$data_final)
    {
    	$this->db->where('reu_eve_id',$this->session->userdata('eve_id'));
   		$this->db->where('reu_data >=',$data_inicial);
   		$this->db->where('reu_data <=',$data_final);
   		$this->db->order_by('reu_data','asc');
    	$query = $this->db->get('tbl_reuniao');
                
        return $query->result();
    }
    
    public function getReunioesByUsuario($usuId,$eveId)
    {
    	$this->db->join('tbl_reuniao','tbl_reuniao.reu_id = tbl_presenca.pre_reu_id');
    	$this->db->join('tbl_papel','tbl_papel.pap_id = tbl_presenca.pre_pap_id');
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_papel.pap_usu_id');
    	$this->db->where('reu_eve_id',$eveId);
    	$this->db->where('usu_id',$usuId);
    	$this->db->order_by('reu_data');
    	$this->db->order_by('reu_hora');
    	$query = $this->db->get('tbl_presenca');
    	
    	return $query->result(); 
    }
    
    public function cadastrarPresenca($presentes,$reuId)
    {
    	$this->db->where('pre_reu_id',$reuId);
    	$this->db->delete('tbl_presenca');	  	
    	
    	foreach ($presentes as $presente){
    		$presenca['pre_reu_id'] = $reuId;
    		$presenca['pre_pap_id'] = $presente;
    		$this->db->insert('tbl_presenca',$presenca);
    	}
    }
    
    public function getPresencaReuniao($reuId)
    {
    	$this->db->select('pre_pap_id');
    	$this->db->where('pre_reu_id',$reuId);
    	$query = $this->db->get('tbl_presenca');
    	
    	return $query->result();
    }
}