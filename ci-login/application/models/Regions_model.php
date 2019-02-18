<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Region_model extends CI_Model
{
    private $_table = "regions";

    public $id;
    public $name;
    public $create_at;
    public $create_by;

    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'create_at',
            'label' => 'Create_at',
            'rules' => 'datetime'],
            
            ['field' => 'create_by',
            'label' => 'Create_by',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id = uniqid();
        $this->name = $post["name"];
        $this->create_at = $post["create_at"];
        $this->create_by = $post["create_by"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->name = $post["name"];
        $this->create_at = $post["create_at"];
        $this->create_by = $post["create_by"];
        $this->db->update($this->_table, $this, array('product_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
}