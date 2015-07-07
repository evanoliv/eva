<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checksession
{
	private $CI;

	public function __construct()
    {
    	$this->CI =&get_instance();
    }
            
    public function index()
    {
		$controllers_permitidas = array();
    	array_push($controllers_permitidas,'mapeamento','objeto','responsavel','site','usuario','login','eva');
            
        if(!in_array($this->CI->router->fetch_class(),$controllers_permitidas)){
 
        	//permissão para cadastrar novo papel no sistema
        	if($this->CI->router->fetch_class() == 'iniciacao'){
        		if(!$this->CI->router->fetch_method() == 'cadastrarPapel'){
        			if(!($this->CI->session->userdata('usu_id'))){
            			redirect('login');
          			}
        		}
        	} elseif(!($this->CI->session->userdata('usu_id'))){
            	redirect('login');
          	}

		}
	}
		
}