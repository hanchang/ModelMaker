<?php

class Profile extends Controller {

	function Profile()
	{
		parent::Controller();	
		$this->lang->load('global');
		$this->load->model('profile_model');
		$this->load->model('users');
	}

	function index() {
		$user_id = $this->tank_auth->get_user_id();
		if ($user_id === FALSE) {
			redirect("auth/register");
		}
		else {
			redirect("profile/view/$user_id");
		}
		return;
	}
	
	function view($user_id = 0) {
		if ($user_id == $this->tank_auth->get_user_id() || $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			if ($user_id == 0) {
				redirect("profile/view/{$this->tank_auth->get_user_id()}");
			}
			
			$profile = $this->profile_model->getProfile($user_id);
			if (empty($profile)) {
				$this->template->load('template', 'profile/not_found');
				return;
			}
			$user = $this->users->get_user($user_id);
			$profile->email = $user->email;
			$profile->username = $user->username;
			$profile->debug = $profile;
			$this->template->load('template', 'profile/view', $profile);
			return;
		}
		else if ($this->tank_auth->get_user_id() === FALSE) {
			redirect("auth/login");
		}
		else {
			redirect("profile/view/$user_id");
			// redirect("profile/view/{$this->tank_auth->get_user_id()}");
		}
	}

	function edit() {
		$user_id = $this->tank_auth->get_user_id();
		if ($user_id === FALSE) {
			redirect('auth/login');
			return;
		}
		
		$username = $this->tank_auth->get_username();
		if ($username === FALSE) {
			redirect('auth/login');
			return;
		}
		
		// Required
		$this->form_validation->set_rules('name','name','required|trim|xss_clean|max_length[120]');	
		$this->form_validation->set_rules('gender','gender','required|trim|xss_clean');	
		$this->form_validation->set_rules('ethnicity','ethnicity','required|trim|xss_clean');
		$this->form_validation->set_rules('birthday_year','birthday_year','trim|required|numeric|callback_valid_date');
		$this->form_validation->set_rules('birthday_month','birthday_month','trim|required|numeric');
		$this->form_validation->set_rules('birthday_date','birthday_date','trim|required|numeric'); 
		$this->form_validation->set_rules('height','height','required|trim|xss_clean|is_numeric|max_length[11]');
		$this->form_validation->set_rules('weight','weight','required|trim|xss_clean|is_numeric|max_length[11]');
		$this->form_validation->set_rules('hair_color','hair_color','trim|xss_clean');
		$this->form_validation->set_rules('hair_length','hair_length','trim|xss_clean');
		$this->form_validation->set_rules('city','city','required|trim|xss_clean|max_length[32]');
		$this->form_validation->set_rules('telephone','telephone','required|trim|xss_clean|is_numeric|max_length[32]');	
		
		// Optional
		$this->form_validation->set_rules('nickname','nickname','trim|xss_clean|max_length[120]');
		$this->form_validation->set_rules('bra_size','bra_size','trim|xss_clean|str_to_upper|max_length[6]');
		$this->form_validation->set_rules('waist','waist','trim|xss_clean|is_numeric|max_length[11]');
		$this->form_validation->set_rules('hips','hips','trim|xss_clean|is_numeric|max_length[11]');
		$this->form_validation->set_rules('shoe_size','shoe_size','trim|xss_clean|is_numeric|max_length[11]');
		$this->form_validation->set_rules('bio','bio','trim|xss_clean|max_length[255]');

		$this->form_validation->set_error_delimiters('<br /><div class="error rounded">', '</div>');
		
		$form_success = $this->form_validation->run();
		
		$profile = $this->profile_model->getProfile($user_id);
		
		if (!$form_success) { // validation hasn'\t been passed, redo!
			if (empty($profile)) {
				$this->template->load('template', 'profile/edit', array('error' => '', 'upload_errors' => '', 'debug' => ''));
				return;
			}
			else {
				$profile->msg = 'validation failed or never occurred in the first place';
				$profile->error = validation_errors();
				$profile->upload_errors = '';
				$profile->debug = $profile; // DEBUG!
				
				$birthday = explode('-', $profile->birthday);
				$profile->birthday_year = $birthday[0];
				$profile->birthday_month = $birthday[1];
				$profile->birthday_date = $birthday[2];
				$this->template->load('template', 'profile/edit', $profile);
				return;
			}
		}
		else { // passed validation; proceed to post success logic
			$form_data = array(
				'id' => $user_id,
				'name' => set_value('name'),
				'gender' => set_value('gender'),
				'ethnicity' => set_value('ethnicity'),
				'birthday' => set_value('birthday_year') . '-' . set_value('birthday_month') . '-' . set_value('birthday_date'),
				'height' => set_value('height'),
				'weight' => set_value('weight'),
				'hair_color' => set_value('hair_color'),
				'hair_length' => set_value('hair_length'),
				'city' => set_value('city'),
				'telephone' => set_value('telephone'),
			
				'nickname' => set_value('nickname'),
				'bra_size' => set_value('bra_size'),
				'waist' => set_value('waist'),
				'hips' => set_value('hips'),
				'shoe_size' => set_value('shoe_size'),
				'bio' => set_value('bio'),
			);
			
			if (empty($profile)) {
				$database_success = $this->profile_model->addProfile($form_data);
			}
			else {
				$database_success = $this->profile_model->updateProfile($form_data);
			}

			if ($database_success) {
				redirect('profile/manage_pic');
			}
			else {
				$profile['msg'] = $this->upload->data();
				$profile['error'] = lang('profile.error');
				$profile['upload_errors'] = $this->upload->display_errors();
				$profile['face_success'] = $face;
				$profile['upper_success'] = $upper;
				$profile['full_success'] = $full;
				$profile['database_success'] = $database_success;
				$profile['debug'] = $profile;
				$this->template->load('template', 'profile/edit', $profile);
				return;
			}
		}
	}
	
