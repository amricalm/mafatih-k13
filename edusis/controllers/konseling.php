<?php
class Konseling extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('konseling_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']        = $this->session->userdata('th_ajar');
        $this->global['p_nl']           = $this->session->userdata('kd_semester');
    }
    function index()
    {
        redirect('konseling/daftar');
    }
    function daftar($konseling=0,$off=0)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Daftar konseling';
	    $data['menu']               = $this->app_model->tampil_menu('BK');
        $data['konseling']          = $this->konseling_model->getkonseling();
        //echo $this->db->last_query();
        $this->load->view('konseling/daftar',$data);
    }
    function konseling_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']               = $this->app_model->tampil_menu('BK');
        if ($trx=="db_add")
        {
            $data['title']              = ' | Input Data konseling';
            $this->load->view("konseling/tambah",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['title']              = ' | Edit Data konseling';
            $data['data']               = $this->konseling_model->get($this->uri->segment(4),'','','','');
            $this->load->view("konseling/edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->konseling_exec('db_del',$this->uri->segment(4));
        }
    }
    function konseling_exec($trx)
    {
        $data['nis']                    = $this->input->post('nis');
        $data['kd_sekolah']             = $this->global['kd_sekolah'];
        $data['th_ajar']                = $this->global['th_ajar'];
        $data['p_nl']                   = $this->global['p_nl'];
        $data['tgl']                    = $this->input->post('tgl');
        $data['masalah']                = $this->input->post('masalah');
        $data['solusi']                 = $this->input->post('solusi');
        
        if ($trx=="db_add")
        {
            $data['uid']                = $this->session->userdata('user_name');
            $data['tgl_tambah']         = date('Y-m-d h:i:s');
            if($this->konseling_model->simpan($data))
            {
                redirect('konseling/daftar');
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
            if($this->konseling_model->update($this->input->post('kd_konseling'),$data))
            {
                redirect('konseling/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->konseling_model->hapus($this->uri->segment(4)))
            {
                redirect('konseling/daftar/');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
}