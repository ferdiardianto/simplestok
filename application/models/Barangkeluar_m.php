<?php
	class Barangkeluar_m extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}

		function getcabang(){
			$this->db->select('*');
			$this->db->from('cabang');
			$query = $this->db->get();
			return $query->result_array();

		}

		function getbarang(){
			$this->db->select('*');
			$this->db->from('databarang');
			$query = $this->db->get();
			return $query->result_array();

		}

		
		function getall($cabang){
			$this->db->select('*');
			$this->db->from('barangkeluar');
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

			//ambil value dari stok
			//cek flag
			if($flag==1){
				//quantity
				$query = $this->db->get_where("databarang",array("id" => $txtkdbarang));
				$row= $query->row();
				$quantity = $row->quantity;
				$stokquantity = $quantity - $txtjumlah;

				//array buat update stok
				$arrInputstok = array(
					"quantity" => $stokquantity
				);

			}else if($flag==2){
				//berat
				$query = $this->db->get_where("databarang",array("id" => $txtkdbarang));
				$row= $query->row();
				$berat = $row->berat;
				$stokberat = $berat - $txtberat;

				//array buat update stok
				$arrInputstok = array(
					"berat" => $stokberat
				);

			}

			$ar = $this->db->insert('barangkeluar',$arrInput);
			if($ar){
				//update ke stok
				$this->db->where('id',$txtkdbarang);
				$arstokk = $this->db->update('databarang',$arrInputstok);
				if($arstokk){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}

			/*
			//cek jika kode sama
			$query = $this->db->get_where("barangmasuk",array("id" => $txtkdbarang));
			if($query->num_rows()>0){
				return false;	
			}
			else{
				$ar = $this->db->insert('barangmasuk',$arrInput);
				if($ar){
					return true;
				}else{
					return false;
				}
			}
			*/
			

		}
		
		function update($txtkdbarang,$txtnamabarang,$flag,$txtjumlah,$txtberat,$txtharga,$cmbcabang,$txtautoincremen){
			$arrInput = array(
				"nama_barang" => $txtnamabarang,
				"flag" => $flag,
				"quantity" => $txtjumlah,
				"berat" => $txtberat,
				"harga" => $txtharga,
				"cabang" => $cmbcabang
			);

			//cek flag
			if($flag==1){
				//quantity
				//ambil data barang masuk yg lama
				$query = $this->db->get_where("barangkeluar",array("autoincremen" => $txtautoincremen));
				$row= $query->row();
				$quantitylama = $row->quantity;

				if($txtjumlah<$quantitylama){
					$selisih = $quantitylama-$txtjumlah;
					//dikurang
					//quantity
					$query = $this->db->get_where("databarang",array("id" => $txtkdbarang));
					$row= $query->row();
					$quantity = $row->quantity;
					$stokquantity = $quantity + $selisih;

					//array buat update stok
					$arrInputstok = array(
						"quantity" => $stokquantity
					);

				}else{
					$selisih = $txtjumlah-$quantitylama;
					//ditambah
					//quantity
					$query = $this->db->get_where("databarang",array("id" => $txtkdbarang));
					$row= $query->row();
					$quantity = $row->quantity;
					$stokquantity = $quantity - $selisih;

					//array buat update stok
					$arrInputstok = array(
						"quantity" => $stokquantity
					);
				}


			}else if($flag==2){
				//berat
				//ambil data barang masuk yg lama
				$query = $this->db->get_where("barangkeluar",array("autoincremen" => $txtautoincremen));
				$row= $query->row();
				$beratlama = $row->berat;

				if($txtberat<$beratlama){
					
					$selisih = $beratlama-$txtberat;
					
					//dikurang
					//berat
					$query = $this->db->get_where("databarang",array("id" => $txtkdbarang));
					$row= $query->row();
					$berat = $row->berat;
					$stokberat = $berat + $selisih;

					//array buat update stok
					$arrInputstok = array(
						"berat" => $stokberat
					);
					
				}else{
					
					$selisih = $txtberat-$beratlama;
					
					//ditambah
					//berat
					$query = $this->db->get_where("databarang",array("id" => $txtkdbarang));
					$row= $query->row();
					$berat = $row->berat;
					$stokberat = $berat - $selisih;

					//array buat update stok
					$arrInputstok = array(
						"berat" => $stokberat
					);
					
				}



			}
			
			$this->db->where('id',$txtkdbarang);
			$ar = $this->db->update('barangkeluar',$arrInput);
			if($ar){
				//update ke stok
				$this->db->where('id',$txtkdbarang);
				$arstokk = $this->db->update('databarang',$arrInputstok);
				if($arstokk){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
			

		}


		function delete($txtautoincremen,$cmbcabang,$flag,$txtkdbarang,$txtberat,$txtjumlah){
			$arrInput = array(
				"autoincremen" => $txtautoincremen,
				"cabang"=> $cmbcabang
			);

			//cek flag
			if($flag==1){
				//quantity
				$query = $this->db->get_where("databarang",array("id" => $txtkdbarang));
				$row= $query->row();
				$quantity = $row->quantity;
				$stokquantity = $quantity + $txtjumlah;

				//array buat update stok
				$arrInputstok = array(
					"quantity" => $stokquantity
				);

			}else if($flag==2){
				//berat
				$query = $this->db->get_where("databarang",array("id" => $txtkdbarang));
				$row= $query->row();
				$berat = $row->berat;
				$stokberat = $berat + $txtberat;

				//array buat update stok
				$arrInputstok = array(
					"berat" => $stokberat
				);

			}

			$ar = $this->db->delete('barangkeluar',$arrInput);
			if($ar){

				//update ke stok
				$this->db->where('id',$txtkdbarang);
				$arstokk = $this->db->update('databarang',$arrInputstok);
				if($arstokk){
					return true;
				}else{
					return false;
				}
				
			}else{
				return false;
			}

		}

		function findbarang($txtkdbarang){

			$this->db->select('*');
			$this->db->from('databarang');
			$this->db->where(array('id' => $txtkdbarang));
			$query = $this->db->get();
			return $query->result_array();	
		}


	}
?>