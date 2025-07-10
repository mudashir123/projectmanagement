<?php
class Projects extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['session']);
        if (!$this->session->userdata('user_id')) redirect('login');
        $this->load->model('Task_model');
        $this->load->model('Project_model');
    }

    public function index() {
        $data['projects'] = $this->Project_model->getAllByUser($this->session->userdata('user_id'));
        $this->load->view('dashboard/index', $data);
    }

    public function create() {
        $this->load->view('projects/create');
    }

    public function store() {
        $this->Project_model->create([
            'user_id' => $this->session->userdata('user_id'),
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        ]);
        redirect('dashboard');
    }

    public function edit($id) {
        $data['project'] = $this->Project_model->find($id);
        $this->load->view('projects/edit', $data);
    }

    public function update($id) {
        $this->Project_model->update($id, [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        ]);
        redirect('projects');
    }

    public function delete($id) {
        $this->Task_model->deleteByProject($id);
        $this->Project_model->delete($id);
        redirect('projects');
    }
}