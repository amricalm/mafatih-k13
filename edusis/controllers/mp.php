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
class Mp extends CI_Controller{
    
    var $global;
    function __construct()
    {
        parent::__Construct();
        $this->load->model('mp_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah'] = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']    = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('mp/daftar');
    }
    function daftar($off=0)
    {	
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $this->load->library('pagination');
        $limit = 50;
        $jmhpegawai                 = $this->mp_model->get_all($this->global['kd_sekolah']);
        $base_url                   = base_url().'index.php/mp/daftar';
        $total_row                  = $jmhpegawai->num_rows();
        $per_page                   = $limit;
        $uri_segment                = 3;

        $config                     = $this->app_model->config_pagination($base_url,$total_row,$per_page,$uri_segment);

        $this->pagination->initialize($config);
	   
        $data['title']              = ' | Mata Pelajaran';
	    $data['mp']                 = $jmhpegawai->num_rows();
        $data['menu']               = $this->app_model->tampil_menu('KTSP');
        $data['mp']                 = $this->mp_model->get_mp($this->global['kd_sekolah']);
        $this->load->view('mp/daftar',$data);
    }
    function mp_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']               = $this->app_model->tampil_menu('KTSP');
        if ($trx=="db_add")
        {
            $data['title']          = ' | Input Mata Pelajaran';
            $this->load->view("mp/mp_form",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['title']          = ' | Edit Mata Pelajaran';
            $data['data']           = $this->mp_model->get_all($this->uri->segment(4),$this->global['kd_sekolah']);
            $this->load->view("mp/mp_form_edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->mp_exec($trx,$this->uri->segment(4));
        }
    }
    function mp_exec($trx)
	{
        $data['nm_mp']          = $this->input->post('nm_mp');
        $data['urutan']         = $this->input->post('urutan');
        if ($trx=="db_add")
        {
            $data['kd_sekolah']         = $this->global['kd_sekolah'];
            $data['kd_mp']              = $this->input->post('kd_mp');
            if($this->mp_model->periksamp($data)->num_rows()==0)
            {
                if($this->mp_model->simpan($data))
                {
                    redirect('mp/daftar');
                    //echo $this->db->last_query();
                    //die();
                }
                else
                {
                    echo '<script type="text/javascript">alert("'."Failed to be saved, please try again!".'");history.go(-1);</script>';
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("'."Kode Mata pelajaran sudah ada!".'");history.go(-1);</script>';
            }
        }        
        elseif ($trx=="db_edit")
        {   
            if($this->mp_model->update(array('kd_mp'=>$this->input->post('kd_mp'),'kd_sekolah'=>$this->global['kd_sekolah']),$data))
            {
                redirect('mp/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("'."Failed to be updated, please try again!".'");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->mp_model->hapus(array('kd_mp'=>$this->uri->segment(4),'kd_sekolah'=>$this->global['kd_sekolah'])))
            {
                redirect('mp/daftar');
            }
        }
    }
    function mpdropdown()
    {
        $data['mp']         = $this->mp_model->mp();
        $data['jn']         = $this->mp_model->jn();
        $data['siswa']      = $this->mp_model->siswa();
        $this->load->view('mp/mp',$data);
    }
    function simpan()
    {
        $data['p_nl']           = '1';
        $data['th_ajar']        = '2011/2012';
        $data['kd_sekolah']     = '11';
        $data['kelas']          = 'II A';
        $data['nis']            = $this->input->post('nis');
        $data['kd_mp']          = $this->input->post('kd_mp');
        $data['kd_jenis_nilai'] = $this->input->post('kd_jenis_nilai');
        $data['nilai']          = (int)$this->input->post('nilai');
        if($this->mp_model->add($data))
        {
            redirect('mp/mpdropdown');
        }
        
    }
}

?>