<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artists extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }

    public function index()
    {
        $config = array();
        $config["base_url"] = base_url() . "artists/index";
        $config["total_rows"] = $this->ion_auth->users()->num_rows();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['artists'] = $this->ion_auth->users()->limit($config["per_page"], $page)->result();
        $data['title'] = 'Artists';

        $this->load->view('common/header', $data);
        $this->load->view('artists/index', $data);
        $this->load->view('common/footer');
    }

    public function view($username)
    {
        $data['artist'] = $this->ion_auth->user_by_username($username)->row();

        if (empty($data['artist']))
        {
            show_404();
        }

        $data['title'] = $data['artist']->first_name . ' ' . $data['artist']->last_name;

        $this->load->view('common/header', $data);
        $this->load->view('artists/view', $data);
        $this->load->view('common/footer');
    }
}
