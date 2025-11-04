<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stat_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function increment_view($post_id)
    {
        $this->db->set('views', 'views+1', FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('posts');
    }
}
