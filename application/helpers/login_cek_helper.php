<?php  

function cek_login()
{
	$ci = get_instance();

	$v_id = $ci->session->userdata('id_user');
	$v_level = $ci->session->userdata('level_user');

	if (!$v_id) {
		redirect('blocked');
	} else {

		$menu = $ci->uri->segment(1);

		if (($v_level == 2 || $v_level == 3) && $menu == 'admin' ) {
			redirect('blocked');
		}else if ($v_level == 1 && $menu == 'dashboard') {
			redirect('blocked');
		}
	}
	
}