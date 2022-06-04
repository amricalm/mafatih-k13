<?php
/**
 * Description of LCK
 *
 * @author andhana
 */
class Lck extends CI_Controller{
    
    var $global;
    function __construct()
    {
        parent::__Construct();
        $this->load->model('mp_model');
        $this->load->model('app_model');
        $this->load->model('lck_model');
        $this->global['kd_sekolah'] = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']    = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('mp/daftar');
    }
    function daftar($mp='',$tk='', $kd_jurusan='')
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Template Laporan Capaian Kompetensi';
        $data['menu']              = $this->app_model->tampil_menu('KTSP');
        
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['kd_semester']       = $this->session->userdata('kd_semester');

        
        $data['kd_mp']             = $mp;//$this->uri->segment(3);
        $data['tk']                = $tk;//$this->uri->segment(4);
        
        $data['mp']                = $this->mp_model->mp();
        $data['isi']               = $this->lck_model->get($data['kd_sekolah'],$data['th_ajar'],$data['kd_semester'],$data['tk'],"",$data['kd_mp']);
        $this->load->view('lck/daftar',$data);
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
    function aj_simpan()
    {
        $this->load->model('app_model');
        $this->load->library('curl');
        $data                           = $_REQUEST['data'];
        $data                           = json_decode($data,true);

        $data['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                = $this->session->userdata('th_ajar');
        $data['p_nl']                   = $this->session->userdata('kd_semester');
        $data['kd_jurusan']             = "";
        if ($data['kd_sekolah']=='02')
        {
            $data['kd_mp']  ="";
            $data['tk']     ="";
        }        
        $data                           = json_encode($data);
        
        $url                            = $this->app_model->system('prestasi_service_url'). "/UpdateLckTemplate";
        $this->curl->create($url);  
        $this->curl->post($data); 
        $result                         = "";
        $result                         = json_decode($this->curl->execute());
            
        echo $result;    
        
    }
}
?>