<?php
class Prestasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('prestasi_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']   = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']      = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('daftar_prestasi/daftar');
    }  
    function daftar_prestasi($prestasi='0',$off=0)
    {   
        $this->_kd_sekolah          = $this->session->userdata('kd_sekolah');
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->_kd_sekolah)->nama_sekolah;
        $data['title']              = ' | Daftar prestasi';
        $data['menu']               = $this->app_model->tampil_menu('File');
        $data['prestasi']           = $this->prestasi_model->get_prestasi();

        $this->load->view('prestasi/daftar_prestasi',$data);
    }
    function prestasi_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']               = $this->app_model->tampil_menu('File');
        if ($trx=="db_add")
        {
            $data['title']          = ' | Input Data prestasi';
            $this->load->view("prestasi/tambah_prestasi",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
            $data['title']          = ' | Edit Data prestasi';
            $data['data']           = $this->prestasi_model->get_prestasi($this->uri->segment(4));
            $this->load->view("prestasi/edit_prestasi",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->prestasi_exec('db_del',$this->uri->segment(4));
        }
    }
    function prestasi_exec($trx)
    {
        //$data['kd_prestasi']     = $this->input->post('kd_prestasi');
        $data['nm_prestasi']     = $this->input->post('nm_prestasi');
        $data['point']           = $this->input->post('point');
        $data['ket']             = $this->input->post('ket');
        
        if ($trx=="db_add")
        {
            if($this->prestasi_model->simpanprestasi($data))
            {
                //echo $this->db->last_query();
                //die;
                redirect('prestasi/daftar_prestasi');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->prestasi_model->updateprestasi($this->input->post('kd_prestasi'),$data))
            {
                redirect('prestasi/daftar_prestasi');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->prestasi_model->hapusprestasi($this->uri->segment(4)))
            {
                redirect('prestasi/daftar_prestasi');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }  
    function daftar_prestasisiswa($prestasi='0',$off=0)
    {   
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Daftar prestasi siswa';
        $data['menu']               = $this->app_model->tampil_menu('BK');
        $data['prestasisiswa']      = $this->prestasi_model->get_prestasisiswa();
        //echo $this->db->last_query();
        $this->load->view('prestasi/prestasi_siswa',$data);
    }
    function prestasi_siswa_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']               = $this->app_model->tampil_menu('BK');
        if ($trx=="db_add")
        {
            $data['title']          = ' | Input Data Prestasi Siswa';
            $this->load->view("prestasi/tambah_prestasi_siswa",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
            $data['title']          = ' | Edit Data Prestasi Siswa';
            $data['tgl']            = $this->prestasi_model->gettgl($this->uri->segment(4));
            $data['data']           = $this->prestasi_model->get_kdprestasi($this->uri->segment(4));
            $this->load->view("prestasi/edit_prestasi_siswa",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->prestasi_siswa_exec('db_del',$this->uri->segment(4));
        }
    }
    function prestasi_siswa_exec($trx)
    {
        $data['kd_sekolah']                     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                        = $this->session->userdata('th_ajar');
        $data['p_nl']                           = $this->session->userdata('kd_semester');
        $data['nis']                            = $this->input->post('nis');
        $data['tgl']                            = $this->input->post('tgl');
        $data['kd_prestasi']                    = $this->input->post('kd_prestasi');
        
        if ($trx=="db_add")
        {
            $data['kd_prestasi_siswa']       = 'PS'.$this->app_model->max_lima_karakter($this->prestasi_model->get_max()+1);
            if($this->prestasi_model->simpanprestasisiswa($data))
            {
                redirect('prestasi/daftar_prestasisiswa');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->prestasi_model->updateprestasisiswa((string)$this->input->post('kd_prestasi_siswa'),$data))
            {
                //echo $this->db->last_query();
                //die();
                redirect('prestasi/daftar_prestasisiswa/'.$this->uri->segment(4));
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->prestasi_model->hapusprestasisiswa($this->uri->segment(4)))
            {
                redirect('prestasi/daftar_prestasisiswa/');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }  
    function daftar_popupprestasi($pelanggaran='0',$off=0)
    {   
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Daftar Prestasi';
        $data['prestasi']           = $this->prestasi_model->get_prestasi();
        
        $this->load->view('prestasi/popup_prestasi',$data);
    }  
    
}