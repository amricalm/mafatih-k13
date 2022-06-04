<?php
class Tabungan_model extends CI_Model
{
 var $global;
  function __construct()
  {
    parent::__construct();
  }
  function jns_tabungan()
  {
    $this->load->helper('form');
    $options = array(
      '1' => 'Tabungan',
      '2' => 'Umrah'
    );
    $dataTabungan = form_dropdown('jenis_tabungan', $options, 1);
    return $dataTabungan;
  }
  function cariSiswaModel($data)
  {
    $sql  = " SELECT * FROM ms_siswa ";
    if($data!='')
    {
      $sql    .= " WHERE nis = '$data'";
    }
    $hasil      = $this->db->query($sql);
    $result = $hasil->result_array();
    return $result;
  }
}

?>
