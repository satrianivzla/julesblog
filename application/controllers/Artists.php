<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artists extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
        $this->load->library('pagination');
    }

    public function view($id = NULL)
    {
        $data['artist'] = $this->ion_auth->user($id)->row();

        if (empty($data['artist']))
        {
            show_404();
        }

        $config = array();
        $config["base_url"] = base_url() . "artists/view/" . $id;
        $config["total_rows"] = $this->post_model->count_posts_by_author($id);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['posts'] = $this->post_model->get_paginated_posts_by_author($id, $config["per_page"], $page);
        $data['title'] = $data['artist']->first_name . ' ' . $data['artist']->last_name;

        $this->load->view('common/header', $data);
        $this->load->view('artists/view', $data);
        $this->load->view('common/footer');
    }
}
