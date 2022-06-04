<?php
class Task_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd_sekolah,$th_ajar,$p_nl,$kd_mp,$nis,$kelas,$kd_tagihan,$kd_kd,$sub_pnl)
    {
        $sql       = " select ks.nis, ms.nama_lengkap, ks.kelas, nl.kgn, nl.psk, nl.afk ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join tgh_siswa nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql       .= " and nl.kd_mp         = '$kd_mp' ";
        $sql       .= " and nl.p_nl          = '$p_nl' ";
        $sql       .= " and nl.sub_pnl       = '$sub_pnl' ";
        $sql       .= " and nl.kd_tagihan    = '$kd_tagihan'";
        $sql       .= " and nl.kd_kd         = '$kd_kd'";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " and nl.nis           = '$nis' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getpilih($kd_sekolah,$th_ajar,$p_nl,$kd_mp,$nis,$kelas,$kd_tagihan,$sub_pnl,$kd_kd)
    {
        $sql       = " select ks.nis, ms.nama_lengkap, ks.kelas, nl.kd_tagihan, nl.kgn, nl.psk, nl.afk ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join tgh_siswa nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql       .= " and nl.kd_mp         = '$kd_mp' ";
        $sql       .= " and nl.p_nl          = '$p_nl' ";
        $sql       .= " and nl.sub_pnl       = '$sub_pnl' ";
        $sql       .= " and nl.kd_tagihan    = '$kd_tagihan'";
        $sql       .= " and nl.kd_kd         = '$kd_kd'";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " ORDER BY ms.nama_lengkap";
        // echo $sql;die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function simpan($data)
    {
        return $this->db->insert('tgh_siswa',$data);
    }
    function update($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('kd_mp',$data['kd_mp']);
        $this->db->where('kd_tagihan',$data['kd_tagihan']);
        $this->db->where('kd_kd',$data['kd_kd']);

        $this->db->set('kgn',$data['kgn']);
        $this->db->set('psk',$data['psk']);
        $this->db->set('afk',$data['afk']);
        return $this->db->update('tgh_siswa');
    }
    function getkpa($kd_sekolah,$th_ajar,$p_nl,$kd_mp,$nis,$kelas)
    {
        $sql       = " select ks.nis, ms.nama_lengkap, ks.kelas, nl.kgn, nl.afk, nl.psk ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_ips nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql       .= " and nl.kd_mp         = '$kd_mp' ";
        $sql       .= " and nl.p_nl          = '$p_nl' ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        //$sql       .= " and nl.nis           = '$nis' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getinput($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kd_mp          = $data['kd_mp'];
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        //$sql       = " select ks.nis, ms.nama_lengkap, ks.kelas, nl.nilai ";
        //$sql       .= " from kelas_siswa ks ";

        $sql       = " select ks.nis, ms.nama_lengkap, ks.kelas, nl.kgn, nl.afk, nl.psk ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_ips nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql       .= " and nl.kd_mp         = '$kd_mp' ";
        $sql       .= " and nl.p_nl          = '$p_nl' ";
        $sql       .= " and nl.th_ajar       = '$th_ajar' ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and nl.nis           = '$nis' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function save($data)
    {
        return $this->db->insert('nl_ips',$data);
    }
    function edit($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('kd_mp',$data['kd_mp']);

        $this->db->set('kgn',$data['kgn']);
        $this->db->set('psk',$data['psk']);
        $this->db->set('afk',$data['afk']);
        return $this->db->update('nl_ips');
    }
    function siswa_comment($data)
    {
      $CI             = &get_instance();
      $kd_sekolah     = $CI->session->userdata('kd_sekolah');
      $th_ajar        = $CI->session->userdata('th_ajar');
      $p_nl           = $CI->session->userdata('kd_semester');
      $sub_pnl        = $CI->session->userdata('sub_pnl');
      $nis            = $data['nis'];
      $kelas          = $data['kelas'];

      $sql  = 'SELECT comment, naik_kelas ';
      $sql .= 'FROM kelas_siswa ';
      $sql .= 'INNER JOIN ms_siswa AS sis ';
      $sql .= 'ON sis.nis = kelas_siswa.nis ';
      $sql .= 'AND sis.kd_sekolah = kelas_siswa.kd_sekolah ';
      $sql .= 'INNER JOIN nl_comment AS nl ';
      $sql .= 'ON kelas_siswa.kd_sekolah = nl.kd_sekolah ';
      $sql .= 'AND kelas_siswa.th_ajar = nl.th_ajar ';
      $sql .= 'AND kelas_siswa.kelas = nl.kelas ';
      $sql .= 'AND kelas_siswa.nis = nl.nis ';
      $sql .= "AND nl.p_nl = $p_nl ";
      $sql .= "AND nl.sub_pnl = '$sub_pnl' ";
      $sql .= "WHERE kelas_siswa.kelas = '$kelas' ";
      $sql .= "AND kelas_siswa.kd_sekolah = '$kd_sekolah' ";
      $sql .= "AND kelas_siswa.th_ajar = '$th_ajar' ";
      $sql .= "AND kelas_siswa.nis = '".$nis."' ";
      //echo $sql; die();
      $h = $this->db->query($sql)->result();
      return $h;
    }
    function getByComment($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];

        $sql       = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql        .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }
    function getByCommentKepribadian($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];

        $sql       = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_kepribadian nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql        .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }
    function getByCommentCatatanUmum($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];

        $sql       = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_catatan_umum nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql        .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }

    function getByCommentInput($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql       = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql       .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " and nl.nis           = '$nis' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }

    function getByCommentInputKepribadian($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql       = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_kepribadian nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql       .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " and nl.nis           = '$nis' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }
    function getByCommentInputCatatanPengetahuan($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $kd_mp            = $data['kd_mp'];

        $sql       = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_pengetahuan nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql       .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";
        $sql       .= " and nl.kd_mp          = '$kd_mp' ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " and nl.nis           = '$nis' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }

    function getByCommentInputCatatanKeterampilan($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $kd_mp            = $data['kd_mp'];

        $sql       = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_keterampilan  nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql       .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";
        $sql       .= " and nl.kd_mp          = '$kd_mp' ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " and nl.nis           = '$nis' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }

    function getByCommentInputCatatanSikap($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $kd_mp            = $data['kd_mp'];

        $sql       = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_sikap nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql       .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";
        $sql       .= " and nl.kd_mp          = '$kd_mp' ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " and nl.nis           = '$nis' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }

    function getByCommentInputCatatanAntarMapel($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql       = " select ks.*, ms.nama_lengkap, comment, comment_spiritual, predikat_sosial, predikat_spiritual ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_antar_mapel nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql       .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " and nl.nis           = '$nis' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil     = $this->db->query($sql);
        return $hasil;
    }

    function add($data)
    {
        return $this->db->insert('nl_comment',$data);
    }
    function addTghSiswa($data)
    {
        return $this->db->insert('tgh_siswa',$data);
    }
    function addKepribadian($data)
    {
        return $this->db->insert('nl_comment_kepribadian',$data);
    }
    function addCatatanUmum($data)
    {
        return $this->db->insert('nl_comment_catatan_umum',$data);
    }
    function addCatatanPengetahuan($data)
    {
        return $this->db->insert('nl_comment_pengetahuan',$data);
    }
    function addCatatanSikap($data)
    {
        return $this->db->insert('nl_comment_sikap',$data);
    }
    function addCatatanKeterampilan($data)
    {
        return $this->db->insert('nl_comment_keterampilan',$data);
    }
    function addCatatanAntarMapel($data)
    {
        return $this->db->insert('nl_comment_antar_mapel',$data);
    }
    function ubah($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('kelas',$data['kelas']);

        $this->db->set('comment',$data['comment']);
        return $this->db->update('nl_comment');
    }
    function ubahTghSiswa($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('kd_tagihan',$data['kd_tagihan']);
        $this->db->where('kd_kd',$data['kd_kd']);

        $this->db->set('kgn',$data['kgn']);
        $this->db->set('psk',$data['psk']);
        $this->db->set('afk',$data['afk']);
        return $this->db->update('tgh_siswa');
    }
    function ubahKepribadian($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('kelas',$data['kelas']);

        $this->db->set('comment',$data['comment']);
        return $this->db->update('nl_comment_kepribadian');
    }
    function ubahCatatanUmum($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('kelas',$data['kelas']);

        $this->db->set('comment',$data['comment']);
        return $this->db->update('nl_comment_catatan_umum');
    }
    function ubahCatatanPengetahuan($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('kd_mp',$data['kd_mp']);
        $this->db->set('comment',$data['comment']);
        return $this->db->update('nl_comment_pengetahuan');

    }
    function ubahCatatanKeterampilan($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('kd_mp',$data['kd_mp']);

        $this->db->set('comment',$data['comment']);
        return $this->db->update('nl_comment_keterampilan');
    }
    function ubahCatatanSikap($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('kd_mp',$data['kd_mp']);

        $this->db->set('comment',$data['comment']);
        return $this->db->update('nl_comment_catatan_sikap');
    }

    function ubahCatatanAntarMapel($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('kelas',$data['kelas']);

        $this->db->set('comment',$data['comment']);
		$this->db->set('predikat_sosial',$data['predikat_sosial']);
		$this->db->set('comment_spiritual',$data['comment_spiritual']);
		$this->db->set('predikat_spiritual',$data['predikat_spiritual']);
        return $this->db->update('nl_comment_antar_mapel');
    }

    function Get_Tampil_Nilai($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $kd_mp          = $data['kd_mp'];
        $kd_tagihan     = $data['kd_tagihan'];
        $nis            = $data['nis'];
        $sql        = " select * from tgh_siswa
                        where kd_sekolah ='$kd_sekolah'
                        and th_ajar      ='$th_ajar'
                        and p_nl         = $p_nl
                        and sub_pnl      ='$sub_pnl'
                        and kd_mp        ='$kd_mp'
                        and kd_tagihan   ='$kd_tagihan'
                        and nis          ='$nis'
                        and kelas        ='$kelas'";
        $query      = $this->db->query($sql);
        return $query;
    }
    function simpann1($data)
    {
        return $this->db->insert('tgh_siswa',$data);
    }
    function updaten1($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('kd_mp',$data['kd_mp']);
        $this->db->where('kd_tagihan',$data['kd_tagihan']);

        $this->db->set('afk',$data['afk']);
        return $this->db->update('tgh_siswa');
    }
    function simpanexel($data)
    {
        return $this->db->insert('tgh_siswa',$data);
    }
    function updateexel($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('kd_mp',$data['kd_mp']);
        $this->db->where('kd_tagihan',$data['kd_tagihan']);

        $this->db->set('kgn',$data['kgn']);
        $this->db->set('psk',$data['psk']);
        return $this->db->update('tgh_siswa');
    }
    function periksa_Nilai($datahdr)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = trim($datahdr['kelas']);
        $kd_mp          = trim($datahdr['kd_mp']);
        $kd_tagihan     = trim($datahdr['kd_tagihan']);
        $nis            = trim($datahdr['nis']);
        $sql            = "select * from tgh_siswa
                        where kd_sekolah ='$kd_sekolah'
                        and th_ajar      ='$th_ajar'
                        and p_nl         = $p_nl
                        and sub_pnl      ='$sub_pnl'
                        and kd_mp        ='$kd_mp'
                        and kd_tagihan   ='$kd_tagihan'
                        and nis          ='$nis'
                        and kelas        ='$kelas'";
        $query          = $this->db->query($sql);
        return $query;
    }
    function periksa_Nilai_Siswa_perKD($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $data['kd_sekolah'];
        $th_ajar        = $data['th_ajar'];
        $p_nl           = $data['p_nl'];
        $sub_pnl        = $data['sub_pnl'];
        $kelas          = $data['kelas'];
        $kd_mp          = $data['kd_mp'];
        $kd_tagihan     = $data['kd_tagihan'];
        $kd_kd          = $data['kd_kd'];
        $nis            = $data['nis'];
        $sql        = " select * from tgh_siswa
                        where kd_sekolah ='$kd_sekolah'
                        and th_ajar      ='$th_ajar'
                        and p_nl         = $p_nl
                        and sub_pnl      ='$sub_pnl'
                        and kd_mp        ='$kd_mp'
                        and kd_tagihan   ='$kd_tagihan'
                        and kd_kd        ='$kd_kd'
                        and nis          ='$nis'
                        and kelas        ='$kelas'";
        $query      = $this->db->query($sql);
        return $query;
    }
    function simpanexelsemua($data)
    {
        return $this->db->insert('tgh_siswa',$data);
    }
    function updateexelsemua($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('sub_pnl',$data['sub_pnl']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('kd_mp',$data['kd_mp']);
        $this->db->where('kd_tagihan',$data['kd_tagihan']);

        $this->db->set('kgn',$data['kgn']);
        $this->db->set('psk',$data['psk']);
        return $this->db->update('tgh_siswa');
    }
    function periksa_Nilaisemua($datahdr)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = trim($datahdr['kelas']);
        $kd_mp          = trim($datahdr['kd_mp']);
        $kd_tagihan     = trim($datahdr['kd_tagihan']);
        $nis            = trim($datahdr['nis']);
        $sql            = "select * from tgh_siswa
                        where kd_sekolah ='$kd_sekolah'
                        and th_ajar      ='$th_ajar'
                        and p_nl         = $p_nl
                        and sub_pnl      ='$sub_pnl'
                        and kd_mp        ='$kd_mp'
                        and kd_tagihan   ='$kd_tagihan'
                        and nis          ='$nis'
                        and kelas        ='$kelas'";
        $query          = $this->db->query($sql);
        return $query;
    }

    function getSiswaDeskripsiPengetahuan($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $kd_mp          = $data['kd_mp'];
        $nis            = $data['nis'];

        $sql        = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " inner join nl_comment_pengetahuan nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql        .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";
        $sql       .= " and nl.kd_mp          = '$kd_mp' ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " and ks.nis = '$nis' ";
        $hasil     = $this->db->query($sql)->result();
        return $hasil;
    }
    //Edited Project Al Madinah 2014-08
    function getDeskripsiPengetahuan($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $kd_mp          = $data['kd_mp'];

        $sql       = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_pengetahuan nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql        .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";
        $sql       .= " and nl.kd_mp          = '$kd_mp' ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }
    function getDeskripsiKeterampilanSiswa($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $kd_mp          = $data['kd_mp'];
        $nis            = $data['nis'];

        $sql       = " SELECT * FROM nl_comment_keterampilan ";
        $sql       .= " WHERE kd_sekolah = '$kd_sekolah' ";
        $sql       .= " AND th_ajar = '$th_ajar' ";
        $sql       .= " AND p_nl = '$p_nl' ";
        $sql       .= " AND nis = '$nis' ";
//        $sql       .= " AND kd_mp = '$kd_mp' ";
        $sql       .= " AND sub_pnl = '$sub_pnl' ";
        $sql       .= " AND kelas = '$kelas' ";
        $hasil     = $this->db->query($sql)->result();
        return $kd_mp;
    }
    function getDeskripsiKeterampilan($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $kd_mp          = $data['kd_mp'];

        $sql       = " select ks.*, ms.nama_lengkap, comment ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_keterampilan nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql        .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";
        $sql       .= " and nl.kd_mp          = '$kd_mp' ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }
    function getDeskripsiSikapSosial($data)
    {
      $CI             = &get_instance();
      $kd_sekolah     = $CI->session->userdata('kd_sekolah');
      $th_ajar        = $CI->session->userdata('th_ajar');
      $p_nl           = $CI->session->userdata('kd_semester');
      $sub_pnl        = $CI->session->userdata('sub_pnl');
      $kelas          = $data['kelas'];
      $nis            = $data['nis'];

      $sql       = " select comment, comment_spiritual, predikat_sosial, predikat_spiritual ";
      $sql       .= " from kelas_siswa ks ";

      $sql       .= " inner join ms_siswa ms ";
      $sql       .= " on ks.nis = ms.nis ";
      $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

      $sql       .= " left outer join nl_comment_antar_mapel nl ";
      $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
      $sql       .= " and ks.th_ajar = nl.th_ajar ";
      $sql       .= " and ks.kelas = nl.kelas ";
      $sql       .= " and ks.nis = nl.nis ";
      $sql        .= " and nl.sub_pnl      = '$sub_pnl' ";
      $sql       .= " and nl.p_nl          = '$p_nl' ";

      $sql       .= " where ks.kelas       = '$kelas' ";
      $sql       .= " and ks.kd_sekolah  = '$kd_sekolah' ";
      $sql       .= " and ks.th_ajar       = '$th_ajar' ";
      $sql       .= " and ks.nis          = '$nis' ";
      $sql       .= " ORDER BY nama_lengkap ";
      $hasil     = $this->db->query($sql)->result();
      return $hasil;
    }
    function getDeskripsiSikapPerMapelK13($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $kd_mp          = $data['kd_mp'];
        $nis            = $data['nis'];

        $sql       = " select ks.*, ms.nama_lengkap, comment, comment_spiritual ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_sikap nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql        .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";
        $sql       .= " and nl.kd_mp          = '$kd_mp' ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " and ks.nis       = '$nis' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql)->result();
        return $hasil;
    }
    function getDeskripsiSikap($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $kd_mp          = $data['kd_mp'];

        $sql       = " select ks.*, ms.nama_lengkap, comment, comment_spiritual ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_sikap nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql        .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";
        $sql       .= " and nl.kd_mp          = '$kd_mp' ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }
    function getDeskripsiAntarMapel($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];

        $sql       = " select ks.*, ms.nama_lengkap, comment,  predikat_sosial, comment_spiritual, predikat_spiritual ";
        $sql       .= " from kelas_siswa ks ";

        $sql       .= " inner join ms_siswa ms ";
        $sql       .= " on ks.nis = ms.nis ";
        $sql       .= " and ks.kd_sekolah = ms.kd_sekolah ";

        $sql       .= " left outer join nl_comment_antar_mapel nl ";
        $sql       .= " on ks.kd_sekolah= nl.kd_sekolah ";
        $sql       .= " and ks.th_ajar = nl.th_ajar ";
        $sql       .= " and ks.kelas = nl.kelas ";
        $sql       .= " and ks.nis = nl.nis ";
        $sql        .= " and nl.sub_pnl = '$sub_pnl' ";
        $sql       .= " and nl.p_nl          = $p_nl ";

        $sql       .= " where ks.kelas       = '$kelas' ";
        $sql       .= " and ks.kd_sekolah    = '$kd_sekolah' ";
        $sql       .= " and ks.th_ajar       = '$th_ajar' ";
        $sql       .= " ORDER BY nama_lengkap ";
        $hasil     = $this->db->query($sql);
        return $hasil;
    }

}
?>
