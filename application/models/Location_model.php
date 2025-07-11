<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Ensure database library is loaded
    }

    /**
     * Fetch all states
     * @return array
     */
    public function get_estados() {
        $this->db->order_by('estado', 'ASC');
        $query = $this->db->get('estados');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    /**
     * Fetch cities by state ID
     * @param int $estado_id
     * @return array
     */
    public function get_ciudades_by_estado_id($estado_id) {
        $this->db->where('id_estado', $estado_id);
        $this->db->order_by('ciudad', 'ASC');
        $query = $this->db->get('ciudades');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    /**
     * Fetch municipalities by state ID
     * This is used because cities don't directly link to municipalities in the schema.
     * When a city is selected, we get its state_id and use that to find relevant municipalities.
     * @param int $estado_id
     * @return array
     */
    public function get_municipios_by_estado_id($estado_id) {
        $this->db->where('id_estado', $estado_id);
        $this->db->order_by('municipio', 'ASC');
        $query = $this->db->get('municipios');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    /**
     * Fetch parishes by municipality ID
     * @param int $municipio_id
     * @return array
     */
    public function get_parroquias_by_municipio_id($municipio_id) {
        $this->db->where('id_municipio', $municipio_id);
        $this->db->order_by('parroquia', 'ASC');
        $query = $this->db->get('parroquias');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
}
?>
