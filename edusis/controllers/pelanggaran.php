<?php
class Pelanggaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggaran_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']   = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']      = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('pelanggaran/daftar');
    }
    function daftar($pelanggaran='0')
    {	
        $data['nama_sekolah']         = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                = ' | Daftar pelanggaran';
        $data['menu']                 = $this->app_model->tampil_menu('File');
        $base_url                     = base_url().'index.php/pelanggaran/daftar/'.$pelanggaran;
        $data['pilihkd_tpelanggaran'] = $this->uri->segment(3);
        $data['kd_tpelanggaran']      = $this->pelanggaran_model->get_tpelanggaran('');
        $data['pelanggaran']          = $this->pelanggaran_model->get($this->uri->segment(3));
        $this->load->view('pelanggaran/daftar',$data);
    }
    function pelanggaran_form($trx)
    {   
        //$kd_tpelanggaran              = $this->pelanggaran_model->get_kdtpelanggaran($this->uri->segment(4))->kd_pelanggaran;
        $data['nama_sekolah']         = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']                 = $this->app_model->tampil_menu('File');
        //$data['kd_tpelanggaran']      = $this->pelanggaran_model->get_kdtpelanggaran($this->uri->segment(4))->kd_pelanggaran;
        $data['pelanggaran']          = $this->pelanggaran_model->get_tpelanggaran('');
        if ($trx=="db_add")
        {
            $data['title']            = ' | Input Data pelanggaran';
            $this->load->view("pelanggaran/tambah",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
            $data['title']          = ' | Edit Data pelanggaran';
            $data['data']           = $this->pelanggaran_model->get_mpelanggaran($this->uri->segment(4));
            $this->load->view("pelanggaran/edit",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->pelanggaran_exec('db_del',$this->uri->segment(4));
        }
    }
    function pelanggaran_exec($trx)
    {
        $data['kd_tpelanggaran']    = $this->input->post('kd_tpelanggaran');
        //$data['kd_pelanggaran']     = $this->input->post('kd_pelanggaran');
        $data['nm_pelanggaran']     = $this->input->post('nm_pelanggaran');
        $data['point']              = $this->input->post('point');
        $data['ket']                = $this->input->post('ket');
        
        if ($trx=="db_add")
        {
            if($this->pelanggaran_model->simpan($data))
            {
                redirect('pelanggaran/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            
            if($this->pelanggaran_model->update($this->input->post('kd_pelanggaran'),$data))
            {
                redirect('pelanggaran/daftar');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->pelanggaran_model->hapus($this->uri->segment(4)))
            {
                redirect('pelanggaran/daftar/');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
    
      
    function daftar_tpelanggaran($pelanggaran='0',$off=0)
    {	
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Daftar pelanggaran';
	    $data['menu']               = $this->app_model->tampil_menu('File');
        $data['pelanggaran']        = $this->pelanggaran_model->get_tpelanggaran();

        $this->load->view('pelanggaran/daftar_tpelanggaran',$data);
    }
    function tpelanggaran_form($trx)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']               = $this->app_model->tampil_menu('File');
        if ($trx=="db_add")
        {
            $data['title']          = ' | Input Data pelanggaran';
            $this->load->view("pelanggaran/tambah_tpelanggaran",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
            $data['title']          = ' | Edit Data pelanggaran';
            $data['data']           = $this->pelanggaran_model->get_tpelanggaran($this->uri->segment(4));
            $this->load->view("pelanggaran/edit_tpelanggaran",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->tpelanggaran_exec('db_del',$this->uri->segment(4));
        }
    }
    function tpelanggaran_exec($trx)
    {
        $data['kd_tpelanggaran']     = $this->input->post('kd_tpelanggaran');
        $data['nm_tpelanggaran']     = $this->input->post('nm_tpelanggaran');
        
        if ($trx=="db_add")
        {
            if($this->pelanggaran_model->get_tpelanggaran($data['kd_tpelanggaran'])->num_rows()==0)
            {
                if($this->pelanggaran_model->simpantpelanggaran($data))
                {
                    redirect('pelanggaran/daftar_tpelanggaran');
                }
                else
                {
                    echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("'."Proses simpan gagal, mohon periksa data kode pelanggaran sudah terdaftar!".'");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->pelanggaran_model->updatetpelanggaran($data['kd_tpelanggaran'],$data))
            {
                redirect('pelanggaran/daftar_tpelanggaran');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->pelanggaran_model->hapustpelanggaran($this->uri->segment(4)))
            {
                redirect('pelanggaran/daftar_tpelanggaran');
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }  
    function daftar_pelanggaran($pelanggaran='0',$off=0)
    {	
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $this->load->library('pagination');
        $txtcari                            = ($this->input->post('submit')!='') ? $this->input->post('txtcari') : $this->session->userdata('txtcaripelanggaran');
        $this->session->set_userdata(array('txtcaripelanggaran'=>$txtcari));
        $data['txtcaripelanggaran']         = $this->session->userdata('txtcaripelanggaran');
        $data['pelanggaran']                = $this->pelanggaran_model->get('',$this->global['kd_sekolah'],'','','');
        $data['pilihpelanggaran']           = $pelanggaran;
        $data['title']                      = ' | Daftar pelanggaran';
	    
        $limit                              = 50;
        $jmhpelanggaran                     = $this->pelanggaran_model->get('',$this->session->userdata('kd_pelanggaran'),$data['pilihpelanggaran'],'',$data['txtcaripelanggaran'],'');
        $base_url                           = base_url().'index.php/pelanggaran/daftar/'.$data['pilihpelanggaran'];
        $total_row                          = $jmhpelanggaran->num_rows();
        $per_page                           = $limit;
        $uri_segment                        = 3;
        $config                             = $this->app_model->config_pagination($base_url,$total_row,$per_page,$uri_segment);

        $this->pagination->initialize($config);
        $data['pilihkd_tpelanggaran'] = $this->uri->segment(3);
        $data['kd_tpelanggaran']      = $this->pelanggaran_model->get_tpelanggaran('');
        $data['pelanggaran']          = $this->pelanggaran_model->get($this->uri->segment(3));
        
        $this->load->view('pelanggaran/popup_pelanggaran',$data);
    }  
}