	function manage_pic() {
		$user_id = $this->tank_auth->get_user_id();
		if ($user_id === FALSE) {
			redirect('auth/login');
			return;
		}
		
		$profile = $this->profile_model->getProfile($user_id);
		$data["pic_face"] = $profile->pic_face;
		$data["pic_upper"] = $profile->pic_upper;
		$data["pic_full"] = $profile->pic_full;
		
		$data["thumb_face"] = $profile->thumb_face;
		$data["thumb_upper"] = $profile->thumb_upper;
		$data["thumb_full"] = $profile->thumb_full;
		
		$this->template->load('template', "profile/photo_manager", $data);
		return;
	}
	
	function upload_pic($type) {
		$user_id = $this->tank_auth->get_user_id();
		if ($user_id === FALSE) {
			redirect("auth/login");
		}
		
		// Upload Config
		$upload_config['upload_path'] = 'img/uploads';
		// $upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
		$upload_config['allowed_types'] = 'jpg|jpeg';
		$upload_config['max_size'] = 250;
		$upload_config['overwrite'] = TRUE;
		$this->load->library('upload');
			
		$upload_config['file_name'] = $this->tank_auth->get_username() . '_' . $type;
		$this->upload->initialize($upload_config);
		$retval = $this->upload->do_upload("pic_$type");
		
		if (!$retval) {
			$error = array('error' => $this->upload->display_errors());
			$this->template->load('template', "profile/photo_error", $error);
		}
		else {
			$upload_data = $this->upload->data();
			$update['id'] = $user_id;
			$update["pic_$type"] = $upload_data['file_name'];
			$this->profile_model->updateProfile($update);
			
			redirect("profile/manage_pic#$type");
			// $data = array('upload_data' => $upload_data);
			// $this->template->load('template', "profile/photo_manager", $data);
		}
	}
	
	function crop_pic($type) {
		$username = $this->tank_auth->get_username();
		if ($username === FALSE) {
			redirect('auth/login');
			return;
		}
		
		$data['id'] = $this->tank_auth->get_user_id();
		
		$targ_w = $targ_h = 225;
		$jpeg_quality = 90;
		
		$src = site_url("img/uploads/{$username}_{$type}.jpg");
		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
		
		imagecopyresampled($dst_r,$img_r,0,0,$this->input->post("x$type"),$this->input->post("y$type"),
		    $targ_w,$targ_h,$this->input->post("w$type"),$this->input->post("h$type"));

		$output_filename = "img/uploads/{$username}_{$type}_thumb.jpg";
		$retval = imagejpeg($dst_r, $output_filename, $jpeg_quality);
		
		if ($retval) {
			$data["thumb_$type"] = $output_filename;
			$this->profile_model->updateProfile($data);
			
			redirect("profile/manage_pic#$type");
		}
		else {
			echo "ERROR: There was an issue creating the image.";
		}
	}
	
	function success() {
		$this->template->load('template', 'profile/success');
		return;
	}
	
	function remove() {
		if ($this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			// Remove user
		}
	}
	
	function valid_date() {
		if (!checkdate($this->input->post('birthday_month'), 
					$this->input->post('birthday_date'), 
					$this->input->post('birthday_year'))) 
		{
			$this->form_validation->set_message('valid_date', lang('profile.invalid_date'));
			return FALSE;
		}
		return TRUE;
	}
}

/* End of file profile.php */
/* Location: ./system/application/controllers/profile.php */
