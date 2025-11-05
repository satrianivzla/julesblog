<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_artist($id)
    {
        return $this->db->get_where('artists', array('id' => $id))->row_array();
    }

    public function get_artist_by_slug($slug)
    {
        return $this->db->get_where('artists', array('slug' => $slug))->row_array();
    }

    public function get_all_artists()
    {
        return $this->db->get('artists')->result_array();
    }

    public function create_artist($data)
    {
        $this->db->insert('artists', $data);
        return $this->db->insert_id();
    }

    public function update_artist($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('artists', $data);
    }

    public function delete_artist($id)
    {
        return $this->db->delete('artists', array('id' => $id));
    }

    public function get_posts_by_artist($artist_id)
    {
        return $this->db->get_where('posts', array('artist_id' => $artist_id))->result_array();
    }

    public function count_posts_by_artist($artist_id)
    {
        return $this->db->where('artist_id', $artist_id)->count_all_results('posts');
    }

    public function get_paginated_posts_by_artist($artist_id, $limit, $start)
    {
        $this->db->limit($limit, $start);
        return $this->db->get_where('posts', array('artist_id' => $artist_id))->result_array();
    }
}
