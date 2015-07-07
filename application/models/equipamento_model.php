<?php
Class Equipamento_model extends CI_Model{
	
 	function __construct()
    {
        parent::__construct();
    }	
    
    public function cadastrarEquipamento($equipamento)
    {
    	$equip['equ_obj_id']		= $equipamento['obj_id'];
    	$equip['equ_endereco']		= addslashes($equipamento['endereco']);
    	$equip['equ_numero']		= addslashes($equipamento['numero']);
    	$equip['equ_bairro']		= addslashes($equipamento['bairro']);
    	$equip['equ_complemento']	= addslashes($equipamento['complemento']);
    	$equip['equ_cidade']		= addslashes($equipamento['cidade']);
    	$equip['equ_estado']		= $equipamento['estado'];
    	$equip['equ_cep']			= preg_replace('/\D/','',$equipamento['cep']);
    	
    	$this->db->insert('tbl_equipamento',$equip);
    } 
    
    public function editarEquipamento($equipamento)
    {
    	$equip['equ_obj_id']		= $equipamento['obj_id'];
    	$equip['equ_endereco']		= addslashes($equipamento['endereco']);
    	$equip['equ_numero']		= addslashes($equipamento['numero']);
    	$equip['equ_bairro']		= addslashes($equipamento['bairro']);
    	$equip['equ_complemento']	= addslashes($equipamento['complemento']);
    	$equip['equ_cidade']		= addslashes($equipamento['cidade']);
    	$equip['equ_estado']		= $equipamento['estado'];
    	$equip['equ_cep']			= preg_replace('/\D/','',$equipamento['cep']);
    	
    	$this->db->where('equ_id',$equipamento['id']);
    	$this->db->update('tbl_equipamento',$equip);
    }
    
    public function excluirEquipamento($objId)
    {
    	$this->db->where('equ_obj_id',$objId);
    	$this->db->delete('tbl_equipamento');
    }
    
    public function getDadosEquipamento($objId)
    {
    	$this->db->where('equ_obj_id',$objId);
    	$query = $this->db->get('tbl_equipamento');
        $query = reset($query->result());
        
        return $query;
    }
    
    public function getEquipamentos($usuId)
    {
    	$this->db->join('tbl_objeto','tbl_objeto.obj_id = tbl_equipamento.equ_obj_id');
    	$this->db->where('obj_usu_id',$usuId);
    	$this->db->or_where('obj_publico','1');
    	$this->db->order_by('obj_nome','asc');
    	$query = $this->db->get('tbl_equipamento');
    	
    	return $query->result();
    }

    public function getEquipamentosByFiltro($filtro)
    {
    	$this->db->join('tbl_objeto','tbl_objeto.obj_id = tbl_equipamento.equ_obj_id');
    	$this->db->where('obj_usu_id',$filtro['usu_id']);
    	$this->db->or_where('obj_publico','1');
    	$this->db->like('obj_nome',$filtro['nome']);
    	$this->db->like('equ_cidade',$filtro['cidade']);
    	$this->db->order_by('obj_nome','asc');
    	$query = $this->db->get('tbl_equipamento');
    	
    	return $query->result();
    }    
}