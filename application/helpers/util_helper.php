<?php

function debug($var){
	
	echo '<pre>';
	print_r($var);
	echo '</pre>';
		
	exit();
}

function imprimeMsg(){
	
	$CI = & get_instance();
	
	$string  = "<center><div class=msg_erro>";
	$string .= ($CI->session->userdata('msg_erro')) ? $CI->session->userdata('msg_erro') : '';
	$string .= "</div>";
	$string .= "<div class=msg_sucesso>";
	$string .= ($CI->session->userdata('msg_sucesso')) ? $CI->session->userdata('msg_sucesso') : '';
	$string .= "</div></center>";	

	$CI->session->unset_userdata('msg_erro'); 
	$CI->session->unset_userdata('msg_sucesso');
  	
	echo $string; 
	
}

function format_show($string)
{
	if(strpos($string,'-')){
		$array = explode('-',$string);
		return $array[2].'/'.$array[1].'/'.$array[0];
	}
	elseif(strlen($string) == 8)
        return preg_replace("/([0-9]{5})([0-9]{3})/", "$1-$2", $string);
    elseif(strlen($string) == 10)
        return preg_replace("/([0-9]{2})([0-9]{4})([0-9]{4})/", "($1) $2-$3", $string);
    elseif(strlen($string) == 11)
        return preg_replace("/([0-9]{2})([0-9]{5})([0-9]{4})/", "($1) $2-$3", $string);
    else
        return $string;
}

function format_data($string)
{
	$array = explode(' ',$string);
	$data = explode('-',$array[0]);
	$data = $data[2].'/'.$data[1].'/'.$data[0];
	return $data.' '.substr($array[1], 0, 5);	
}

function extract_data($string)
{
	$array = explode(' ',$string);
	return $array[0];	
}

function format_time($string)
{
	$array = explode(':',$string);
	$time = $array[0].':'.$array[1];
	return $time;	
}

function format_datetime($string)
{
	return str_replace(' ', 'T', $string);	
}

function format_weekday($string)
{
	if ($string == 'Wednesday') return 'Quarta-feira';
	if ($string == 'Thursday') return 'Quinta-feira';
	if ($string == 'Friday') return 'Sexta-feira';
	if ($string == 'Saturday') return 'Sábado';
	if ($string == 'Sunday') return 'Domingo';
	if ($string == 'Monday') return 'Segunda-feira';
	if ($string == 'Tuesday') return 'Terça-feira';	
}

function format_save_date($string)
{
	$date = '';
	$array = explode('/',$string);
	$date = $array[2].'-'.$array[1].'-'.$array[0];
	return $date;
}

function verifica_http($url)
{
	if(strpos($url,'://'))
		return $url;
	else 
		return 'http://'.$url;
}