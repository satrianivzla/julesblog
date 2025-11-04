<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->library('pagination');
    }

    public function index()
    {
        $config = array();
        $config["base_url"] = base_url() . "categories/index";
        $config["total_rows"] = $this->category_model->count_all_categories();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['categories'] = $this->category_model->get_paginated_categories($config["per_page"], $page);
        $data['title'] = 'Categories';

        $this->load->view('common/header', $data);
        $this->load->view('categories/index', $data);
        $this->load->view('common/footer');
    }

    public function view($slug)
    {
        $data['category'] = $this->category_model->get_category_by_slug($slug);

        if (empty($data['category']))
        {
            show_404();
        }

        $data['title'] = $data['category']['name'];

        $this->load->view('common/header', $data);
        $this->load->view('categories/view', $data);
        $this->load->view('common/footer');
    }
}
