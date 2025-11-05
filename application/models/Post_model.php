<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_post_by_slug($slug)
    {
        return $this->db->get_where('posts', array('slug' => $slug))->row_array();
    }

    public function get_post($id)
    {
        return $this->db->get_where('posts', array('id' => $id))->row_array();
    }

    public function get_all_posts()
    {
        return $this->db->get('posts')->result_array();
    }

    public function get_published_posts()
    {
        return $this->db->get_where('posts', array('status' => 'published'))->result_array();
    }

    public function create_post($data, $categories, $tags)
    {
        if ($this->db->insert('posts', $data)) {
            $post_id = $this->db->insert_id();
            $this->sync_categories($post_id, $categories);
            $this->sync_tags($post_id, $tags);
            return $post_id;
        }
        return false;
    }

    public function update_post($id, $data, $categories, $tags)
    {
        $this->db->where('id', $id);
        if ($this->db->update('posts', $data)) {
            $this->sync_categories($id, $categories);
            $this->sync_tags($id, $tags);
            return true;
        }
        return false;
    }

    public function delete_post($id)
    {
        return $this->db->delete('posts', array('id' => $id));
    }

    public function get_post_categories($id)
    {
        $this->db->select('category_id');
        $query = $this->db->get_where('post_categories', array('post_id' => $id));
        return array_column($query->result_array(), 'category_id');
    }

    public function get_post_tags($id)
    {
        $this->db->select('tag_id');
        $query = $this->db->get_where('post_tags', array('post_id' => $id));
        return array_column($query->result_array(), 'tag_id');
    }

    private function sync_categories($post_id, $categories)
    {
        $this->db->delete('post_categories', array('post_id' => $post_id));
        if (!empty($categories)) {
            $batch = [];
            foreach ($categories as $category_id) {
                $batch[] = ['post_id' => $post_id, 'category_id' => $category_id];
            }
            $this->db->insert_batch('post_categories', $batch);
        }
    }

    private function sync_tags($post_id, $tags)
    {
        $this->db->delete('post_tags', array('post_id' => $post_id));
        if (!empty($tags)) {
            $this->load->model('tag_model');
            $tag_ids = [];
            foreach ($tags as $tag_name) {
                $tag = $this->tag_model->get_tag_by_name($tag_name);
                if ($tag) {
                    $tag_ids[] = $tag['id'];
                } else {
                    $tag_ids[] = $this->tag_model->create_tag(['name' => $tag_name, 'slug' => url_title($tag_name, 'dash', TRUE)]);
                }
            }
            $batch = [];
            foreach ($tag_ids as $tag_id) {
                $batch[] = ['post_id' => $post_id, 'tag_id' => $tag_id];
            }
            $this->db->insert_batch('post_tags', $batch);
        }
    }

    public function get_posts_by_category($category_id)
    {
        $this->db->select('posts.*');
        $this->db->from('posts');
        $this->db->join('post_categories', 'post_categories.post_id = posts.id');
        $this->db->where('post_categories.category_id', $category_id);
        return $this->db->get()->result_array();
    }

    public function get_posts_by_tag($tag_id)
    {
        $this->db->select('posts.*');
        $this->db->from('posts');
        $this->db->join('post_tags', 'post_tags.post_id = posts.id');
        $this->db->where('post_tags.tag_id', $tag_id);
        return $this->db->get()->result_array();
    }

    public function get_posts_by_author($author_id)
    {
        return $this->db->get_where('posts', array('author_id' => $author_id))->result_array();
    }

    public function search_posts($query)
    {
        $this->db->like('title', $query);
        $this->db->or_like('content', $query);
        return $this->db->get('posts')->result_array();
    }

    public function count_posts_by_category($category_id)
    {
        $this->db->join('post_categories', 'post_categories.post_id = posts.id');
        $this->db->where('post_categories.category_id', $category_id);
        return $this->db->count_all_results('posts');
    }

    public function get_paginated_posts_by_category($category_id, $limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->select('posts.*');
        $this->db->from('posts');
        $this->db->join('post_categories', 'post_categories.post_id = posts.id');
        $this->db->where('post_categories.category_id', $category_id);
        return $this->db->get()->result_array();
    }

    public function count_posts_by_tag($tag_id)
    {
        $this->db->join('post_tags', 'post_tags.post_id = posts.id');
        $this->db->where('post_tags.tag_id', $tag_id);
        return $this->db->count_all_results('posts');
    }

    public function get_paginated_posts_by_tag($tag_id, $limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->select('posts.*');
        $this->db->from('posts');
        $this->db->join('post_tags', 'post_tags.post_id = posts.id');
        $this->db->where('post_tags.tag_id', $tag_id);
        return $this->db->get()->result_array();
    }

    public function count_posts_by_author($author_id)
    {
        return $this->db->where('author_id', $author_id)->count_all_results('posts');
    }

    public function get_paginated_posts_by_author($author_id, $limit, $start)
    {
        $this->db->limit($limit, $start);
        return $this->db->get_where('posts', array('author_id' => $author_id))->result_array();
    }
}
