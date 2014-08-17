<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class security_model extends CI_Model
{
    var $array_url_free = array('signin','signup');

    function __construct()
	{
		parent::__construct();
	}

    public final function is_logged()
    {
        if($this->session->userdata('user_id'))
			return true;
		
        redirect('dashboard/signin');
    }
	
	public final function login_admin()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where(array('email' => $this->input->post("login", false), 'status_id' => 1));
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$data = $query->row_array();
			
			if($data['password'] == md5($this->input->post("password", false))){
				$this->session->set_userdata("user_id", $data['id']);
				$this->session->set_userdata("user_name", $data['name']);
				$this->session->set_userdata("user_admin", TRUE);
				
				return true;
			}
		}
		
		return false;
	}
}