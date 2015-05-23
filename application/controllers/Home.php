<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
    }
	public function index()
	{
		
		$isLoggedIn = $this->session->userdata("isLoggedIn");

		if(!$isLoggedIn){
			redirect('/login/', 'refresh');
		}else{

			$xdata['title']='Home';
			//sisa stok ketika 
			$data['content']=$this->load->view('content/home',$xdata,TRUE);			

			$this->load->view('layout/template_home',$data);
		}
	}

	function keluar(){
		$this->session->sess_destroy();
		redirect('/login/', 'refresh');
	}

	
}
