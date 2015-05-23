<?php
	class Login_m extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}

		function ceklogin($email, $password){
			$password = md5($password);
			//cek ke database
			$this->db->select('email');
			$this->db->from('member');
			$this->db->where(array('email' => $email,'password' => $password));
			$query = $this->db->get();
			if($query->num_rows()>0){
				return true;
			}else{
				return false;
			}
		}

		function getall($email){
			$this->db->select('*');
			$this->db->from('member');
			$this->db->where(array('email' => $email));
			$query = $this->db->get();
			return $query->result_array();
		}

	}
?>