<?php
class Kesehatan_siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kesehatansiswa_model');
        $this->load->model('siswa_model');
        $this->load->model('kelas_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']                = $this->session->userdata('th_ajar');
    }
    function index()
    {
        redirect('kesehatan_siswa/daftar');
    }
    function daftar()
    {
        $data['nama_sekolah']                   = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                          = ' | Daftar Kesehatan';
        $data['menu']                           = $this->app_model->tampil_menu('Evaluasi');
        $data['kd_semester']					= $this->session->userdata('kd_semester');
        //$data['kelas']                       = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kelas']                          = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['eskulsiswa']                     = $this->kesehatansiswa_model->get();
        $data['pilihkelas']                     = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']                 = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['kelas_siswa']                    = $this->siswa_model->nama($data['pilihkelas']);
        $this->load->view('kesehatan/daftar_kesehatansiswa',$data);
    }
    function get_eskul_nis()
    {
        $data['kelas']                          = $this->input->post('kelas');
        $data['nis']                            = $this->input->post('nis');
        $data['p_nl']                           = $this->session->userdata('kd_semester');//$this->input->post('p_nl');
        $data['kd_kesehatan']                   = '';
        $sdata                                  = $this->kesehatansiswa_model->get_kelas_nis($data);
        $tabel                                  = '';
        $i                                      = 1;
        $seqelement                             = 0;
        $tabel                                  .= '<table id="dataeskul" width="100%" class="tables">';
        $tabel                                  .= '<tr>
                                                    <th width="5%" align="center">#</th>
                                                    <th width="20%">Aspek yang dinilai</th>
                                                    <th width="75%">Keterangan</th>  
                                                </tr>';
        foreach($sdata->result() as $rowdata)
        {   
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            $tabel                              .= '<tr'.$bg.'>';
            $tabel                              .= '<td>'.$i.'</td>';
            $tabel                              .= '<td><input type="hidden" name="kd_eskul[]" id="kd_eskul" value="'.$rowdata->kd_kesehatan.'"/>'.$rowdata->nm_kesehatan.'</td>';
            $tabel                              .= '<td><input type="text" name="hasil'.$seqelement.'" id="hasil" value="'.$rowdata->hasil.'" style="border:none; text-align:left; width: 100%; background:transparent;"></td>';
            $tabel                              .= '</tr>';
            $i++;
            $seqelement++;
        }
        $tabel                                  .= '<tr><td width="5%" style=" border-bottom: none; border-left: none; border-right: none;"></td><td width="20%" style=" border-bottom: none; border-left: none; border-right: none;"></td><td width="75%" align="right" style=" border-bottom: none; border-left: none; border-right: none;">'.form_submit('submit','Simpan','class="input-submit"').'</td></tr>';
        $tabel                                  .= '</table>';
        //$tabel .= $this->db->last_query();
        echo $tabel;
    }
    function simpan()
    {
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        //$data['p_nl']           = $this->input->post('p_nl');
        $data['kelas']          = $this->input->post('kelas');
        $data['nis']            = $this->input->post('nis');
        $kd_eskul               = $this->input->post('kd_eskul');
        for($i=0;$i<count($kd_eskul);$i++)
        {           
           $data['kd_kesehatan']= $kd_eskul[$i];
           $data['hasil']       = $this->input->post('hasil'.$i);
           if($this->kesehatansiswa_model->get_kelas_nis($data)->num_rows() > 0)
           {
                //echo "test"; die();
                $this->kesehatansiswa_model->update($data);
           }
           else
           {
                $this->kesehatansiswa_model->simpan($data);
           }
        }
        redirect('kesehatan_siswa/daftar/'.str_replace(' ','+',$data['kelas']));

    }
}