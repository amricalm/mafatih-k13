<?php
class Kompetensi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('app_model');
        $this->load->model('kelas_model');
        $this->load->model('mp_model');
        $this->load->model('kompetensi_model');
        $this->global['kd_sekolah']= $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']   = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('kompetensi/daftar');
    }
    function daftar($mp='',$tk='')
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Daftar Kompetensi';
        $data['menu']              = $this->app_model->tampil_menu('KTSP');
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['kd_semester']       = $this->session->userdata('kd_semester');
        $data['mp']                = $this->mp_model->mp();
        //$data['sm']                = $this->kompetensi_model->semester();
        //$data['jr']                = $this->kompetensi_model->jurusan();
        $data['kd_mp']             = $this->uri->segment(3);
        $data['tk']                = $this->uri->segment(4);
        $data['kompetensi']        = $this->kompetensi_model->getKompetensiDasar('',$data['kd_semester'],$data['tk'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar']);
        $this->load->view('kompetensi/daftar',$data);
    }
    function simpan()
    {
        //print_r($this->input->post());
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['kd_semester']    = $this->session->userdata('kd_semester');
        $data['kd_mp']          = $this->uri->segment(3);
        $data['tk']             = $this->uri->segment(4);
        $id_sk                  = $this->input->post('id_sk');
        for($i=0;$i<count($id_sk);$i++)
        {
           $datas['id_sk']      = $id_sk[$i];         
           $data['skm']         = $this->input->post('skm'.$i);
           if($this->kompetensi_model->getskmp($data['kd_sekolah'],$data['th_ajar'],$data['kd_semester'],$data['kd_mp'],$data['tk'])->num_rows() > 0)
           {
                $this->kompetensi_model->update($data['kd_sekolah'],$data['th_ajar'],$data['kd_semester'],$data['kd_mp'],$data['tk'],$datas['id_sk'],$data['skm']);
                //echo $this->db->last_query();
                //die();
           }
           else
           {
                //$this->kompetensi_model->simpan($data);
           }
        }
        redirect('kompetensi/daftar/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
    }
    function kompetensi_dasar_form($trx)
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Daftar Kompetensi';
        $data['menu']              = $this->app_model->tampil_menu('KTSP');
        
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['kd_semester']       = $this->session->userdata('kd_semester');
        $data['kd_mp']             = $this->uri->segment(4);
        $data['mp']                = $this->mp_model->get_all($data['kd_mp']);
        $data['tk']                = $this->uri->segment(5);
        $jmlsk                     = $this->kompetensi_model->getskmp($data['kd_sekolah'],$data['th_ajar'],$data['kd_semester'],$this->uri->segment(4),$this->uri->segment(5));
        $data['sk']                = $jmlsk->num_rows() + 1;
        $data['pilih_ki']          = "";
        $data['ki']                = $this->kompetensi_model->getKompetensiInti();
        
        if ($trx=="db_add")
        {
            $data['title']                = ' | Input Kompetensi';
            $this->load->view("kompetensi/tambah",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['kd_ki']                = $this->uri->segment(6);
            $data['kd_kd']                = $this->uri->segment(7);
            $data['nama_sekolah']         = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
            $data['title']                = ' | Edit kompetensi';
            $data['menu']                 = $this->app_model->tampil_menu('KTSP');
            
            $data['data']                 = $this->kompetensi_model->get_kdkd('',$data['kd_semester'],$data['tk'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar'],$data['kd_ki'],$data['kd_kd']);

            $this->load->view("kompetensi/editkd",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->kompetensi_dasar_exec('db_del');
        }
    }
    function kompetensi_dasar_exec($trx)
    {
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['kd_semester']    = $this->session->userdata('kd_semester');
        $data['tk']             = $this->input->post('tk');
        //$data['kd_jurusan']     = "";//""$this->input->post('kd_jurusan');
        $data['kd_mp']          = $this->input->post('kd_mp');
        $data['kd_sk']          = "";//"$this->input->post('kd_sk');
        $data['kd_ki']          = $this->input->post('kd_ki');
        $data['kd_kd']          = $this->input->post('kd_kd');

        $data['ket_kd']         = $this->input->post('ket_kd');
        $data['skm']            = $this->input->post('skm');
        
        if ($trx=="db_add")
        {
            if($this->kompetensi_model->simpankd($data))
            {
                redirect('kompetensi/daftar/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->kompetensi_model->ubahkd($data['th_ajar'],$data['kd_sekolah'],$data['kd_semester'],$data['tk'],$data['kd_mp'],"",$data['kd_ki'],$data['kd_kd'],$data))
            {
                redirect('kompetensi/daftar/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {   
            $data['kd_mp'] = $this->uri->segment(4);
            $data['tk']    =  $this->uri->segment(5);
            $data['kd_ki'] =  $this->uri->segment(6);
            $data['kd_kd'] =  $this->uri->segment(7);
            if($this->kompetensi_model->hapuskd($data['th_ajar'],$data['kd_sekolah'],$data['kd_semester'],$data['tk'],$data['kd_mp'],"",$data['kd_ki'],$data['kd_kd'] ))
            {
                redirect('kompetensi/daftar/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
    function standar_kd($mp='',$tk='')
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Kompetensi Dasar';
        $data['menu']              = $this->app_model->tampil_menu('KTSP');
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['kd_semester']       = $this->session->userdata('kd_semester');
        $data['mp']                = $this->mp_model->get_all($this->uri->segment(6));
        $data['sk']                = $this->kompetensi_model->get_sk($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$data['kd_sekolah'],$data['th_ajar']);
        $data['kd']                = $this->kompetensi_model->get_kd($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$data['kd_sekolah'],$data['th_ajar']);
        //echo $this->db->last_query();
        $this->load->view('kompetensi/kd',$data);
    }
    function kd_form($trx)
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']              = $this->app_model->tampil_menu('KTSP');
        
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['mp']                = $this->mp_model->get_all($this->uri->segment(7));
        $jmlkd                     = $this->kompetensi_model->get_kd($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$data['kd_sekolah'],$data['th_ajar']);
        $data['kd']                = $jmlkd->num_rows() + 1;
        if ($trx=="db_add")
        {
            $data['title']                = ' | Input Kompetensi dasar';
            $this->load->view("kompetensi/tambahkd",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['nama_sekolah']         = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
            $data['title']                = ' | Edit kompetensi dasar';
            $data['menu']                 = $this->app_model->tampil_menu('KTSP');
            $data['ket_kd']               = $this->kompetensi_model->get_kdkd($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$data['kd_sekolah'],$data['th_ajar'],$this->uri->segment(9));
            //echo $this->db->last_query();
            $data['data']                 = $this->kompetensi_model->getbyid_sk($this->uri->segment(4));
            
            $this->load->view("kompetensi/editkd",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->kd_exec('db_del',$this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$this->uri->segment(8));
        }
    }
    function kd_exec($trx)
    {
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['kd_semester']    = $this->input->post('kd_semester');
        $data['kd_mp']          = $this->input->post('kd_mp');
        $data['tk']             = $this->input->post('tk');
        $data['kd_sk']          = $this->input->post('kd_sk');
        $data['id_sk']          = $this->input->post('id_sk');
        $data['kd_kd']          = $this->input->post('kd_kd');
        $data['ket_kd']         = $this->input->post('ket_kd');
        $data['skm']            = $this->input->post('skm');
        if ($trx=="db_add")
        {
            if($this->kompetensi_model->simpankd($data))
            {
                redirect('kompetensi/standar_kd/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8));
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->kompetensi_model->ubahkd($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$this->uri->segment(8),$this->uri->segment(9),$data))
            {
                redirect('kompetensi/standar_kd/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8));
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->kompetensi_model->hapuskd($this->uri->segment(4),$data))
            {
                redirect('kompetensi/standar_kd/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8));
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
    function indikator($mp='',$tk='')
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Kompetensi Dasar';
        $data['menu']              = $this->app_model->tampil_menu('KTSP');
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['kd_semester']       = $this->session->userdata('kd_semester');
        $data['mp']                = $this->mp_model->get_all($this->uri->segment(6));
        $datas['kd_mp']            = $this->uri->segment(6);
        $datas['tk']               = $this->uri->segment(5);
        $data['kd']                = $this->kompetensi_model->get_idr($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$this->uri->segment(8),$data['kd_sekolah'],$data['th_ajar']);
        $data['indikator']         = $this->kompetensi_model->get_indikator($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$this->uri->segment(8),$data['kd_sekolah'],$data['th_ajar']);
        //echo $this->db->last_query();
        $this->load->view('kompetensi/indikator',$data);
    }
    function Indikator_form($trx)
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['menu']              = $this->app_model->tampil_menu('KTSP');
        
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['mp']                = $this->mp_model->get_all($this->uri->segment(7));
        $jmlidr                    = $this->kompetensi_model->get_kd_idr($this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$this->uri->segment(8),$this->uri->segment(9),$data['kd_sekolah']);
        //echo $this->db->last_query();
        $data['idr']               = $jmlidr->num_rows() + 1;
        if ($trx=="db_add")
        {
            $data['title']                = ' | Input Indikator';
            $this->load->view("kompetensi/tambah_indikator",$data);
        }
        elseif ($trx=="db_edit")
        {   
            $data['nama_sekolah']         = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
            $data['title']                = ' | Edit Indikator';
            $data['menu']                 = $this->app_model->tampil_menu('KTSP');
            $data['ket_idr']              = $this->kompetensi_model->get_kdindikator($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$this->uri->segment(8),$this->uri->segment(9),$this->uri->segment(10),$data['kd_sekolah'],$data['th_ajar']);
            $data['data']                 = $this->kompetensi_model->getbyid_sk($this->uri->segment(4));
            
            $this->load->view("kompetensi/edit_indikator",$data);
        }
        elseif ($trx=="db_del")
        {
            $this->indikator_exec('db_del',$this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$this->uri->segment(8),$this->uri->segment(9));
        }
    }
    function indikator_exec($trx)
    {
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['kd_semester']    = $this->input->post('kd_semester');
        $data['kd_mp']          = $this->input->post('kd_mp');
        $data['tk']             = $this->input->post('tk');
        $data['id_sk']          = $this->input->post('id_sk');
        $data['kd_sk']          = $this->input->post('kd_sk');
        $data['kd_idr']         = $this->input->post('kd_idr');
        $data['kd_kd']          = $this->input->post('kd_kd');
        $data['ket_idr']        = $this->input->post('ket_idr');
        if ($trx=="db_add")
        {
            if($this->kompetensi_model->simpanidr($data))
            {
                //echo $this->db->last_query();
                redirect('kompetensi/indikator/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8).'/'.$this->uri->segment(9));
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal simpan!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_edit")
        {   
            if($this->kompetensi_model->ubahidr($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6),$this->uri->segment(7),$this->uri->segment(8),$this->uri->segment(9),$this->uri->segment(10),$data))
            {
                redirect('kompetensi/indikator/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8).'/'.$this->uri->segment(9));
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal update!");history.go(-1);</script>';
            }
        }
        elseif ($trx=="db_del")
        {
            if($this->kompetensi_model->hapusidr($this->uri->segment(4),$data))
            {
                redirect('kompetensi/indikator/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8).'/'.$this->uri->segment(9));
                //echo $this->db->last_query();
                //die();
            }
            else
            {
                echo '<script type="text/javascript">alert("Gagal hapus!");history.go(-1);</script>';
            }
        }
    }
    function daftar_kompetensi()
    {
        $data['nama_sekolah']            = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                   = ' | Daftar Rencana Pembelajaran & Penilaian';
        $data['menu']                    = $this->app_model->tampil_menu('Laporan');
        
        $data['pilihkelas']              = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']          = str_replace('+',' ',$this->uri->segment(3));
        }        
        $data['pilihmp']                 = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihmp']             = str_replace('+',' ',$this->uri->segment(4));
        }
        $datas['kelas']                  = $data['pilihkelas'];
        $datas['kd_mp']                  = $data['pilihmp'];
        $datas['tk']                     = $this->uri->segment(3);
        $data['tk']                      = $this->uri->segment(3);
        $data['kelas']                   = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['mp']                      = $this->mp_model->get_mp($this->global['kd_sekolah']);
        if($this->uri->segment(4)!='0' || $this->uri->segment(4)!='')
        {
            $data['kompetensi']              = $this->kompetensi_model->get_skkd_bykdmp($datas);
        }
        else
        {
            $data['kompetensi']              = $this->kompetensi_model->get_skkd_bykdmppdf($datas);
        }
        //echo $this->db->last_query();
        //die();
        $this->load->view('kompetensi/daftar_kompetensi',$data);
    }
    
    
}
