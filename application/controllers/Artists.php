<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artists extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('artist_model');
        $this->load->library('pagination');
    }

    public function view($slug = NULL)
    {
        $data['artist'] = $this->artist_model->get_artist_by_slug($slug);

        if (empty($data['artist']))
        {
            show_404();
        }

        $config = array();
        $config["base_url"] = base_url() . "artists/view/" . $slug;
        $config["total_rows"] = $this->artist_model->count_posts_by_artist($data['artist']['id']);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['posts'] = $this->artist_model->get_paginated_posts_by_artist($data['artist']['id'], $config["per_page"], $page);
        $data['title'] = $data['artist']['name'];

        $this->load->view('common/header', $data);
        $this->load->view('artists/view', $data);
        $this->load->view('common/footer');
    }
}
