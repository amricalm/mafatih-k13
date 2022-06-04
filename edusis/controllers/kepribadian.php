<?php
class Kepribadian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kepribadian_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']                = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('kepribadian/daftar');
    }
    function daftar()
    {
        $data['nama_sekolah']             = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                    = ' | Personality List';
        $data['menu']                     = $this->app_model->tampil_menu('File');
        $data['kepribadian']              = $this->kepribadian_model->get('');
        
        $this->load->view('kepribadian/daftar',$data);
    }
    function kepribadian_form($trx)
    {
        $data['nama_sekolah']             = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']                     = $this->app_model->tampil_menu('File');
        if ($trx=="db_add")
        {
            $data['title']                = ' | Input Data Personality';
            $this->load->view("kepribadian/tambah",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['title']                = ' | Edit Data Personality';
            $data['data']                 = $this->kepribadian_model->get($this->uri->segment(4));
            $this->load->view("kepribadian/edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->kepribadian_exec('db_del',$this->uri->segment(4));
        }
    }
    function kepribadian_exec($trx)
    {
        $data['kd_pribadi']             = $this->input->post('kd_pribadi');
        $data['ket_pribadi']            = $this->input->post('ket_pribadi');
        
        if ($trx=="db_add")
        {
            if($this->kepribadian_model->simpan($data))
            {
                redirect('kepribadian/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Save!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->kepribadian_model->update($this->input->post('kd_pribadi'),$data))
            {
                redirect('kepribadian/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->kepribadian_model->hapus($this->uri->segment(4)))
            {
                redirect('kepribadian/daftar/');
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Delete!");history.go(-1);</script>';
            }
        }
    }
}