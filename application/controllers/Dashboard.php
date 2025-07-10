<?php
use GeoIp2\Database\Reader;

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['session']);
        if (!$this->session->userdata('user_id')) redirect('login');
        $this->load->model(['Project_model', 'Task_model']);
        require_once FCPATH . 'vendor/autoload.php'; 

    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['projects'] = $this->Project_model->getAllByUser($user_id);

        $reader = new Reader(APPPATH . 'third_party/GeoLite2-City.mmdb');
        $ip = $_SERVER['REMOTE_ADDR'];

        if ($ip == '127.0.0.1' || strpos($ip, '192.') === 0 || strpos($ip, '::1') === 0) {
            $ip = file_get_contents('https://api64.ipify.org');
        }

        try {
            $record = $reader->city($ip);
            $data['city'] = $record->city->name;
            $data['region'] = $record->mostSpecificSubdivision->name;
        } catch (Exception $e) {
            $data['city'] = 'Unknown';
            $data['region'] = 'Unknown';
        }

        $this->load->view('dashboard/index', $data);
    }
}