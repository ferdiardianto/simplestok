<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
		$this->load->model('laporan_m');
    }

	public function index()
	{
		$isLoggedIn = $this->session->userdata("isLoggedIn");

		if(!$isLoggedIn){
			redirect('/login/', 'refresh');
		}else{

			$xdata['list_cabang']= $this->laporan_m->getcabang();
			//sisa stok ketika 
			$data['content']=$this->load->view('content/laporan',$xdata,TRUE);			

			$this->load->view('layout/template_home',$data);
		}
	}

	function cari(){
		$tanggal1= tgl_sql($this->input->post('tanggal1'));
		$tanggal2= tgl_sql($this->input->post('tanggal2'));
		$cmbcabang= $this->input->post('cmbcabang');

		if(isset($tanggal1) && isset($tanggal2)){
			$data = $this->laporan_m->cari($tanggal1,$tanggal2,$cmbcabang);
			if($data){
				echo $data;
			}else{
				echo "FAILED";
			}
		}else{
			echo "UNCOMPLETED";
		}

	}
}
