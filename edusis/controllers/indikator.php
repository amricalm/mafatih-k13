<?php
class Indikator extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('indikator_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']                = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('indikator/daftar');
    }
    function daftar()
    {
        $data['nama_sekolah']             = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                    = ' | Indikator Sikap';
        $data['menu']                     = $this->app_model->tampil_menu('File');
        $data['indikator']                = $this->indikator_model->get('');
        
        $this->load->view('indikator/daftar',$data);
    }
    function indikator_form($trx)
    {
        $data['nama_sekolah']             = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']                     = $this->app_model->tampil_menu('File');
        if ($trx=="db_add")
        {
            $data['title']                = ' | Input Data Indikator Sikap';
            $this->load->view("indikator/tambah",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['title']                = ' | Edit Data Indikator';
            $data['data']                 = $this->indikator_model->get($this->uri->segment(4));
            $this->load->view("indikator/edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->indikator_exec('db_del',$this->uri->segment(4));
        }
    }
    function indikator_exec($trx)
    {
        $data['kd_sikap']               = $this->input->post('kd_sikap');
        $data['nm_sikap']               = $this->input->post('nm_sikap');
        
        if ($trx=="db_add")
        {
            if($this->indikator_model->simpan($data))
            {
                redirect('indikator/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Save!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->indikator_model->update($this->input->post('kd_sikap'),$data))
            {
                redirect('indikator/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->indikator_model->hapus($this->uri->segment(4)))
            {
                redirect('indikator/daftar/');
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Delete!");history.go(-1);</script>';
            }
        }
    }
}