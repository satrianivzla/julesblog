<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Location_model');
        $this->load->helper('url'); // Autoloaded, but good practice to ensure it's available
    }

    public function index() {
        // Fetch initial states to pass to the view
        $data['estados'] = $this->Location_model->get_estados();
        $this->load->view('locations_view', $data);
    }

    public function get_ciudades() {
        $estado_id = $this->input->post('estado_id');
        if ($estado_id) {
            $ciudades = $this->Location_model->get_ciudades_by_estado_id($estado_id);
            echo json_encode($ciudades);
        } else {
            echo json_encode(array());
        }
    }

    public function get_municipios() {
        // We receive estado_id here because municipalities are linked to states.
        // The JavaScript will get the estado_id from the selected city's state.
        $estado_id = $this->input->post('estado_id');
        if ($estado_id) {
            $municipios = $this->Location_model->get_municipios_by_estado_id($estado_id);
            echo json_encode($municipios);
        } else {
            echo json_encode(array());
        }
    }

    public function get_parroquias() {
        $municipio_id = $this->input->post('municipio_id');
        if ($municipio_id) {
            $parroquias = $this->Location_model->get_parroquias_by_municipio_id($municipio_id);
            echo json_encode($parroquias);
        } else {
            echo json_encode(array());
        }
    }
}
?>
