<?php
	class Masterbarang_m extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}

		function getcabang(){
			$this->db->select('*');
			$this->db->from('cabang');
			$query = $this->db->get();
			return $query->result_array();

		}

		
		function getall($cabang){
			$this->db->select('*');
			$this->db->from('databarang');
			$this->db->where(array('cabang' => $cabang));
			$query = $this->db->get();
			return $query->result_array();
		}

		function save($txtkdbarang,$txtnamabarang,$flag,$txtjumlah,$txtberat,$txtharga,$cmbcabang){
			$date =date('Y-m-d');	
			$arrInput = array(
				"id" => $txtkdbarang,
				"nama_barang" => $txtnamabarang,
				"flag" => $flag,
				"quantity" => $txtjumlah,
				"berat" => $txtberat,
				"harga" => $txtharga,
				"cabang" => $cmbcabang,	
				"tanggal" => $date
			);

			//cek jika kode sama
			$query = $this->db->get_where("databarang",array("id" => $txtkdbarang));
			if($query->num_rows()>0){
				return false;	
			}
			else{
				$ar = $this->db->insert('databarang',$arrInput);
				if($ar){
					return true;
				}else{
					return false;
				}
			}

			

		}
		
		function update($txtkdbarang,$txtnamabarang,$flag,$txtjumlah,$txtberat,$txtharga,$cmbcabang){
			$arrInput = array(
				"nama_barang" => $txtnamabarang,
				"flag" => $flag,
				"quantity" => $txtjumlah,
				"berat" => $txtberat,
				"harga" => $txtharga,
				"cabang" => $cmbcabang
			);

			$this->db->where('id',$txtkdbarang);
			$ar = $this->db->update('databarang',$arrInput);
			if($ar){
				return true;
			}else{
				return false;
			}

		}


		function delete($txtkdbarang,$cmbcabang){
			$arrInput = array(
				"id" => $txtkdbarang,
				"cabang" => $cmbcabang
			);
			$ar = $this->db->delete('databarang',$arrInput);
			if($ar){
				return true;
			}else{
				return false;
			}

		}


	}
?>