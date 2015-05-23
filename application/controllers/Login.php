<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('layout/template_login');
	}

	function ceklogin(){
		$this->load->model('Login_m');
		$this->load->library('session');
		
		$email= $this->input->post('email');
		$password= $this->input->post('password');

		if(isset($email) && isset($password)){
			$cek = $this->Login_m->ceklogin($email,$password);
			if($cek){
				//ambil all data user
				$data=$this->Login_m->getall($email);
				foreach($data as $row)
				{	
					$this->session->set_userdata(array("username" => $row['username'],"email" => $row['email'],"isLoggedIn" => true));
				}
				echo "OK";		
			}
			/*
			if($cek=="OK"){
				//ambil all data user
				$data=$this->Login_m->getall($email);
				foreach($data as $row)
				{	
					$this->session->set_userdata(array("username" => $row['username'],"email" => $row['email'],"isLoggedIn" => true));
				}
				echo $cek;
			}
			*/


		}else{
			echo "UNCOMPLETE";
		}
	}
}
