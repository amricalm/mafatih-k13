<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sekuriti extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('sekuriti_model');
        $this->load->model('app_model');
        $this->load->model('guru_model');
        $this->load->model('kelas_model');
        $this->global['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']            = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    
    private function init()
    {
        $data['menu']           = $this->app_model->menu();
        $data['pilihmenu']      = 'Sekuriti';
        $this->load->view('sekuriti/index',$data);
    }
    
    function index()
    {
        $this->init();
    }
    
    function user()
    {
        $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']          = '| User';
        $data['menu']           = $this->app_model->tampil_menu('Sekuriti');
        $data['user'] = $this->sekuriti_model->listUser();
        $this->load->view('sekuriti/user',$data);
    }
 
    function user_form($trx)
    {
        $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']          = ' | User';
        $data['menu']           = $this->app_model->tampil_menu('Sekuriti');
        $data['grup']   = $this->sekuriti_model->listUsergroup('','');
        $data['pegawai']= $this->guru_model->get('','','');
        if ($trx=="db_add")
        {
            $this->load->view("sekuriti/form_user",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['data']   = $this->sekuriti_model->detlistUser($this->uri->segment(4));
            $this->load->view("sekuriti/form_user_edit",$data);
        }
        elseif ($trx=="db_del")
        {
             $this->user_exec($trx,$this->uri->segment(4));
        }
    }
        
    function user_exec($trx)
    {   
        $data['nama_login']     = $this->input->post('nama_login');
        $data['kode_group']     = $this->input->post('kode_group');
        $data['nama_lengkap']   = $this->input->post('nama_lengkap');
        $data['password']       = $this->input->post('password');
        if ($trx=="db_add") 
        {	
            if($this->sekuriti_model->insertuser($data))
            {
                echo '<script type="text/javascript">alert("Berhasil Simpan!");window.location="'.site_url('sekuriti/user').'";</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Simpan Gagal!");history.go(-1);</script>';
            }		
        }
        elseif ($trx=="db_edit")
        {
            if($this->sekuriti_model->updateuser($this->input->post('nama_login'),$data))
            {
                echo '<script type="text/javascript">alert("Update Successfully!");window.location="'.site_url('sekuriti/user').'";</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Save!");history.go(-1);</script>';
            }        
        }
        elseif ($trx=="db_del")
        {
            if($this->sekuriti_model->deleteuser($this->uri->segment(4))==false)
            {
                 echo '<script type="text/javascript">alert("Hapus User Gagal!");history.go(-1);</script>';
            }
        }
        redirect('sekuriti/user');
    }
    function group()
    {   
        $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']          = '| Group User';
        $data['menu']           = $this->app_model->tampil_menu('Sekuriti');
        $data['group'] = $this->sekuriti_model->listUsergroup();
        $this->load->view('sekuriti/groupuser',$data);
    }
    
    function group_form($trx)
    {
        $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']          = ' | Group User';
        $data['menu']           = $this->app_model->tampil_menu('Sekuriti');
        if ($trx=="DB_ADD")
        {
            $this->load->view("sekuriti/form_groupuser",$data);   
        }
        elseif ($trx=="DB_EDIT")
        {   
            $data['data']   = $this->sekuriti_model->detlistUsergroup($this->uri->segment(4));
            //echo $this->db->last_query();
            $this->load->view("sekuriti/form_groupuser_edit",$data);  
        }
        elseif ($trx=="DB_DEL")
        {
            $this->group_exec($trx,$this->uri->segment(4));
        }
    }
        
    function group_exec($trx)
    {
        $data['nm_group']       = $this->input->post('nm_group');
        $data['ket']            = $this->input->post('ket');
        //print_r($this->input->post());die();
        $data['sys_admin']      = $this->input->post('sys_admin')/*($this->input->post('sys_admin')=='on') ? 1 : 0*/;
        $data['sys_keu']        = $this->input->post('sys_keu')/*($this->input->post('sys_keu')=='on') ? 1 : 0*/;
        $data['sys_acounting']  = $this->input->post('sys_acounting')/*($this->input->post('sys_acounting')=='on') ? 1 : 0*/;
        $data['sys_siswa']      = $this->input->post('sys_siswa')/*($this->input->post('sys_siswa')=='on') ? 1 : 0*/;
        if ($trx=="DB_ADD")
        {
            if($this->sekuriti_model->insertgroup($data))
            {
                echo '<script type="text/javascript">alert("Successfully Stored!");window.location="'.site_url('sekuriti/group').'";</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Failed to Save!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="DB_EDIT")
        {
            if($this->sekuriti_model->updategroup($this->input->post('kd_group'),$data))
            {
                echo '<script type="text/javascript">alert("Update Berhasil!");window.location="'.site_url('sekuriti/group').'";</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }        
        }
        elseif ($trx=="DB_DEL")
        {
            if($this->sekuriti_model->deletegroup($this->uri->segment(4))==false)
            {
                 echo '<script type="text/javascript">alert("Hapus Group User Gagal!");history.go(-1);</script>';
            }
        }
        redirect('sekuriti/group');
    }
    function ganti_password()
    {
        $data['password']             = $this->input->post('pwdbaru');
        //echo $this->session->userdata('user_id'); die();
        if($this->sekuriti_model->updatepassword($this->session->userdata('user_id'),$data))
        {
            //echo $this->db->last_query();
            $ch = array('1stLogin'=>1);
            $this->session->set_userdata($ch);
            echo '#';
            
        }
        else
        {
            echo '?';
        }
    }
    function otorisasi()
    {
        $data['nama_sekolah']   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']          = ' | Otorisasi';
        $data['menu']           = $this->app_model->tampil_menu('Sekuriti');
        $data['group']          = $this->sekuriti_model->listUsergroup();
        $data['kelass']         = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kd_group']       = $this->uri->segment(3);
        $data['kelas']          = str_replace('+',' ',$this->uri->segment(4));
        $data['pilih_group']    = $this->uri->segment(3);
        $data['pilih_kelas']    = str_replace('+',' ',$this->uri->segment(4));
        $data['get_mp_sudah']   = $this->sekuriti_model->get_mp_sudah($this->global['kd_sekolah'],$data['kd_group'],$data['kelas']);
        $data['get_mp_belum']   = $this->sekuriti_model->get_mp_belum($this->global['kd_sekolah'],$data['kd_group'],$data['kelas']);
        $this->load->view("sekuriti/otorisasi",$data);
    }
    function otorisasi_exec()
    {
        //print_r($this->input->post());die();
        //$data['kd_sekolah']     = $this->global['kd_sekolah'];
        //$data['th_ajar']        = $this->global['th_ajar'];
        $tipe                   = $this->input->post('tipe');
        if($tipe=='masukotorisasi')
        {
            $data['kd_group']   = $this->input->post('kd_group');
            $data['kelas']      = $this->input->post('kelas');
            $kd_mp              = array();
            $postkd_mp          = explode(',',$this->input->post('kd_mp'));
            for($i=1;$i<=count($postkd_mp);$i++)
            {
                $data['kd_mp']    = $postkd_mp[$i-1];
                if(!$this->sekuriti_model->simpan_otorisasi($data))
                {
                    die('Tidak berhasil tersimpan');
                }
            }
            echo('Berhasil!');
        }
        else
        {
            $data['kd_group']   = $this->input->post('kd_group');
            $data['kelas']      = $this->input->post('kelas');
            $kd_mp              = array();
            $postkd_mp          = explode(',',$this->input->post('kd_mp'));
            for($i=1;$i<=count($postkd_mp);$i++)
            {
                $data['kd_mp']    = $postkd_mp[$i-1];
                if(!$this->sekuriti_model->hapus_otorisasi($data))
                {
                    die('Tidak berhasil tersimpan');
                }
                //echo $this->db->last_query();
            }
            echo('Berhasil!');
        }
    }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>