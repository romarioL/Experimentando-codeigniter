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
	}

	private function validateForm()
	{
       
   

		$config = array(
			array(
				'field' => 'titulo',
				'label' => 'Titulo',
				'rules'  => 'required',
				'message' => 'Título é obrigatório'
		),
			array(
				'field' => 'conteudo',
				'label'  => 'Conteudo',
				'rules'  => 'required',
				'message' => 'Conteúdo é obrigatório'
			)
		);

		 $this->form_validation->set_rules($config);

		 $this->form_validation->set_error_delimiters('<div>', '</div>');

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

		$config['attributes'] = array('class' => 'waves-effect waves-light btn light-blue darken-4');

		$this->pagination->initialize($config);


		return $this->pagination->create_links();

	    

	}


	public function index()
	{
		$this->load->model('Post');

		$offset =  $this->uri->segment(3,0);

		$data['posts'] = $this->Post->get_posts($this->per_page, $offset);

	    $data['links'] = $this->paginate();

	    $this->load->view('subscribeform', $data);

		
	
	}

	public function criar()
	{
		$this->load->model('Post');

		



		if($this->validateForm() == true) {
              
              $this->Post->insert_post();

		}


		redirect('/Welcome', 'location');
	}

	public function ML()
	{
		$this->load->model('Post');
		$this->Post->ml();
	}
}
