<?php

use Application\MachineLearning;

class Post extends CI_Model
 {

	public $titulo;

	public $conteudo;

	public function insert_post() 
	{
        

		$titulo = $this->input->post('titulo');

		$conteudo =  $this->input->post('conteudo');

        $data = ['titulo' => $titulo, 'conteudo' => $conteudo];

        if(!empty($this->session->flashdata('error')))
         {
                  $data['error'] = $this->session->flashdata('error');
         }

		$this->db->insert('posts', $data);

	}

	public function get_posts($limit, $offset)
	{
		$this->db->from('posts');

		$this->db->order_by('id', 'DESC');

		$this->db->limit($limit, $offset);

		$query = $this->db->get();

		return $query->result();
	}

	public function ml()
	{
         $ml = new MachineLearning();

         $ml->ML();
	}

	public function count()
	{
		 return $this->db->count_all('posts');
	}

}