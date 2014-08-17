<?php if ( ! defined('BASEPATH') )exit( 'No direct script access allowed' );

class MY_Session extends CI_Session {
    
	public function __construct()
    {
		//session_set_cookie_params(0, '/', '.'.$_SERVER['HTTP_HOST']);
		ini_set("session.cookie_domain", '.'.$_SERVER['HTTP_HOST']);
		ini_set('session.gc_maxlifetime', 3*60*60);
		
		
        session_start();
		parent::__construct();
		$this->CI =& get_instance();
    }

    public function set_userdata($key, $value)
    {
        $_SESSION[$key] = $value;
    }
	
	public function unset_userdata($key)
    {
        unset($_SESSION[$key]);
    }

    public function userdata($key)
    {
        return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
    }
	
	public function userdata2($key1, $key2)
    {
        return isset( $_SESSION[$key1][$key2] ) ? $_SESSION[$key1][$key2] : null;
    }
	
	public function all_userdata()
    {
        return isset( $_SESSION ) ? $_SESSION : null;
    }
	
	
	public function sess_destroy()
	{
		session_destroy();
		unset($_SESSION);
	}
}