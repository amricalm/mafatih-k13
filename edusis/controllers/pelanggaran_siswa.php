<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of peserta
 *
 * @author andhana
 */
 
 class Pelanggaran_siswa extends CI_Controller
 {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggaran_siswa_model');  
        $this->load->model('pelanggaran_model'); 
        $this->load->model('app_model');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
        
    }
    function index()
    {
        redirect('pelanggaran_siswa/form_pelanggaran');
    }
    function form_pelanggaran()
    {	
        $this->load->library('pagination');
        $data['nama_sekolah']                       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $txtcari                                    = ($this->input->post('submit')!='') ? $this->input->post('txtcari') : $this->session->userdata('txtcaripelanggaran');
        $this->session->set_userdata(array('txtcaripelanggaran_siswa'=>$txtcari));
        $data['txtcaripelanggaran_siswa']           = $this->session->userdata('txtcaripelanggaran_siswa');

        $limit                                      = 50;
        $per_page                                   = $limit;
        $uri_segment                                = 3;
        $data['title']                              = ' | Daftar pelanggaran Siswa';
        $data['menu']                               = $this->app_model->tampil_menu('BK');
        $data['get_pelanggaran_siswa']              = $this->pelanggaran_siswa_model->getpelanggaransiswa();
        //echo $this->db->last_query();
        $this->load->view('pelanggaran_siswa/tabel_pelanggaran',$data);
    }  
    function pelanggaran_form($trx)
    {
        $data['nama_sekolah']                   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']                           = $this->app_model->tampil_menu('BK');
        if ($trx=="db_add")
        {
            $data['title']                      = ' | Input Data pelanggaran';
            $this->load->view("pelanggaran_siswa/form_pelanggaran",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['title']                      = ' | Edit Pelanggaran Siswa';
            $data['tgl']                        = $this->pelanggaran_model->gettgl($this->uri->segment(4));
            $data['data']                       = $this->pelanggaran_siswa_model->get($this->uri->segment(4));
            //echo $this->db->last_query();
            $this->load->view("pelanggaran_siswa/form_pelanggaran_edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->pelanggaran_siswa_exec('db_del',$this->uri->segment(4));
        }
    }
    function pelanggaran_siswa_exec($trx)
    {
        $data['kd_sekolah']                     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                        = $this->session->userdata('th_ajar');
        $data['p_nl']                           = $this->session->userdata('kd_semester');
        $data['nis']                            = $this->input->post('nis');
        $data['tgl']                            = $this->input->post('tgl');
        $data['kd_pelanggaran']                 = $this->input->post('kd_pelanggaran');
        $data['kejadian']                       = $this->input->post('kejadian');
        $data['hukuman']                        = $this->input->post('hukuman');
        
        if ($trx=="db_add")
        {
            $data['kd_pelanggaran_siswa']       = 'PS'.$this->app_model->max_lima_karakter($this->pelanggaran_siswa_model->get_max()+1);
            if($this->pelanggaran_siswa_model->simpan($data))
            {
                redirect('pelanggaran_siswa/form_pelanggaran');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->pelanggaran_siswa_model->update($this->input->post('kd_pelanggaran_siswa'),$data))
            {
                redirect('pelanggaran_siswa/form_pelanggaran/'.$this->uri->segment(4));
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->pelanggaran_siswa_model->hapus($this->uri->segment(4)))
            {
                redirect('pelanggaran_siswa/form_pelanggaran/');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
 }
 
  