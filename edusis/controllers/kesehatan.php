<?php
class Kesehatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kesehatan_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']                = $this->session->userdata('th_ajar');
    }
    function index()
    {
        redirect('kesehatan/daftar');
    }
    function daftar()
    {
        $data['nama_sekolah']             = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                    = ' | Daftar kesehatan';
        $data['menu']                     = $this->app_model->tampil_menu('File');
        $data['ekstrakurikuler']          = $this->kesehatan_model->get('');
        
        $this->load->view('kesehatan/daftar',$data);
    }
    function kesehatan_form($trx)
    {
        $data['nama_sekolah']             = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']                     = $this->app_model->tampil_menu('File');
        if ($trx=="db_add")
        {
            $data['title']                = ' | Input Data kesehatan';
            $this->load->view("kesehatan/tambah",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['title']                = ' | Edit Data kesehatan';
            $data['data']                 = $this->kesehatan_model->get($this->uri->segment(4));
            $this->load->view("kesehatan/edit_kesehatan",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->kesehatan_exec('db_del',$this->uri->segment(4));
        }
    }
    function kesehatan_exec($trx)
    {
        $data['kd_kesehatan']               = $this->input->post('kd_eskul');
        $data['nm_kesehatan']               = $this->input->post('nm_eskul');
        $data['kategori']                   = $this->input->post('kategori');
        
        if ($trx=="db_add")
        {
            $data['uid']                = $this->session->userdata('user_name');
            $data['tgl_tambah']         = date('Y-m-d h:i:s');
            if($this->kesehatan_model->simpan($data))
            {
                redirect('kesehatan/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            $data['uid_edit']           = $this->session->userdata('user_name');
            $data['tgl_edit']           = date('Y-m-d h:i:s');
            if($this->kesehatan_model->update($this->input->post('kd_eskul'),$data))
            {
                redirect('kesehatan/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->kesehatan_model->hapus($this->uri->segment(4)))
            {
                redirect('kesehatan/daftar/');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
}