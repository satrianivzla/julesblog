<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
        $this->load->model('category_model');
        $this->load->model('tag_model');
    }

    public function index()
    {
        $query = $this->input->get('q');

        $data['title'] = 'Search Results for "' . $query . '"';
        $data['query'] = $query;
        $data['posts'] = $this->post_model->search_posts($query);
        $data['categories'] = $this->category_model->search_categories($query);
        $data['tags'] = $this->tag_model->search_tags($query);

        $this->load->view('common/header', $data);
        $this->load->view('search/index', $data);
        $this->load->view('common/footer');
    }
}
