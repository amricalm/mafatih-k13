<?php 

class Pelanggaran_model extends CI_Model
{
    function __construct()
    {
        parent::__Construct();
    }
    function get($kd='')
    {
        $test = '';
        $sql                = " SELECT * FROM bp_mpelanggaran";
        $sql                .= " order by kd_pelanggaran";
        if($kd!='' && $kd!='0')
        {
            $sql                = " SELECT * FROM bp_mpelanggaran a";
            $sql                .= " LEFT OUTER JOIN bp_tpelanggaran b";
            $sql                .= " ON a.kd_tpelanggaran =  b.kd_tpelanggaran";
            $sql                .= " WHERE a.kd_tpelanggaran = '$kd'";
        
            $sql                .= " order by kd_pelanggaran";
        }
        $query = $this->db->query($sql);
        if ($query->result()) 
		{
            if($test=='')
            {
                return $query;
            }
            else
            {
                return $sql;
            }
        } 
		else 
		{
            return $query;
        }
    }
    function simpan($data)
    {
        if($this->db->insert('bp_mpelanggaran',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function update($kd,$data)
    {
        $this->db->where('kd_pelanggaran',$kd);
        return $this->db->update('bp_mpelanggaran',$data);
    }
    function hapus($kd)
    {
        $this->db->where('kd_pelanggaran',$kd);
        return $this->db->delete('bp_mpelanggaran');
    }
    function get_tpelanggaran($kd='')
    {
        $sql                    = " SELECT * FROM bp_tpelanggaran";
        if($kd!='' && $kd!='0')
        {
            $sql                .= " WHERE kd_tpelanggaran ='$kd' ";
        }
        $sql                    .= " order by nm_tpelanggaran";
        $hasil= $this->db->query($sql);
        return $hasil;
    }  
    function get_mpelanggaran($kd='')
    {
        $sql                    = " SELECT * FROM bp_mpelanggaran";
        if($kd!='' && $kd!='0')
        {
            $sql                .= " WHERE kd_pelanggaran ='$kd' ";
        }
        $hasil= $this->db->query($sql);
        return $hasil;
    }
    function get_kdtpelanggaran($kd='')
    {
        $sql                    = " select * from bp_tpelanggaran bpt
                                    inner join bp_mpelanggaran bpm
                                    on bpt.kd_tpelanggaran = bpm.kd_tpelanggaran
                                    where kd_pelanggaran = $kd";
        $hasil= $this->db->query($sql);
        return $hasil;
    }

    function simpantpelanggaran($data)
    {
        if($this->db->insert('bp_tpelanggaran',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function updatetpelanggaran($kd,$data)
    {
        $this->db->where('kd_tpelanggaran',$kd);
        return $this->db->update('bp_tpelanggaran',$data);
    }
    function hapustpelanggaran($kd)
    {
        $this->db->where('kd_tpelanggaran',$kd);
        return $this->db->delete('bp_tpelanggaran');
    }
    function gettgl($kd)
    {
        $sql        = " select year(tgl) th,month(tgl) bln,day(tgl) hr 
                        from bp_tpelanggaran_siswa ";
        $sql        .= " where kd_pelanggaran_siswa = '$kd'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    
}

?>