<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_tags()
    {
        return $this->db->get('tags')->result_array();
    }

    public function create_tag($data)
    {
        $this->db->insert('tags', $data);
        return $this->db->insert_id();
    }

    public function get_tag($id)
    {
        return $this->db->get_where('tags', array('id' => $id))->row_array();
    }

    public function get_tag_by_slug($slug)
    {
        return $this->db->get_where('tags', array('slug' => $slug))->row_array();
    }

    public function get_tag_by_name($name)
    {
        return $this->db->get_where('tags', array('name' => $name))->row_array();
    }

    public function update_tag($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tags', $data);
    }

    public function delete_tag($id)
    {
        return $this->db->delete('tags', array('id' => $id));
    }

    public function search_tags($query)
    {
        $this->db->like('name', $query);
        return $this->db->get('tags')->result_array();
    }
}
