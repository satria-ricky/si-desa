<?php  

function cek_login()
{
	$ci = get_instance();
	$c = get_instance();

	$v_username = $ci->session->userdata('id_username');
	$v_level = $c->session->userdata('id_level');



	if (!$v_username) {
		redirect('dashboard');
	} 
	


}