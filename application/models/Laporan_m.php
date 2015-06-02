<?php
	class Laporan_m extends CI_Model {
		public function __construct(){
			$this->load->database();	
		}

		function getcabang(){
			$this->db->select('*');
			$this->db->from('cabang');
			$query = $this->db->get();
			return $query->result_array();

		}

		function cari($tanggal1,$tanggal2,$cmbcabang){
			$html='';
			$totalberatbm=0;
			$totalquantitybm=0;
			$totalberatbk=0;
			$totalquantitybk=0;
			$totalberatstok=0;
			$totalquantitystok=0;

			$html.='
				<table border=1 cellpadding=2 cellspacing=2 width=100%>
					<tr >
						<td colspan="4">
							<strong>Barang Masuk</strong>
						</td>
					</tr>
					<tr>
						<td colspan="4">
								
						</td>
					</tr>
					<tr>
						<td>
							Nama Barang
						</td>
						<td align="right">
							Quantity
						</td>
						<td align="right">
							Berat
						</td>
						<td align="right">
							Harga
						</td>
					</tr>';

				$querybm = $this->db->query("select * from barangmasuk where tanggal>='".$tanggal1."' and tanggal<='".$tanggal2."' and cabang='".$cmbcabang."'");
				foreach($querybm->result() as $row){
					$nama_barang=$row->nama_barang;
					$quantity=$row->quantity;
					$berat=$row->berat;
					$harga=$row->harga;

					$totalberatbm=$totalberatbm+$berat;
					$totalquantitybm=$totalquantitybm+$quantity;

					$html.='
						<tr>
							<td>
								'.$nama_barang.'
							</td>
							<td align="right">
								'.$quantity.'
							</td>
							<td align="right"> 
								'.$berat.'
							</td>
							<td align="right">
								'.$harga.'
							</td>
						</tr>';
				}

				$html.='
					<tr>
						<td>
							<strong>Total Barang Masuk</strong>
						</td>
						<td align="right">
							'.$totalquantitybm.'
						</td>
						<td align="right">
							'.$totalberatbm.'
						</td>
						<td align="right">
							-
						</td>
					</tr>';


			$html.='
				</table>
			';

			$html.='
			<br>
			<br>
			';

			$html.='
				<table border=1 cellpadding=2 cellspacing=2 width=100%>
					<tr >
						<td colspan="4">
							<strong>Barang Keluar</strong>
						</td>
					</tr>
					<tr>
						<td colspan="4">
								
						</td>
					</tr>
					<tr>
						<td>
							Nama Barang
						</td>
						<td align="right"> 
							Quantity
						</td>
						<td align="right">
							Berat
						</td>
						<td align="right">
							Harga
						</td>
					</tr>';

				$querybm = $this->db->query("select * from barangkeluar where tanggal>='".$tanggal1."' and tanggal<='".$tanggal2."' and cabang='".$cmbcabang."'");
				foreach($querybm->result() as $row){
					$nama_barang=$row->nama_barang;
					$quantity=$row->quantity;
					$berat=$row->berat;
					$harga=$row->harga;

					$totalberatbk=$totalberatbk+$berat;
					$totalquantitybk=$totalquantitybk+$quantity;

					$html.='
						<tr>
							<td>
								'.$nama_barang.'
							</td>
							<td align="right">
								'.$quantity.'
							</td>
							<td align="right">
								'.$berat.'
							</td>
							<td align="right">
								'.$harga.'
							</td>
						</tr>';
				}

				$html.='
					<tr>
						<td>
							<strong>Total Barang Keluar</strong>
						</td>
						<td align="right">
							'.$totalquantitybk.'
						</td>
						<td align="right">
							'.$totalberatbk.'
						</td>
						<td align="right">
							-
						</td>
					</tr>';


			$html.='
				</table>
			';


			$html.='
			<br>
			<br>
			';

			$html.='
				<table border=1 cellpadding=2 cellspacing=2 width=100%>
					<tr >
						<td colspan="4">
							<strong>Sisa Stok</strong>
						</td>
					</tr>
					<tr>
						<td colspan="4">
								
						</td>
					</tr>
					<tr>
						<td>
							Nama Barang
						</td>
						<td align="right">
							Quantity
						</td>
						<td align="right">
							Berat
						</td>
						<td align="right">
							Harga
						</td>
					</tr>';

				$querybm = $this->db->query("select * from databarang where  cabang='".$cmbcabang."'");
				foreach($querybm->result() as $row){
					$nama_barang=$row->nama_barang;
					$quantity=$row->quantity;
					$berat=$row->berat;
					$harga=$row->harga;

					$totalberatstok=$totalberatstok+$berat;
					$totalquantitystok=$totalquantitystok+$quantity;

					$html.='
						<tr>
							<td>
								'.$nama_barang.'
							</td>
							<td align="right">
								'.$quantity.'
							</td>
							<td align="right">
								'.$berat.'
							</td>
							<td align="right">
								'.$harga.'
							</td>
						</tr>';
				}

				$html.='
					<tr>
						<td>
							<strong>Total Stok barang</strong>
						</td>
						<td align="right">
							'.$totalquantitystok.'
						</td>
						<td align="right">
							'.$totalberatstok.'
						</td>
						<td align="right">
							-
						</td>
					</tr>';


			$html.='
				</table>
			';

			return $html;

		}

	}
?>