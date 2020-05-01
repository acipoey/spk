<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_kepala extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->check_login();
        if ($this->session->userdata('id_role') != "1") {
            redirect('', 'refresh');
        }
    }

    public function index()
    {
        $data = konfigurasi('Dashboard');
        $data['surat'] = $this->m_surat_kepala->tampil_data()->result();
        $this->template->load('layouts/template', 'admin/surat_kepala', $data);
    }

    public function tambah_surat(){
        $this->form_validation->set_rules('no_urut','Nomor Urut', 'trim|required');
        $this->form_validation->set_rules('id_instansi','Kode Instansi', 'trim|required');
        $this->form_validation->set_rules('instansi_asal','Instansi Asal', 'trim|required');
        $this->form_validation->set_rules('kode_satker','Kode Satker', 'trim|required');
        $this->form_validation->set_rules('tanggal','Tanggal', 'trim|required');
        $this->form_validation->set_rules('perihal','Perihal', 'trim|required');
        $this->form_validation->set_rules('instansi_tujuan','Instansi Tujuan', 'trim|required');

        if($this->form_validation->run() == TRUE){

        $instansi_asal = 'BPS';
        $id_instansi = '9105';
        $kode_satker ='0';
        $tanggal = $this->input->post('tanggal');
        $id_bulan = substr($tanggal,5,2);
        $tahun = substr($tanggal,0,4);

            $data = array(
                'no_urut'           =>  $this->input->post('no_urut'),
                'id_instansi'       =>  $id_instansi,
                'instansi_asal'     =>  $instansi_asal,
                'kode_satker'       =>  $kode_satker,
                'id_bulan'          =>  $id_bulan,
                'tahun'             =>  $tahun,
                'tanggal'           =>  $tanggal,
                'perihal'           =>  $this->input->post('perihal'),
                'instansi_tujuan'   =>  $this->input->post('instansi_tujuan'),
                'keterangan'        =>  $this->input->post('keterangan')

            );

            $this->m_surat_kepala->input_data($data);
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menambahkan Surat Kepala',
        );
        $this->session->set_flashdata('flash','Surat Kepala Berhasil Ditambahkan');
        $this->m_aktivitas->input_data($aktivitas);
            redirect('admin/surat_kepala');
        } else{
            redirect('admin/surat_kepala');            
        }
    }

    public function hapus($id_surat){
        $where = array ('id_surat' => $id_surat);
        $this->m_surat_kepala->hapus_data($where,'tbl_surat_kepala');
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menghapus Surat Kepala',
        );
        $this->m_aktivitas->input_data($aktivitas);
        redirect ('admin/surat_kepala');
    }


    public function edit($id_surat){
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_kepala->edit_data($where)->result();
        $this->template->load('layouts/template', 'admin/edit_surat_kepala', $data);        
    }
    
    public function update(){
        $id_surat = $this->input->post('id_surat');

        $this->form_validation->set_rules('no_urut','Nomor Urut', 'trim|required');
        $this->form_validation->set_rules('id_instansi','Kode Instansi', 'trim|required');
        $this->form_validation->set_rules('instansi_asal','Instansi Asal', 'trim|required');
        $this->form_validation->set_rules('kode_satker','Kode Satker', 'trim|required');
        $this->form_validation->set_rules('tanggal','Tanggal', 'trim|required');
        $this->form_validation->set_rules('perihal','Perihal', 'trim|required');
        $this->form_validation->set_rules('instansi_tujuan','Instansi Tujuan', 'trim|required');

        if($this->form_validation->run() == TRUE){

        $instansi_asal = 'BPS';
        $id_instansi = '9105';
        $kode_satker ='0';
        $tanggal = $this->input->post('tanggal');
        $id_bulan = substr($tanggal,5,2);
        $tahun = substr($tanggal,0,4);

        $data = array(
                'no_urut'           =>  $this->input->post('no_urut'),
                'id_instansi'       =>  $id_instansi,
                'instansi_asal'     =>  $instansi_asal,
                'kode_satker'       =>  $kode_satker,
                'id_bulan'          =>  $id_bulan,
                'tahun'             =>  $tahun,
                'tanggal'           =>  $tanggal,
                'perihal'           =>  $this->input->post('perihal'),
                'instansi_tujuan'   =>  $this->input->post('instansi_tujuan'),
                'keterangan'        =>  $this->input->post('keterangan')

        );

        $where = array(
            'id_surat' => $id_surat
        );

        $this->m_surat_kepala->update_data($where,$data);
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Mengupdate Surat Kepala',
        );
        $this->session->set_flashdata('flash','Surat Kepala Berhasil Diupdate');
        $this->m_aktivitas->input_data($aktivitas);
        redirect('admin/surat_kepala');
        } else{
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_kepala->edit_data($where)->result();
        $this->template->load('layouts/template', 'admin/edit_surat_kepala', $data);             
        }
    }
    public function upload_file(){
        $id_surat = $this->input->post('id_surat');
        $is_upload = 1;
        $file = $_FILES['file'];
        if ($file=''){

        } else{
                $config['upload_path']          = './assets/uploads/surat_kepala/';
                $config['allowed_types']        = 'pdf';
                
                $this->load->library('upload');
                $this->upload->initialize($config);
                
                if(!$this->upload->do_upload('file')){
                    echo  $this->upload->display_errors(); die();
                } else{
                    $data = array('upload_data' => $this->upload->data());
                    $file = $this->upload->data('file_name');
                }
            }       
        $data = array(
            'is_upload'     => $is_upload,
            'file'          => $file
        );

        $where = array(
            'id_surat' => $id_surat
        );
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Mengunggah Surat Kepala',
        );
        $this->session->set_flashdata('flash','Surat Kepala Berhasil Diunggah');
        $this->m_surat_kepala->update_data($where,$data);
        $this->m_aktivitas->input_data($aktivitas);
        redirect('admin/surat_kepala');
    }

}
