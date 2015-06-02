<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barangkeluar extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
    {
        // this is your constructor
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('rev');
		$this->load->library('session');
		$this->load->model('barangkeluar_m');
    }

	public function index()
	{
		
		$isLoggedIn = $this->session->userdata("isLoggedIn");

		if(!$isLoggedIn){
			redirect('/login/', 'refresh');
		}else{

			$xdata['list_cabang']= $this->barangkeluar_m->getcabang();
			$xdata['list_barang']= $this->barangkeluar_m->getbarang();
			//sisa stok ketika 
			$data['content']=$this->load->view('content/barangkeluar',$xdata,TRUE);			

			$this->load->view('layout/template_home',$data);
		}
	}

	
	function getall(){
		$cabang= $this->input->get('cabang');
		$data = $this->barangkeluar_m->getall($cabang);

		echo json_encode($data);
	}



	function save(){
		$txtkdbarang= $this->input->post('txtkdbarang');
		$txtnamabarang= $this->input->post('txtnamabarang');
		$flag= $this->input->post('flag');
		$txtjumlah= clearcoma($this->input->post('txtjumlah'));
		$txtberat= clearcoma($this->input->post('txtberat'));
		$txtharga= clearcoma($this->input->post('txtharga'));
		$cmbcabang= $this->input->post('cmbcabang');

		if(isset($txtkdbarang)){
			$data = $this->barangkeluar_m->save($txtkdbarang,$txtnamabarang,$flag,$txtjumlah,$txtberat,$txtharga,$cmbcabang);
			if($data){
				echo "OK";
			}else{
				echo "FAILED";
			}
		}else{
			echo "UNCOMPLETED";
		}
		
	}

	function update(){
		$txtkdbarang= $this->input->post('txtkdbarang');
		$txtnamabarang= $this->input->post('txtnamabarang');
		$flag= $this->input->post('flag');
		$txtjumlah= clearcoma($this->input->post('txtjumlah'));
		$txtberat= clearcoma($this->input->post('txtberat'));
		$txtharga= clearcoma($this->input->post('txtharga'));
		$cmbcabang= $this->input->post('cmbcabang');
		$txtautoincremen= $this->input->post('txtautoincremen');

		if(isset($txtkdbarang) && isset($cmbcabang)){
			$data = $this->barangkeluar_m->update($txtkdbarang,$txtnamabarang,$flag,$txtjumlah,$txtberat,$txtharga,$cmbcabang,$txtautoincremen);
			if($data){
				echo "OK";
			}else{
				echo "FAILED";
			}
		}else{
			echo "UNCOMPLETED";
		}
		
	}

	function delete(){
		$txtautoincremen= $this->input->post('txtautoincremen');
		$cmbcabang= $this->input->post('cmbcabang');
		$flag= $this->input->post('flag');
		$txtkdbarang= $this->input->post('txtkdbarang');
		$txtberat= $this->input->post('txtberat');
		$txtjumlah= $this->input->post('txtjumlah');
		if(isset($txtautoincremen)){
			$data = $this->barangkeluar_m->delete($txtautoincremen,$cmbcabang,$flag,$txtkdbarang,$txtberat,$txtjumlah);
			if($data){
				echo "OK";
			}else{
				echo "FAILED";
			}
		}else{
			echo "UNCOMPLETED";
		}
	}

	function findbarang(){
		$txtkdbarang= $this->input->post('txtkdbarang');
		if(isset($txtkdbarang)){
			$data = $this->barangkeluar_m->findbarang($txtkdbarang);
			if($data){
				echo json_encode($data);
			}else{
				echo "FAILED";
			}
		}else{
			echo "UNCOMPLETED";
		}
	}



}
