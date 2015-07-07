<?php
Class Cronograma_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
        
    public function cadastrarTarefa($tarefa)
    {
    	$taref['tar_usu_id'] 			= $tarefa['usuario'];
    	$taref['tar_eve_id'] 			= $tarefa['eve_id'];
    	$taref['tar_categoria']			= addslashes($tarefa['categoria']);
    	$taref['tar_titulo'] 			= addslashes($tarefa['titulo']);
    	$taref['tar_descricao']			= addslashes($tarefa['descricao']);
    	$taref['tar_situacao'] 			= addslashes($tarefa['situacao']);
    	$taref['tar_prioridade']		= addslashes($tarefa['prioridade']);
    	$taref['tar_data_inicio']		= $tarefa['data_inicio'];
    	$taref['tar_data_conclusao']	= $tarefa['data_conclusao'];
    	$taref['tar_tempo']				= $tarefa['tempo'];
    	$taref['tar_criado_em'] 		= date("Y-m-d H:i:s");
    	$taref['tar_modificado_em'] 	= date("Y-m-d H:i:s");

    	$this->db->insert('tbl_tarefa',$taref);
    	$id = $this->db->insert_id();
    	
    	$this->load->model('Usuario_model','usuario');
    	$usuario = $this->usuario->getUsuario($tarefa['usuario']);

    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $tarefa['eve_id'];
    	$ativ['ati_tar_id'] 	= $id;
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> criou uma nova tarefa: <a href="base_urliniciacao/showTarefa/'.$id.'">'.addslashes($tarefa['titulo']).'</a> (atribuída a <a href="base_urlevento/perfil/'.$usuario->usu_id.'">'.$usuario->usu_nome.'</a>, prioridade <strong class="corPrioridadeTarefa">'.$taref['tar_prioridade'].'</strong>).';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_atividade',$ativ);
    } 
    
    public function editarTarefa($tarefa)
    {
    	$taref['tar_usu_id'] 			= $tarefa['usuario'];
    	$taref['tar_categoria']			= addslashes($tarefa['categoria']);
    	$taref['tar_titulo'] 			= addslashes($tarefa['titulo']);
    	$taref['tar_descricao']			= addslashes($tarefa['descricao']);
    	$taref['tar_situacao'] 			= addslashes($tarefa['situacao']);
    	$taref['tar_prioridade']		= addslashes($tarefa['prioridade']);
    	$taref['tar_data_inicio']		= $tarefa['data_inicio'];
    	$taref['tar_data_conclusao']	= $tarefa['data_conclusao'];
    	$taref['tar_tempo']				= $tarefa['tempo'];
    	$taref['tar_modificado_em'] 	= date("Y-m-d H:i:s");
    	    	
    	$this->db->where('tar_id',$tarefa['id']);
    	$this->db->update('tbl_tarefa',$taref);
    	
    	$this->load->model('Usuario_model','usuario');
    	$usuario = $this->usuario->getUsuario($tarefa['usuario']);
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $tarefa['eve_id'];
    	$ativ['ati_tar_id'] 	= $tarefa['id'];
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> mudou a tarefa <a href="base_urliniciacao/showTarefa/'.$tarefa['id'].'">'.addslashes($tarefa['titulo']).'</a> para <strong class="corSituacaoTarefa">'.$tarefa['situacao'].'</strong> (atribuída a <a href="base_urlevento/perfil/'.$usuario->usu_id.'">'.$usuario->usu_nome.'</a>).';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_atividade',$ativ);
    }
    
    public function getTarefas($eveId)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_tarefa.tar_usu_id');
    	$this->db->where('tar_eve_id',$eveId);
    	$query = $this->db->get('tbl_tarefa');
                
        return $query->result();    	
    }
    
    public function getTarefasDivulgacao($eveId)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_tarefa.tar_usu_id');
    	$this->db->where('tar_eve_id',$eveId);
    	$this->db->where('tar_categoria','Coordenação de Comunicação');
    	$query = $this->db->get('tbl_tarefa');
                
        return $query->result();    	
    }
    
    public function getTarefasProducao($eveId)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_tarefa.tar_usu_id');
    	$this->db->where('tar_eve_id',$eveId);
    	$this->db->where('tar_categoria','Coordenação de Produção');
    	$query = $this->db->get('tbl_tarefa');
                
        return $query->result();
    }
    
    public function getTarefasByUsuario($usuId,$eveId)
    {
    	$this->db->order_by('tar_data_conclusao','asc');
    	$this->db->where('tar_eve_id',$eveId);
    	$this->db->where('tar_usu_id',$usuId);
    	$query = $this->db->get('tbl_tarefa');
                
        return $query->result();    	
    }
    
    public function getTarefasByDatas($campo,$data_inicial,$data_final)
    {
    	$this->db->where('tar_eve_id',$this->session->userdata('eve_id'));
   		$this->db->where($campo.' >=',$data_inicial);
   		$this->db->where($campo.' <=',$data_final);
   		$this->db->order_by($campo,'asc');
    	$query = $this->db->get('tbl_tarefa');
                
        return $query->result();
    }
    
    public function getTarefasNaoConcluidas($data)
    {
    	$this->db->where('tar_eve_id',$this->session->userdata('eve_id'));
   		$this->db->where('tar_data_conclusao <',$data);
   		$this->db->where('tar_situacao !=','Aprovada');
    	$query = $this->db->get('tbl_tarefa');
                
        return $query->result();
    }
    
    public function getTarefa($tarId)
    {
    	$this->db->join('tbl_usuario','tbl_usuario.usu_id = tbl_tarefa.tar_usu_id');
    	$this->db->where('tar_id',$tarId);
    	$query = $this->db->get('tbl_tarefa');
                
        return reset($query->result());    	
    }
    
    public function excluirTarefa($tarId)
    {
    	$this->db->where('tar_id',$tarId);
    	$query = $this->db->get('tbl_tarefa');
        $tarefa = reset($query->result()); 

        $this->db->where('tar_id',$tarId);
    	$this->db->delete('tbl_tarefa');
    	
    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $tarefa->tar_eve_id;
    	$ativ['ati_tar_id'] 	= $tarId;
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> excluiu a tarefa '.addslashes($tarefa->tar_titulo).'.';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_atividade',$ativ);
    }
    
    public function getAtividades($eveId,$limite)
    {
    	$this->db->where('ati_eve_id',$eveId);
    	$this->db->order_by('ati_id','desc');
    	$this->db->limit('25',$limite);
    	$query = $this->db->get('tbl_atividade');
                
        return $query->result();
    }
    
    public function getCountAtividades($eveId)
    {
    	$this->db->where('ati_eve_id',$eveId);
    	$this->db->from('tbl_atividade');
    	return $this->db->count_all_results();
    }
    
    public function getAtividadesByFiltro($filtro)
    {
    	$this->db->where('ati_eve_id',$filtro['eve_id']);
    	
    	if(!empty($filtro['data'])){
    		$this->db->where('ati_criado_em >=',$filtro['data'].' 00:00:00');
    		$this->db->where('ati_criado_em <=',$filtro['data'].' 23:59:59');
    	}
    	
   		$this->db->like('ati_descricao',$filtro['usuario']);
   		$this->db->like('ati_descricao',$filtro['tarefa']);
   		$this->db->like('ati_descricao',$filtro['situacao']);
   		$this->db->like('ati_descricao',$filtro['prioridade']);
    	$this->db->order_by('ati_criado_em','desc');
    	$query = $this->db->get('tbl_atividade');
                
        return $query->result();
    }
    
    //ações de custos e de divulgação
    public function cadastrarAcao($acao)
    {
    	$taref['tar_usu_id'] 			= $this->session->userdata('usu_id');
    	$taref['tar_eve_id'] 			= $this->session->userdata('eve_id');
    	$taref['tar_categoria']			= addslashes($acao['categoria']);
    	$taref['tar_titulo'] 			= addslashes($acao['titulo']);
    	$taref['tar_descricao']			= addslashes($acao['descricao']);
    	$taref['tar_situacao'] 			= 'Aberta';
    	$taref['tar_prioridade']		= 'Normal';
    	$taref['tar_criado_em'] 		= date("Y-m-d H:i:s");
    	$taref['tar_modificado_em'] 	= date("Y-m-d H:i:s");

    	$this->db->insert('tbl_tarefa',$taref);
    	$id = $this->db->insert_id();
    	
    	$this->load->model('Usuario_model','usuario');
    	$usuario = $this->usuario->getUsuario($this->session->userdata('usu_id'));

    	$ativ['ati_usu_id'] 	= $this->session->userdata('usu_id');
    	$ativ['ati_eve_id'] 	= $this->session->userdata('eve_id');
    	$ativ['ati_tar_id'] 	= $id;
    	$ativ['ati_descricao']	= '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <a href="base_urlevento/perfil/'.$this->session->userdata('usu_id').'">'.$this->session->userdata('usu_nome').'</a> criou uma nova tarefa: <a href="base_urliniciacao/showTarefa/'.$id.'">'.addslashes($acao['titulo']).'</a> (atribuída a <a href="base_urlevento/perfil/'.$usuario->usu_id.'">'.$usuario->usu_nome.'</a>, prioridade <strong class="corPrioridadeTarefa">'.$taref['tar_prioridade'].'</strong>).';
    	$ativ['ati_criado_em']	= date("Y-m-d H:i:s");
    	
    	$this->db->insert('tbl_atividade',$ativ);
    }
    
}