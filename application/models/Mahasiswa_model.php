<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{

  public $table = 'mahasiswa';
  public $id = 'mahasiswa_id';

  function __construct()
  {
    parent::__construct();
  }

  function insert($data){
    $this->db->insert($this->table, $data);
  }

  function get_by_id($id){
    return $this->db->get_where($this->table, [
      $this->id => $id
    ])->row_array();
  }
  function update($id, $data){
    $this->db->where($this->id, $id);
    $this->db->update($this->table, $data);
  }
}