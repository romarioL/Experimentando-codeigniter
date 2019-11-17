<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public $per_page = 6;




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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('pagination', 'form_validation'));
		$this->load->library('session');
	}

	private function validateForm()
	{
       
   

		$config = array(
			array(
				'field' => 'titulo',
				'label' => 'Título',
				'rules'  => 'required'
		),
			array(
				'field' => 'conteudo',
				'label'  => 'Conteúdo',
				'rules'  => 'required'
			)
		);

		 $this->form_validation->set_message('required', '{field}  é obrigatório');

		 $this->form_validation->set_error_delimiters('<div class="panel red white-text" style="padding: 10px; margin: 5px;">', '</div>'); 

		 $this->form_validation->set_rules($config);

		 return $this->form_validation->run();

	}

	private function paginate()
	{
		

		$config['base_url'] = base_url('index.php/Welcome/index'); 

		$config['per_page'] = $this->per_page;

		$config['uri_segment'] = 3;

		$config['total_rows'] = $this->Post->count();

		$config['first_link']  = 'Primeiro';

		$config['last_link']   = 'Último';

		$config['next_link']   = 'Próximo';

		$config['prev_link']   = 'Anterior';

		$config['attributes'] = array('class' => 'white-text');

		$config['prev_tag_open'] = '<li class="purple darken-3 waves-effect btn">';

		$config['prev_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li class=" purple darken-3 waves-effect btn">';

		$config['next_tag_close'] = '</li>';

		$config['full_tag_open'] = '<li class=" purple darken-3 waves-effect btn">';

        $config['full_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="purple darken-3 waves-effect btn">';

        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="purple lighten-1 waves-effect  active btn">';

        $conf['cur_tag_close'] = '</li>';

        $config['first_tag_open']   = '<li class="purple darken-3 white-text waves-effect btn">';

        $config['first_tagl_close'] = '</li>';

        $config['last_tag_open']    = '<li class="purple darken-3  waves-effect btn">';

        $config['last_tag_close']  = "</li>";

		$this->pagination->initialize($config);


		return $this->pagination->create_links();

	    

	}


	public function index()
	{
		$this->load->model('Post');

		$offset =  $this->uri->segment(3,0);

		$data['posts'] = $this->Post->get_posts($this->per_page, $offset);

	    $data['links'] = $this->paginate();

	    if($this->session->flashdata('error'))
	    {
	    	$data['error'] = $this->session->flashdata('error');
	    }



	    $this->load->view('subscribeform', $data);

		
	
	}

	public function criar()
	{
		$this->load->model('Post');

		



		if($this->validateForm() == true) {
              
              $this->Post->insert_post();

		}else 
		{
			$this->session->set_flashdata('error', validation_errors());

		}
		

		
		redirect('Welcome', 'refresh');

	}

	public function ML()
	{
		$this->load->model('Post');
		$this->Post->ml();
	}
}
