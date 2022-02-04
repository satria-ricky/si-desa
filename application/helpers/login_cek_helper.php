<?php  

function cek_login()
{
	$ci = get_instance();

	$v_username = $ci->session->userdata('id_username');

	if (!$v_username) {
		redirect('blocked');
	} 
	
}