<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class category_model extends CI_Model{

	private $tablename_admin, $tablename_seller;

	public final function __construct()
	{
		parent::__construct();
		
		$this->tablename = 'category';
	}
	
	function getAll( $where=false, $content=false)
	{
		if($content==false)
			$this->db->select('*');
		else
			$this->db->select($content);
		
		$this->db->from($this->tablename);
		
		if($where!=false)
			$this->db->where($where);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->row_array();
		else
			return false;
	}

	function save($id = false)
	{
		$data = array(
			'name' 				=> $this->input->post('name', FALSE)
		);
		
		if(intval($id) > 0){
			
			$data['updated_in']	= date('Y-m-d H:i:s');
			
			if($this->db->get_where($this->tablename, array('id' => $id))->num_rows() == 1){
				if($this->db->where(array('id' => $id))->update($this->tablename, $data)){
					return true;
				}
			}
		}else{
			
			$data['created_in']	= date('Y-m-d H:i:s');
			
			if($this->db->insert($this->tablename, $data)){
				return true;
			}
		}
		
        return FALSE;
	}
	
	function lista($pagina, $where = array())
	{
		if($where){
			$where = base64_decode($where);
			
			parse_str($where, $where);
			
			if(!empty($where['id'])){
				$this->db->where('id', $where['id']);
			}
			
			if(!empty($where['name'])){
				$this->db->like('name' , $where['name']);
			}
			
			if(!empty($where['status_id'])){
				
				$where['status_id'] = ($where['status_id'] == 2) ? 0 : $where['status_id'];
				
				$this->db->where('status_id', $where['status_id']);
			}
		}
		
		$this->db->select('*');
        $this->db->from($this->tablename);
		$this->db->order_by('status_id', 'desc');
		$this->db->order_by('id', 'desc');
		
		$inicio = ($pagina * PAG_ADMIN) - PAG_ADMIN;
        $this->db->limit(PAG_ADMIN, $inicio);
		
        $query = $this->db->get();
		
		return $query->result_array();
	}

	function total($where = array())
	{
		if($where){
			$where = base64_decode($where);
			
			parse_str($where, $where);
			
			if(!empty($where['id'])){
				$this->db->where('id', $where['id']);
			}
			
			if(!empty($where['name'])){
				$this->db->like('name' , $where['name']);
			}
			
			if(!empty($where['status_id'])){
				$this->db->where('status_id', $where['status_id']);
			}
		}
		
 		$this->db->select('*');
        $this->db->from($this->tablename);
		
		return $this->db->get()->num_rows();
	}
	
	public final function change_status($id, $post)
	{
		if($this->db->get_where($this->tablename, array('id' => $id))->num_rows() == 1){
			return $this->db->where(array('id' => $id))->update($this->tablename, array('status_id' => $post, 'updated_in' => date('Y-m-d H:i:s')));
		}
		
		return false;
	}
}