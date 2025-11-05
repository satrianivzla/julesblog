<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artists extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('artist_model');
        $this->load->model('audit_model');
        $this->load->library('form_validation');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            $this->session->set_flashdata('error', 'You must be an administrator to view this page.');
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Manage Artists';
        $data['artists'] = $this->artist_model->get_all_artists();

        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/artists/index', $data);
        $this->load->view('admin/common/footer');
    }

    public function create()
    {
        $data['title'] = 'Add New Artist';

        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/artists/form', $data);
        $this->load->view('admin/common/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $slug = url_title($this->input->post('name'), 'dash', TRUE);

            $artist_data = [
                'name' => $this->input->post('name'),
                'slug' => $slug,
                'bio_en' => $this->input->post('bio_en'),
                'bio_es' => $this->input->post('bio_es'),
                'social_media_links' => $this->input->post('social_media_links'),
                'official_website' => $this->input->post('official_website'),
                'online_store' => $this->input->post('online_store'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['image']['name'])) {
                $year = date('Y');
                $month = date('m');
                $day = date('d');
                $upload_path = "./uploads/artists/images/{$year}/{$month}/{$day}/";
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, TRUE);
                }

                $i = 1;
                $base_filename = "{$year}-{$month}-{$day}";
                $new_filename = $base_filename;
                while (file_exists($upload_path . $new_filename . '.webp')) {
                    $new_filename = $base_filename . '-' . str_pad($i++, 3, '0', STR_PAD_LEFT);
                }

                $config['upload_path'] = $upload_path;
                $config['file_name'] = $new_filename;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $img_config['image_library'] = 'gd2';
                    $img_config['source_image'] = $upload_data['full_path'];
                    $img_config['new_image'] = $upload_path . $new_filename . '.webp';
                    $img_config['maintain_ratio'] = TRUE;
                    $img_config['quality'] = '80%';
                    $this->image_lib->initialize($img_config);
                    if ($this->image_lib->convert('webp')) {
                         $artist_data['image'] = $new_filename . '.webp';
                         unlink($upload_data['full_path']);
                    } else {
                         $this->session->set_flashdata('error', 'WebP conversion failed: ' . $this->image_lib->display_errors());
                         redirect('admin/artists/create');
                         return;
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    $this->create();
                    return;
                }
            }

            $artist_id = $this->artist_model->create_artist($artist_data);
            if ($artist_id) {
                $this->audit_model->log_action('created_artist', $artist_id, 'Name: ' . $artist_data['name']);
                $this->session->set_flashdata('message', 'Artist created successfully.');
                redirect('admin/artists');
            } else {
                $this->session->set_flashdata('error', 'Error creating artist.');
                $this->create();
            }
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Artist';
        $data['artist'] = $this->artist_model->get_artist($id);
        if (empty($data['artist'])) {
            show_404();
        }

        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/artists/form', $data);
        $this->load->view('admin/common/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
        } else {
            $slug = url_title($this->input->post('name'), 'dash', TRUE);

            $artist_data = [
                'name' => $this->input->post('name'),
                'slug' => $slug,
                'bio_en' => $this->input->post('bio_en'),
                'bio_es' => $this->input->post('bio_es'),
                'social_media_links' => $this->input->post('social_media_links'),
                'official_website' => $this->input->post('official_website'),
                'online_store' => $this->input->post('online_store'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['image']['name'])) {
                $year = date('Y');
                $month = date('m');
                $day = date('d');
                $upload_path = "./uploads/artists/images/{$year}/{$month}/{$day}/";
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, TRUE);
                }

                $i = 1;
                $base_filename = "{$year}-{$month}-{$day}";
                $new_filename = $base_filename;
                while (file_exists($upload_path . $new_filename . '.webp')) {
                    $new_filename = $base_filename . '-' . str_pad($i++, 3, '0', STR_PAD_LEFT);
                }

                $config['upload_path'] = $upload_path;
                $config['file_name'] = $new_filename;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');
                    $img_config['image_library'] = 'gd2';
                    $img_config['source_image'] = $upload_data['full_path'];
                    $img_config['new_image'] = $upload_path . $new_filename . '.webp';
                    $img_config['maintain_ratio'] = TRUE;
                    $img_config['quality'] = '80%';
                    $this->image_lib->initialize($img_config);
                    if ($this->image_lib->convert('webp')) {
                         $artist_data['image'] = $new_filename . '.webp';
                         unlink($upload_data['full_path']);
                    } else {
                         $this->session->set_flashdata('error', 'WebP conversion failed: ' . $this->image_lib->display_errors());
                         redirect('admin/artists/edit/' . $id);
                         return;
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    $this->edit($id);
                    return;
                }
            }

            if ($this->artist_model->update_artist($id, $artist_data)) {
                $this->audit_model->log_action('updated_artist', $id, 'Name: ' . $artist_data['name']);
                $this->session->set_flashdata('message', 'Artist updated successfully.');
                redirect('admin/artists');
            } else {
                $this->session->set_flashdata('error', 'Error updating artist.');
                $this->edit($id);
            }
        }
    }

    public function delete($id)
    {
        $artist = $this->artist_model->get_artist($id);
        if ($this->artist_model->delete_artist($id)) {
            $this->audit_model->log_action('deleted_artist', $id, 'Name: ' . $artist['name']);
            $this->session->set_flashdata('message', 'Artist deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Error deleting artist.');
        }
        redirect('admin/artists');
    }
}
