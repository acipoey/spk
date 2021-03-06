<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->check_login();
        if ($this->session->userdata('id_role') != "2") {
            redirect('', 'refresh');
        }
    }

    public function index()
    {
        $data = konfigurasi('Dashboard');
        $data['surat'] = $this->m_surat_masuk->tampil_data()->result();
        $this->template->load('layouts/member/template', 'member/surat_masuk', $data);
    }

    public function tambah_surat(){
        $this->form_validation->set_rules('nomor_surat','Nomor Surat', 'trim|required');
        $this->form_validation->set_rules('tanggal','Tanggal', 'trim|required');
        $this->form_validation->set_rules('instansi_asal','Instansi Asal', 'trim|required');
        $this->form_validation->set_rules('perihal','Perihal', 'trim|required');

        if($this->form_validation->run() == TRUE){
        $photo = $_FILES['photo'];
            if ($photo=''){
            } else{
                $config['upload_path']          = './assets/uploads/surat_masuk/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

            $this->load->library('upload');
            $this->upload->initialize($config);

                if(!$this->upload->do_upload('photo')){
                    echo  $this->upload->display_errors(); die();
                } else{
                    $data = array('upload_data' => $this->upload->data());
                    $photo = $this->upload->data('file_name');
                }
            }
            $nomor_surat = $this->input->post('nomor_surat');
            $data = array(
                'nomor_surat'       =>  $nomor_surat,
                'tanggal'           =>  $this->input->post('tanggal'),
                'instansi_asal'     =>  $this->input->post('instansi_asal'),
                'perihal'           =>  $this->input->post('perihal'),
                'instansi_tujuan'   =>  $this->input->post('instansi_tujuan'),
                'photo'             =>  $photo,
                'keterangan'        =>  $this->input->post('keterangan')

            );

        $this->m_surat_masuk->input_data($data);
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menambahkan Surat Masuk '.$nomor_surat,
        );
        $this->session->set_flashdata('flash','Surat Masuk Berhasil Ditambahkan');
        $this->m_aktivitas->input_data($aktivitas);
            redirect('member/surat_masuk');

        } else{
            redirect('member/surat_masuk');            
        }


    }

    public function hapus(){
        $id_surat = $this->uri->segment(4);
        for ( $i=5; $i < 25 ; $i++) { 
        $char = $this->uri->segment($i);
            if ($this->uri->segment($i+1)){
                $nomor_surat .= ''.$char.'/';
            }else{
                $nomor_surat .= ''.$char.'';
            }
        }
        $where = array ('id_surat' => $id_surat);
        $this->m_surat_masuk->hapus_data($where);
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Menghapus Surat Masuk '.$nomor_surat,
        );
        $this->m_aktivitas->input_data($aktivitas);
        redirect ('member/surat_masuk');
    }


    public function edit($id_surat){
        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_masuk->edit_data($where)->result();
        $this->template->load('layouts/member/template', 'member/edit_surat_masuk', $data);        
    }
    
    public function update(){
        $id_surat = $this->input->post('id_surat');
        $this->form_validation->set_rules('nomor_surat','Nomor Surat', 'trim|required');
        $this->form_validation->set_rules('tanggal','Tanggal', 'trim|required');
        $this->form_validation->set_rules('instansi_asal','Instansi Asal', 'trim|required');
        $this->form_validation->set_rules('perihal','Perihal', 'trim|required');
        $this->form_validation->set_rules('instansi_tujuan','Perihal', 'trim|required');
        if($this->form_validation->run() == TRUE){
        // $photo = $_FILES['photo'];
        //     if ($photo=''){
        //         $photo='default.png';
        //     } else{
        //         $config['upload_path']          = './assets/uploads/images/foto_profil/';
        //         $config['allowed_types']        = 'gif|jpg|png';
        //         $config['max_size']             = 100;
        //         $config['max_width']            = 1024;
        //         $config['max_height']           = 768;

        //     $this->load->library('upload');
        //     $this->upload->initialize($config);

        //         if(!$this->upload->do_upload('photo')){
        //             echo  $this->upload->display_errors(); die();
        //         } else{
        //             $data = array('upload_data' => $this->upload->data());
        //             $photo=$this->upload->data('file_name');
        //         }
        //     }
        $nomor_surat = $this->input->post('nomor_surat');
        $data = array(
            'nomor_surat'       =>  $nomor_surat,
            'tanggal'           =>  $this->input->post('tanggal'),
            'instansi_asal'     =>  $this->input->post('instansi_asal'),
            'perihal'           =>  $this->input->post('perihal'),
            'instansi_tujuan'   =>  $this->input->post('instansi_tujuan'),
            // 'photo'             => $photo,
            'keterangan'        =>  $this->input->post('keterangan')

        );

        $where = array(
            'id_surat' => $id_surat
        );

        $this->m_surat_masuk->update_data($where,$data);
        $aktivitas = array(
                'username'           =>  $this->session->userdata('username'),
                'aktivitas'         =>  'Mengupdate Surat Masuk '.$nomor_surat,
        );
        $this->m_aktivitas->input_data($aktivitas);
        $this->session->set_flashdata('flash','Surat Masuk Berhasil Diupdate');
        redirect('member/surat_masuk');
        } else{

        $data = konfigurasi('Dashboard');
        $where = array ('id_surat' => $id_surat);
        $data['surat'] = $this->m_surat_masuk->edit_data($where)->result();
        $this->template->load('layouts/member/template', 'member/edit_surat_masuk', $data);             
        
        }

    }

}
