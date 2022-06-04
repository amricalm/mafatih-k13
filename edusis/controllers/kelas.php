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
class Kelas extends CI_Controller{
    
    var $global;
    function __construct()
    {
        parent::__construct();
        $this->load->model('jurusan_model');
        $this->load->model('kelas_model');
        $this->load->model('th_ajar_model');
        $this->load->model('guru_model');
        $this->load->model('siswa_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']            = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('kelas/daftar');
    }
    function daftar($off=0)
    {	
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $this->load->library('pagination');
        $limit                      = 100;
        $jmhpegawai                 = $this->kelas_model->get_all($this->global['kd_sekolah']);
        $base_url                   = base_url().'index.php/kelas/daftar';
        $total_row                  = $jmhpegawai->num_rows();
        $per_page                   = $limit;
        $uri_segment                = 3;

        $config                     = $this->app_model->config_pagination($base_url,$total_row,$per_page,$uri_segment);

        $this->pagination->initialize($config);
	   
        $data['title']              = ' | Kelas';
	    $data['kelas']             = $jmhpegawai->num_rows();
        $data['menu']              = $this->app_model->tampil_menu('File');
        //$data['kelas']             = $this->kelas_model->getfilter($this->session->userdata('th_ajar'),$this->global['kd_sekolah'],$limit,$off);
        $data['kelas']              = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        //echo $this->db->last_query();  
	$this->load->view('kelas/daftar',$data);
    } 
    function kelas_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Daftar Guru';
        $data['menu']              = $this->app_model->tampil_menu('File');
        //$data['jurusan']            = $this->jurusan_model->get();
        if ($trx=="db_add")
        {
            $data['title']          = ' | Input Kelas';
            $this->load->view("kelas/kelas_form",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['title']          = ' | Edit Kelas';
            $data['data']           = $this->kelas_model->get(str_replace('%20',' ',$this->uri->segment(4)));
            $this->load->view("kelas/kelas_form_edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->kelas_exec($trx,$this->uri->segment(4));
        }
    }
    function kelas_exec($trx)
	{
        if ($trx=="db_add")
        {
            $data['kd_sekolah']         = $this->global['kd_sekolah'];
            $data['kelas']              = $this->input->post('kelas');
            $data['tingkat']            = $this->input->post('tingkat');
            if($this->kelas_model->periksakelas($data)->num_rows()==0)
            {
                if($this->kelas_model->simpan($data))
                {
                    redirect('kelas/daftar');
                }
                else
                {
                    echo '<script type="text/javascript">alert("'."Gagal simpan!".'");history.go(-1);</script>';
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("'."Proses simpan gagal, mohon periksa data kelas sudah terdaftar!".'");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            $data['kd_sekolah']         = $this->global['kd_sekolah'];
            $data['kelas']              = $this->input->post('kelas');
            $data['tingkat']            = $this->input->post('tingkat');
            if($this->kelas_model->update($this->input->post('kd_kelas'),$data))
            {
                redirect('kelas/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->kelas_model->hapus(str_replace('%20',' ',$this->uri->segment(4))))
            {
                redirect('kelas/daftar');
                //echo $this->db->last_query();
                //die();
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
    function rombongan_belajar($pilihkelas=1)
    {
        $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']          = ' | Rombongan Belajar';
        $data['menu']           = $this->app_model->tampil_menu('File');
        $data['jurusan']        = $this->jurusan_model->get();
        $data['kelas']          = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['pilih_kelas']    = ($this->input->post('kelas')!='') ? $this->input->post('kelas') : str_replace('+',' ',$pilihkelas);
        $data['siswa_kelas']    = $this->siswa_model->get_siswa_kelas($data['pilih_kelas'],$this->global['kd_sekolah'],$this->global['th_ajar']);
        //echo $this->db->last_query();
        //die();
        //echo $this->global['th_ajar'];
        $data['siswa_belum_kelas']= $this->kelas_model->get_kelas_siswa_belum($this->global['kd_sekolah'],$this->global['th_ajar']);
        //echo $this->db->last_query();
        $this->load->view("kelas/rombongan_belajar",$data);
    }
    function rombongan_belajar_exec()
    {
        $data['kd_sekolah']     = $this->global['kd_sekolah'];
        $data['th_ajar']        = $this->global['th_ajar'];
        $tipe                   = $this->input->post('tipe');
        if($tipe=='masukkelas')
        {
            $data['kelas']      = $this->input->post('kelas');
            $nis                = array();
            $postnis            = explode(',',$this->input->post('nis'));
            for($i=1;$i<=count($postnis);$i++)
            {
                $data['nis']    = $postnis[$i-1];
                if(!$this->kelas_model->simpan_siswa_kelas($data))
                {
                    die('Tidak berhasil tersimpan');
                }
            }
            echo('Berhasil!');
        }
        else
        {
            $data['kelas']      = $this->input->post('kelas');
            $nis                = array();
            $postnis            = explode(',',$this->input->post('nis'));
            for($i=1;$i<=count($postnis);$i++)
            {
                $data['nis']    = $postnis[$i-1];
                if(!$this->kelas_model->hapus_siswa_kelas($data))
                {
                    die('Tidak berhasil tersimpan');
                }
            }
            echo('Berhasil!');
        }
    }
}

?>