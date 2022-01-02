<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{

    public $newData;

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata() === null){
            redirect('auth');
        }
        // is_login();
        $this->load->model('User_model');
        $this->load->model('Mahasiswa_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        // echo "Tes";
        $this->template->load('template','user/tbl_user_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->User_model->json();
    }

    public function read($id) 
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
            'id_users'      => $row->id_users,
            'full_name'     => $row->full_name,
            'email'         => $row->email,
            'password'      => $row->password,
            'images'        => $row->images,
            'id_user_level' => $row->id_user_level,
            'is_aktif'      => $row->is_aktif
        );
            $this->template->load('template','user/tbl_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create() 
    {
        $data = array(
            // BIODATA MAHASISWA
            'full_name'     => set_value('full_name'),
            'nim'           => set_value('nim'),
            'jurusan'       => set_value('jurusan'),
            'asal_sekolah'  => set_value('asal_sekolah'),
            'tanggal_lahir' => set_value('tanggal_lahir'),
            'nomor_telepon' => set_value('nomor_telepon'),

            // USER 
            'button'        => 'Create',
            'action'        => site_url('user/create_action'),
            'id_users'      => set_value('id_users'),
            'email'         => set_value('email'),
            'password'      => set_value('password'),
            'images'        => set_value('images'),
            'id_user_level' => set_value('id_user_level'),
            'is_aktif'      => set_value('is_aktif'),
            
        );
        // $this->template->load('template','user/tbl_user_form', $data);
        $this->template->load('template','user/tbl_user_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules_user();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $password       = $this->input->post('password',TRUE);
            $options        = array("cost"=>4);
            $hashPassword   = password_hash($password,PASSWORD_BCRYPT,$options);

            $this->db->select_max('id_users');
            $availableId = (int) $this->db->get('tbl_user')->row_array()['id_users'] + 1;
            // var_dump($availableId);
            // var_dump($this->input->post());

            // USER
            $this->newData['user'] = array(
                'id_users'      => $availableId,
                'full_name'     => $this->input->post('full_name',TRUE),
                'email'         => $this->input->post('email',TRUE),
                'password'      => $hashPassword,
                'images'        => $foto['file_name'] ? $foto['file_name'] : "Avatar1.svg",
                'id_user_level' => $this->input->post('id_user_level',TRUE),
                'is_aktif'      => $this->input->post('is_aktif',TRUE)
            );
            $this->session->set_userdata('newData', $this->newData['user']);

            if(strcmp($this->newData['user']['id_user_level'],'3') === 0){
                $this->create_mahasiswa();
                // var_dump($this->newData);
                return;
            }
            
            $this->User_model->insert($this->newData['user']);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
        }
    }

    public function create_mahasiswa(){
        // var_dump($this->newData['user']);
        $data = [
            'button' => 'Insert',
            'action' => site_url('user/create_action_mahasiswa'),
            'id_users' => $this->newData['user']['id_users'],
            'full_name' => $this->newData['user']['full_name'],
            'nim'           => set_value('nim'),
            'password'      => set_value('password'),
            'jurusan'       => set_value('jurusan'),
            'asal_sekolah'  => set_value('asal_sekolah'),
            'tanggal_lahir' => set_value('tanggal_lahir'),
            'nomor_telepon' => set_value('nomor_telepon'),

            'images' => $this->newData['user']['images']

        ];
        $this->template->load('template', 'user/tbl_mahasiswa_form', $data);
    }

    public function create_action_mahasiswa(){
        // var_dump($this->input->post());
        // var_dump($this->session->userdata['newData']);
        // var_dump($this->session->userdata());
        // $this->session->unset_userdata('newData');
        // var_dump($this->session->userdata());

        $user = $this->session->userdata['newData'];
        // BIODATA MAHASISWA
        $mahasiswa = [
            'mahasiswa_id'              => $user['id_users'],
            'mahasiswa_name'            => $this->input->post('full_name', TRUE),
            'mahasiswa_nim'             => $this->input->post('nim', TRUE),
            'mahasiswa_jurusan'         => $this->input->post('jurusan', TRUE),
            'mahasiswa_asal_sekolah'    => $this->input->post('asal_sekolah', TRUE),
            'mahasiswa_tanggal_lahir'   => $this->input->post('tanggal_lahir', TRUE),
            'mahasiswa_nomor_telepon'   => $this->input->post('nomor_telepon', TRUE),
        ];
        $this->User_model->insert($user);
        $this->Mahasiswa_model->insert($mahasiswa);
        $this->session->unset_userdata('newData');
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('user'));
    }
    
    public function update($id)
    {
        $user = $this->User_model->get_by_id($id);

        if ($user && strcmp($user['id_user_level'], '3') === 0){
            $this->update_mahasiswa($user);
            return;
        }

        // var_dump($user);
        $data = [
            'full_name'     => set_value('full_name', $user['full_name']),
            'button'        => 'Update',
            'action'        => site_url('user/update_action'),
            'id_users'      => set_value('id_users', $user['id_users']),
            'email'         => set_value('email', $user['email']),
            'password'      => set_value('password', $user['password']),
            'images'        => set_value('images', $user['images']),
            'id_user_level' => set_value('id_user_level', $user['id_user_level']),
            'is_aktif'      => set_value('is_aktif', $user['is_aktif'])
        ];
        
        if ($user !== null) {
            $this->template->load('template','user/tbl_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules_user();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_users', TRUE));
        } else {
            if($foto['file_name']===''){
                $data = array(
                    'full_name'     => $this->input->post('full_name',TRUE),
                    'email'         => $this->input->post('email',TRUE),
                    'id_user_level' => $this->input->post('id_user_level',TRUE),
                    'is_aktif'      => $this->input->post('is_aktif',TRUE));
            }else{
                $data = array(
                    'full_name'     => $this->input->post('full_name',TRUE),
                    'email'         => $this->input->post('email',TRUE),
                    'images'        => $foto['file_name'],
                    'id_user_level' => $this->input->post('id_user_level',TRUE),
                    'is_aktif'      => $this->input->post('is_aktif',TRUE));
                
                // ubah foto profil yang aktif
                $this->session->set_userdata('images',$foto['file_name']);
            }

            $this->User_model->update($this->input->post('id_users', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function update_mahasiswa($user){
        $mahasiswa = $this->Mahasiswa_model->get_by_id($user['id_users']);
        // var_dump($mahasiswa);
        // var_dump($user);

        $data = [
            // BIODATA MAHASISWA
            'full_name'     => set_value('full_name', $mahasiswa['mahasiswa_name']),
            'nim'           => set_value('nim', $mahasiswa['mahasiswa_nim']),
            'jurusan'       => set_value('jurusan', $mahasiswa['mahasiswa_jurusan']),
            'asal_sekolah'  => set_value('asal_sekolah', $mahasiswa['mahasiswa_asal_sekolah']),
            'tanggal_lahir' => set_value('tanggal_lahir', $mahasiswa['mahasiswa_tanggal_lahir']),
            'nomor_telepon' => set_value('nomor_telepon', $mahasiswa['mahasiswa_nomor_telepon']),

            // USER
            'button'        => 'Update',
            'action'        => site_url('user/update_action_mahasiswa'),
            'id_users'      => set_value('id_users', $user['id_users']),
            'email'         => set_value('email', $user['email']),
            'password'      => set_value('password', $user['password']),
            'images'        => set_value('images', $user['images']),
            'id_user_level' => set_value('id_user_level', $user['id_user_level']),
            'is_aktif'      => set_value('is_aktif', $user['is_aktif'])
        ];
        $this->template->load('template', 'user/tbl_mahasiswa_form', $data);
        
    }

    public function update_action_mahasiswa(){
        // var_dump($this->input->post());
        $mahasiswa = [
            'mahasiswa_id'              => $this->input->post('id_users', TRUE),
            'mahasiswa_name'            => $this->input->post('full_name', TRUE),
            'mahasiswa_nim'             => $this->input->post('nim', TRUE),
            'mahasiswa_jurusan'         => $this->input->post('jurusan', TRUE),
            'mahasiswa_asal_sekolah'    => $this->input->post('asal_sekolah', TRUE),
            'mahasiswa_tanggal_lahir'   => $this->input->post('tanggal_lahir', TRUE),
            'mahasiswa_nomor_telepon'   => $this->input->post('nomor_telepon', TRUE),
        ];
        $user = array(
            'id_users'      => $this->input->post('id_users', TRUE),
            'full_name'     => $this->input->post('full_name',TRUE),
            'email'         => $this->input->post('email',TRUE),
            'password'      => $this->input->post('password', TRUE),
            'images'        => $this->input->post('images', TRUE),
            'id_user_level' => $this->input->post('id_user_level',TRUE),
            'is_aktif'      => $this->input->post('is_aktif',TRUE)
        );
        $this->User_model->update($user['id_users'], $user);
        $this->Mahasiswa_model->update($mahasiswa['mahasiswa_id'], $mahasiswa);
        redirect(site_url('user'));
    }

    function upload_foto(){
        $config['upload_path']          = './assets/foto_profil';
        $config['allowed_types']        = 'gif|jpg|png|svg';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('images');
        return $this->upload->data();
    }
    
    public function delete($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules_user() 
    {
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        //$this->form_validation->set_rules('images', 'images', 'trim|required');
        $this->form_validation->set_rules('id_user_level', 'id user level', 'trim|required');
        $this->form_validation->set_rules('is_aktif', 'is aktif', 'trim|required');
        $this->form_validation->set_rules('id_users', 'id_users', 'trim');

        // BIODATA
        // $this->form_validation->set_rules('full_name', 'full name', 'trim|required');
        // $this->form_validation->set_rules('nim', 'nim', 'trim|required');
        // $this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required');
        // $this->form_validation->set_rules('asal_sekolah', 'asal_sekolah', 'trim|required');
        // $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'trim|required');
        // $this->form_validation->set_rules('nomor_telepon', 'nomor_telepon', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_user.xls";
        $judul = "tbl_user";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Full Name");
        xlsWriteLabel($tablehead, $kolomhead++, "Email");
        xlsWriteLabel($tablehead, $kolomhead++, "Password");
        xlsWriteLabel($tablehead, $kolomhead++, "Images");
        xlsWriteLabel($tablehead, $kolomhead++, "Id User Level");
        xlsWriteLabel($tablehead, $kolomhead++, "Is Aktif");

        foreach ($this->User_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->full_name);
            xlsWriteLabel($tablebody, $kolombody++, $data->email);
            xlsWriteLabel($tablebody, $kolombody++, $data->password);
            xlsWriteLabel($tablebody, $kolombody++, $data->images);
            xlsWriteNumber($tablebody, $kolombody++, $data->id_user_level);
            xlsWriteLabel($tablebody, $kolombody++, $data->is_aktif);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_user.doc");

        $data = array(
            'tbl_user_data' => $this->User_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('user/tbl_user_doc',$data);
    }
    
    function profile(){
        
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-04 06:32:22 */
/* http://harviacode.com */