<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function index() {
        $this->load->view('pokemons');
    }
}
?>