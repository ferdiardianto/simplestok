<?php
	class Mastercabang_m extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}

		function getall(){
			$this->db->select('*');
			$this->db->from('cabang');
			//$this->db->where(array('email' => $email));
			$query = $this->db->get();
			return $query->result_array();
		}

		function save($txtnamacabang){
			$arrInput = array(
				"nama_cabang" => $txtnamacabang
			);

			$ar = $this->db->insert('cabang',$arrInput);
			if($ar){
				return true;
			}else{
				return false;
			}

		}

		function update($txtnamacabang,$txtid){
			$arrInput = array(
				"nama_cabang" => $txtnamacabang
			);
			$this->db->where('id',$txtid);
			$ar = $this->db->update('cabang',$arrInput);
			if($ar){
				return true;
			}else{
				return false;
			}

		}


		function delete($txtid){
			$arrInput = array(
				"id" => $txtid
			);
			$ar = $this->db->delete('cabang',$arrInput);
			if($ar){
				return true;
			}else{
				return false;
			}

		}

	}
?>