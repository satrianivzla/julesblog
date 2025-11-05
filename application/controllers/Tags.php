<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tag_model');
        $this->load->model('post_model');
        $this->load->library('pagination');
    }

    public function view($slug = NULL)
    {
        $data['tag'] = $this->tag_model->get_tag_by_slug($slug);

        if (empty($data['tag']))
        {
            show_404();
        }

        $config = array();
        $config["base_url"] = base_url() . "tags/view/" . $slug;
        $config["total_rows"] = $this->post_model->count_posts_by_tag($data['tag']['id']);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['posts'] = $this->post_model->get_paginated_posts_by_tag($data['tag']['id'], $config["per_page"], $page);
        $data['title'] = $data['tag']['name'];

        $this->load->view('common/header', $data);
        $this->load->view('tags/view', $data);
        $this->load->view('common/footer');
    }
}
