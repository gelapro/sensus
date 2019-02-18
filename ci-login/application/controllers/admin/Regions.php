<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Regions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("regions_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["regions"] = $this->regions_model->getAll();
        $this->load->view("admin/regions/list", $data);
    }

    public function add()
    {
        $regions = $this->regions_model;
        $validation = $this->form_validation;
        $validation->set_rules($regions->rules());

        if ($validation->run()) {
            $regions->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/regions/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/regions');
       
        $regions = $this->regions_model;
        $validation = $this->form_validation;
        $validation->set_rules($regions->rules());

        if ($validation->run()) {
            $regions->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $regions->getById($id);
        if (!$data["regions"]) show_404();
        
        $this->load->view("admin/product/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->regions_model->delete($id)) {
            redirect(site_url('admin/products'));
        }
    }
}