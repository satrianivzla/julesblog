<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_categories()
    {
        return $this->db->get('categories')->result_array();
    }

    public function create_category($data)
    {
        $this->db->insert('categories', $data);
        return $this->db->insert_id();
    }

    public function get_category($id)
    {
        return $this->db->get_where('categories', array('id' => $id))->row_array();
    }

    public function get_category_by_slug($slug)
    {
        return $this->db->get_where('categories', array('slug' => $slug))->row_array();
    }

    public function update_category($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }

    public function delete_category($id)
    {
        return $this->db->delete('categories', array('id' => $id));
    }

    public function search_categories($query)
    {
        $this->db->like('name', $query);
        return $this->db->get('categories')->result_array();
    }
}
