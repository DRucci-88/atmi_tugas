<?php
Class Mahasiswa extends CI_Controller{
    


    function index(){
      $user = $this->session->userdata();
      $data['user'] = $user;
      $data['biodata'] = $this->db->get_where('mahasiswa', [
        'mahasiswa_id' => $user['id_users']
      ])->row_array();
      // var_dump($data);
      $this->template->load('template','mahasiswa/dashboard', $data);
      // echo "MAHASISWA";
    }
    
    function hasil_studi(){
      echo "Mahasiswa Hasil Studi";
    }

    function keuangan(){
      echo "Mahasiswa keuangan";
    }

    function riwayat_absensi(){
      echo "Mahasiswa Riwayat absensi";
    }
}
