<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('post_model');
        $this->load->library('pagination');
    }

    public function view($slug = NULL)
    {
        $data['category'] = $this->category_model->get_category_by_slug($slug);

        if (empty($data['category']))
        {
            show_404();
        }

        $config = array();
        $config["base_url"] = base_url() . "categories/view/" . $slug;
        $config["total_rows"] = $this->post_model->count_posts_by_category($data['category']['id']);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['posts'] = $this->post_model->get_paginated_posts_by_category($data['category']['id'], $config["per_page"], $page);
        $data['title'] = $data['category']['name'];

        $this->load->view('common/header', $data);
        $this->load->view('categories/view', $data);
        $this->load->view('common/footer');
    }
}
