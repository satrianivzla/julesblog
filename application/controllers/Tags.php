<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tag_model');
        $this->load->library('pagination');
    }

    public function index()
    {
        $config = array();
        $config["base_url"] = base_url() . "tags/index";
        $config["total_rows"] = $this->tag_model->count_all_tags();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['tags'] = $this->tag_model->get_paginated_tags($config["per_page"], $page);
        $data['title'] = 'Tags';

        $this->load->view('common/header', $data);
        $this->load->view('tags/index', $data);
        $this->load->view('common/footer');
    }

    public function view($slug)
    {
        $data['tag'] = $this->tag_model->get_tag_by_slug($slug);

        if (empty($data['tag']))
        {
            show_404();
        }

        $data['title'] = $data['tag']['name'];

        $this->load->view('common/header', $data);
        $this->load->view('tags/view', $data);
        $this->load->view('common/footer');
    }
}
