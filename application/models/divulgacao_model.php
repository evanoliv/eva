<?php
Class Divulgacao_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
        
    public function getPecas()
    {
    	$query = $this->db->get('tbl_peca');
                
        return $query->result();
    }
    
    public function getMeios()
    {
    	$query = $this->db->get('tbl_meio');
                
        return $query->result();
    }
    
    public function cadastrarDivulgacao($divulgacao)
    {
    	$divulg['div_eve_id'] 			= $divulgacao['eve_id'];
    	$divulg['div_pec_id'] 			= $divulgacao['peca'];
    	$divulg['div_mei_id'] 			= $divulgacao['meio'];
    	$divulg['div_valor'] 			= str_replace(',','.',str_replace('.','',$divulgacao['valor']));
    	$divulg['div_descricao'] 		= addslashes($divulgacao['descricao']);
    	$divulg['div_criado_em'] 		= date("Y-m-d H:i:s");
    	$divulg['div_modificado_em'] 	= date("Y-m-d H:i:s");

    	$this->db->insert('tbl_divulgacao',$divulg);

    	$this->load->model('Cronograma_model','cronograma');
    	
    	$acao['categoria'] 	= 'Coordenação de Comunicação';
    	$acao['titulo'] 	= 'Divulgação da peça '.$this->getNomePeca($divulgacao['peca']);
    	$acao['descricao']	= addslashes($divulgacao['descricao']);
    	
    	$this->cronograma->cadastrarAcao($acao);
    } 
    
    public function editarDivulgacao($divulgacao)
    {
    	$divulg['div_pec_id'] 			= $divulgacao['peca'];
    	$divulg['div_mei_id'] 			= $divulgacao['meio'];
    	$divulg['div_valor'] 			= str_replace(',','.',str_replace('.','',$divulgacao['valor']));
    	$divulg['div_descricao'] 		= addslashes($divulgacao['descricao']);
    	$divulg['div_modificado_em'] 	= date("Y-m-d H:i:s");
    	    	
    	$this->db->where('div_id',$divulgacao['id']);
    	$this->db->update('tbl_divulgacao',$divulg);	    	
    }
    
    public function getDivulgacoes($eveId)
    {
    	$this->db->join('tbl_peca','tbl_divulgacao.div_pec_id = tbl_peca.pec_id');
    	$this->db->join('tbl_meio','tbl_divulgacao.div_mei_id = tbl_meio.mei_id');
    	$this->db->where('div_eve_id',$eveId);
    	$query = $this->db->get('tbl_divulgacao');
                
        return $query->result();    	
    }
    
    public function getSomaDivulgacoes($eveId)
    {
    	$this->db->where('div_eve_id',$eveId);
    	$this->db->select_sum('div_valor');
    	$query = $this->db->get('tbl_divulgacao');
                
        return reset($query->result());
    }
    
    public function getDivulgacao($divId)
    {
    	$this->db->join('tbl_peca','tbl_divulgacao.div_pec_id = tbl_peca.pec_id');
    	$this->db->join('tbl_meio','tbl_divulgacao.div_mei_id = tbl_meio.mei_id');
    	$this->db->where('div_id',$divId);
    	$query = $this->db->get('tbl_divulgacao');
                
        return reset($query->result());    	
    }
    
    public function excluirDivulgacao($divId)
    {
    	$this->db->where('div_id',$divId);
    	$this->db->delete('tbl_divulgacao');
    }
    
    public function getNomePeca($pecId)
    {
    	$this->db->where('pec_id',$pecId);
    	$query = $this->db->get('tbl_peca');
    	$peca = reset($query->result());
    	return $peca->pec_nome;
    }
    
}