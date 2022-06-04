<?php
class Kepribadian_siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kepribadian_siswa_model');
        $this->load->model('siswa_model');
        $this->load->model('hasilbelajar_model');
        $this->load->model('kelas_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']                = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('kepribadian_siswa/daftar');
    }
    function daftar()
    {
        $data['nama_sekolah']                   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                          = ' | Daftar ekstrakurikuler';
        $data['menu']                           = $this->app_model->tampil_menu('BK');
        
        $data['kelas']                          = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kepribadian_siswa']                     = $this->kepribadian_siswa_model->get();
        $data['pilihkelas']                     = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']                 = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['kelas_siswa']                    = $this->siswa_model->nama($data['pilihkelas']);
        $this->load->view('kepribadian/daftar_kepribadian_siswa',$data);
    }
    function get_kepribadian_nis()
    {
        $data['kelas']                          = $this->input->post('kelas');
        $data['nis']                            = $this->input->post('nis');
        $data['p_nl']                           = $this->input->post('p_nl');
        $data['kd_pribadi']                     = '';
        $sdata                                  = $this->kepribadian_siswa_model->get_kelas_nis($data);
        $tabel                                  = '';
        $i                                      = 1;
        $seqelement                             = 0;
        $tabel                                  .= '<table id="datakepribadian" width="100%" class="tables">';
        $tabel                                  .= '<tr>
                                                    <th width="5%" align="center">#</th>
                                                    <th width="85%">Keprbadian</th>
                                                    <th width="10%">Nilai</th>  
                                                </tr>';
        foreach($sdata->result() as $rowdata)
        {   
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            $tabel                              .= '<tr'.$bg.'>';
            $tabel                              .= '<td>'.$i.'</td>';
            $tabel                              .= '<td><input type="hidden" name="kd_pribadi[]" id="kd_pribadi" value="'.$rowdata->kd_pribadi.'"/>'.$rowdata->ket_pribadi.'</td>';
            $tabel                              .= '<td><input type="text" style="border:none; background:transparent; width: 80px; text-align:center;" name="hasil'.$seqelement.'" id="hasil" value="'.$rowdata->hasil.'"/></td>';
            $tabel                              .= '</tr>';
            $i++;
            $seqelement++;
        }
        $tabel                                  .= '<tr><td width="5%" style=" border-bottom: none; border-left: none; border-right: none;"></td><td width="85%" style=" border-bottom: none; border-left: none; border-right: none;"></td><td width="10%" align="left" style=" border-bottom: none; border-left: none; border-right: none;">'.form_submit('submit','Simpan','class="input-submit"').'</td></tr>';
        $tabel                                  .= '</table>';
        echo $tabel;
    }
    function daftar1($kelas=0,$nama=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Raport');
        $base_url                   = base_url().'index.php/hasilbelajar/report_nilai1/'.$kelas.'/'.$nama;
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }        
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }
        $data['nama_pilih']         = $nama;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        
        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];
        
        $data['kd_mp']              = ($this->hasilbelajar_model->tampil($data['pilihkelas'])->num_rows()>0) ? $this->hasilbelajar_model->tampil($data['pilihkelas'])->row()->kd_mp : '';
        $data['kd_mp']              = $this->input->post('kd_mp');
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kepribadian']        = $this->kepribadian_siswa_model->get_kelas_nis($data);
        echo $this->db->last_query();
        die();
        $data['tampil'] = ($this->input->post('skelas')=='' || $this->input->post('nis')=='') ? ' ' : 'a';
        $this->load->view('kepribadian/kepribadian_siswa',$data);
    }
    function simpan()
    {
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->input->post('p_nl');
        //$data['p_nl']           = $this->session->userdata('kd_semester');
        //$data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kelas']          = $this->input->post('kelas');
        $data['nis']            = $this->input->post('nis');
        $kd_pribadi               = $this->input->post('kd_pribadi');
        for($i=0;$i<count($kd_pribadi);$i++)
        {
           $data['kd_pribadi']  = $kd_pribadi[$i];
           $data['hasil']       = $this->input->post('hasil'.$i);
           if($this->kepribadian_siswa_model->get_kelas_nis($data)->num_rows() > 0)
           {
                $this->kepribadian_siswa_model->update($data);
           }
           else
           {
                $this->kepribadian_siswa_model->simpan($data);
           }
        }
        redirect('kepribadian_siswa/daftar/'.str_replace(' ','+',$data['kelas']));

    }
}