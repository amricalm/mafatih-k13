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
class Jurusan extends CI_Controller{
    
    function Jurusan()
    {
        parent::CI_Controller();
        $this->load->model('jurusan_model');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('jurusan/daftar');
    }
    function daftar($off=0)
    {	
        $this->load->library('pagination');
        $limit = 20;
        $jmhpegawai                 = $this->jurusan_model->get();
        $base_url                   = base_url().'index.php/jurusan/daftar';
        $total_row                  = $jmhpegawai->num_rows();
        $per_page                   = $limit;
        $uri_segment                = 3;

        $config                     = $this->app_model->config_pagination($base_url,$total_row,$per_page,$uri_segment);

        $this->pagination->initialize($config);
	
        $data['title']              = ' | Jurusan';
	    $data['jmhpegawai']	        = $jmhpegawai->num_rows();
        $data['menu']               = $this->app_model->tampil_menu('FILE');
        $data['jurusan']            = $this->jurusan_model->get('',$limit,$off);
        $this->load->view('jurusan/daftar',$data);
    }
    function jurusan_form($trx)
    {
        $data['menu']           = $this->app_model->tampil_menu('FILE');
        if ($trx=="db_add")
        {
            $data['title']              = ' | Input Jurusan';
            $this->load->view("jurusan/jurusan_form",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['title']              = ' | Edit Kelas';
            $data['data']               = $this->jurusan_model->get($this->uri->segment(4));
            $this->load->view("jurusan/jurusan_form_edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->jurusan_exec($trx,$this->uri->segment(4));
        }
    }
    function jurusan_exec($trx)
    {
        $data['kd_jurusan']              = $this->input->post('kd_jurusan');
        $data['nm_jurusan']              = $this->input->post('nm_jurusan');
        if ($trx=="db_add")
        {
            if($this->jurusan_model->simpan($data))
            {
                redirect('jurusan/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert('."'Data gagal disimpan!'".');history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->jurusan_model->update($this->input->post('kd_jurusan'),$data))
            {
                redirect('jurusan/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert('."'Data gagal disimpan!'".');history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->jurusan_model->hapus($this->uri->segment(4)))
            {
                redirect('jurusan/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert('."'Data gagal disimpan!'".');history.go(-1);</script>';
            }
        }
    }
}

?>