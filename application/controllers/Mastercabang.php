<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mastercabang extends CI_Controller {

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
		$this->load->library('session');
		$this->load->model('mastercabang_m');
    }

	public function index()
	{
		
		$isLoggedIn = $this->session->userdata("isLoggedIn");

		if(!$isLoggedIn){
			redirect('/login/', 'refresh');
		}else{

			$xdata['list_cabang']="";
			//sisa stok ketika 
			$data['content']=$this->load->view('content/mastercabang',$xdata,TRUE);			

			$this->load->view('layout/template_home',$data);
		}
	}

	function getall(){
		$data = $this->mastercabang_m->getall();

		echo json_encode($data);
	}

	function save(){
		$txtnamacabang= $this->input->post('txtnamacabang');
		if(isset($txtnamacabang)){
			$data = $this->mastercabang_m->save($txtnamacabang);
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
		$txtnamacabang= $this->input->post('txtnamacabang');
		$txtid= $this->input->post('txtid');

		if(isset($txtnamacabang) && isset($txtid)){
			$data = $this->mastercabang_m->update($txtnamacabang,$txtid);
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
		$txtid= $this->input->post('txtid');
		if(isset($txtid)){
			$data = $this->mastercabang_m->delete($txtid);
			if($data){
				echo "OK";
			}else{
				echo "FAILED";
			}
		}else{
			echo "UNCOMPLETED";
		}
	}

}
