<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
<div id="content" class="box">
<h1>INPUT NILAI</h1>
<form id="filter" action="" method="post">
<table width="100%">
<tr>
    <td width="15%">Kelas</td>
    <td width="">
    <?php
        $arraykelas = array('');
        foreach($df_kelas->result () as $rowkelas )
        {
            $arraykelas[$rowkelas->kelas]=$rowkelas->kelas;
        }
        echo form_dropdown('kelas',$arraykelas,$kelas,' id="kelas" required="required"');
    ?>
    </td>                      
</tr>
<tr>
    <td>Muatan Pelajaran</td>
    <td>
    <?php
        $arraymp = array('');
        foreach($kdmp->result () as $rowmp )
        {
            $arraymp[$rowmp->kd_mp]=$rowmp->nm_mp;
        }
        echo form_dropdown('kd_mp',$arraymp,$kd_mp,' id="mp" required="required"');
    ?>
    </td>
</tr>
<tr>
    <td>Jenis Penilaian</td>
    <td>
    <?php
        $arrayjn = array('');
        foreach($kdjenis_nilai->result () as $rowjn)
        {
            $arrayjn[$rowjn->kd_jenis_nilai]= "[".strtoupper($rowjn->ket)."] ".$rowjn->jenis_nilai;
        }
        echo form_dropdown('kd_jenis_nilai',$arrayjn,$kd_tagihan,' id="jn" ');
    ?>
    </td>
</tr>     
<tr>
    <td>Kompetensi Dasar</td>
    <td>
    <span id="kolom-kd">
    <?php
        if ($kd_tagihan == 'PAS') {
            echo "<select name='filter-ki' class='form-control' id='filter-ki'>";
            $arrKi  = array(''=>'','ki3'=>'KI 3','ki4'=>'KI 4');
              foreach($arrKi as $keyKi=>$valueKi)
              {
                $selected      = (trim($kd_ki_filter)==$keyKi) ? ' selected="selected" ' : '';
                echo '<option value="'.trim($keyKi).'"'.$selected.'>'.$valueKi.'</option>';
              }
            echo "</select>";
            if ($kd_ki_filter == 'ki3') {
                $arrKdKi3 = array();
                if($lstKdKi3->num_rows()>0)
                {
                    $arrKdKi3['']='-- Pilih Kompetensi Dasar --';
                    foreach($lstKdKi3->result() as $row)
                    {
                        $arrKdKi3[$row->kd_kd]="[".strtoupper($row->kd_ki)."] [".$row->kd_kd."] ".$row->ket_kd;
                    }
                }
                else
                {
                    $arrKdKi3 = array(''  => '');
                }
                echo "<span name='row_ki3' id='row_ki3'>".form_dropdown('filter-kdKi3',$arrKdKi3,$kd_kdKi3,'id="filter-kd"')."</span>";
            } elseif ($kd_ki_filter == 'ki4') {
                $arrKdKi4 = array();
                if($lstKdKi4->num_rows()>0)
                {
                    $arrKdKi4['']='-- Pilih Kompetensi Dasar --';
                    foreach($lstKdKi4->result() as $row)
                    {
                        $arrKdKi4[$row->kd_kd]="[".strtoupper($row->kd_ki)."] [".$row->kd_kd."] ".$row->ket_kd;
                    }
                }
                else
                {
                    $arrKdKi4 = array(''  => '');
                }
                echo "<span name='row_ki4' id='row_ki4'>".form_dropdown('filter-kdKi4',$arrKdKi4,$kd_kdKi4,'id="filter-kd"')."</span>";
            }
            
            echo "<script type=\"text/javascript\">";
            if ($kd_ki_filter == 'ki3') {
                echo "$('#row_ki3').show();";
                echo "$('#row_ki4').hide();";
            }elseif ($kd_ki_filter == 'ki4') {
                echo "$('#row_ki3').hide();";
                echo "$('#row_ki4').show();";
            } else {
                echo "$('#row_ki3').hide();";
                echo "$('#row_ki4').hide();";
            }
            echo "</script>";
            echo "<script type=\"text/javascript\">
                $(function() {
                  $('#filter-ki').click(function(){
                      if($('#filter-ki').val() == 'ki3') {
                          $('#row_ki3').show();
                          $('#row_ki4').hide();
                      } else if($('#filter-ki').val() == 'ki4') {
                        $('#row_ki3').hide();
                        $('#row_ki4').show();
                      } else {
                        $('#row_ki3').show();
                        $('#row_ki4').show();
                      }
                  });
                });
            </script>";    
        } else {
            if($lstKd->num_rows()>0)
            {
                $arrKd['']='-- Pilih Kompetensi Dasar --';
                foreach($lstKd->result() as $row)
                {
                    $arrKd[$row->kd_kd]="[".strtoupper($row->kd_ki)."] [".$row->kd_kd."] ".$row->ket_kd;
                }
            }
            else
            {
                $arrKd = array(
                    ''  => ''
            );
            }
            echo form_dropdown('filter-kd',$arrKd,$kd_kd,'id="filter-kd" required="required"');
        }
        
    ?></span>
        <input type="submit" name="submit" id="submit" value="Filter" class="input button blue"/>
    </td>
</tr>
</table>
</form>

<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
<form action="<?php echo base_url().'index.php/task/simpan'?>" method="post">
<input type="hidden" name="kelas" id="kelas" value="<?php echo $kelas; ?>"/>
<input type="hidden" name="kd_mp" id="kd_mp" value="<?php echo $kd_mp; ?>"/>
<input type="hidden" name="kd_jenis_nilai" id="kd_jenis_nilai" value="<?php echo $kd_tagihan; ?>"/>
<input type="hidden" name="filter-ki" id="filter-ki" value="<?php echo $kd_ki; ?>"/>
<table class="tables" id="AdnTable" style="width:100%;">
<tr>
    <th style="width:3%;" >#</th>
    <th width="8%">NIS</th>
    <th width="55%">Nama Siswa</th>
    
<?php 
        if ($kd_tagihan == 'NH1' || $kd_tagihan == 'NH2' || $kd_tagihan == 'NH3' || $kd_tagihan == 'NH4' || $kd_tagihan == 'NH5' || $kd_tagihan == 'NH6') {
            echo '<th width="22%">Nilai Pengetahuan</th>';   
        } elseif ($kd_tagihan == 'PAS') {
                echo '<th width="22%">Nilai Pengetahuan</th>';  
                echo '<th width="22%">Nilai Keterampilan</th>';       
        } elseif ($kd_tagihan == 'KIN1' || $kd_tagihan == 'KIN2' || $kd_tagihan == 'PRJ1' || $kd_tagihan == 'PRJ2' || $kd_tagihan == 'POR1' || $kd_tagihan == 'POR2'){
            echo '<th width="22%">Nilai Keterampilan</th>';
        } elseif ($kd_tagihan == 'SPR' || $kd_tagihan == 'SOS') {
            echo '<th width="22%">Nilai (Isikan dengan nilai 0,1 atau 4)</th>';
        } else {
            echo '<th width="22%">Nilai</th>';
        }
        

        $i = 1;
        if($this->input->post('submit'))
        {
            foreach($task->result() as $row )
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$i.'</td>';
                echo '<td data-kolom="nis" style="text-align:center;">'.$row->nis.'</td>';
                echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.$row->nama_lengkap.'</td>';
                echo '<input type="hidden" name="task[]" id="task[]" value="'.$row->nis.'"/>';
                if ($kd_tagihan == 'NH1' || $kd_tagihan == 'NH2' || $kd_tagihan == 'NH3' || $kd_tagihan == 'NH4' || $kd_tagihan == 'NH5' || $kd_tagihan == 'NH6') {
                    echo '<td align="center"><input type="text" data-kolom="nilai" name="nilai'.($i-1).'" id="nilai" value="'.$row->kgn.'" class="number" style="width: 60px; background: transparent; text-align:center; border:none;"/></td>';
                }elseif ($kd_tagihan == 'PAS') {
                    if ($kd_ki_filter == 'ki3') {
                        echo '<td align="center"><input type="text" data-kolom="nilai" name="nilai'.($i-1).'" id="nilai" value="'.$row->kgn.'" class="number" style="width: 60px; background: transparent; text-align:center; border:none;"/></td>';
                        echo '<td align="center"><input type="text" data-kolom="nilai-praktik" name="nilai-praktik'.($i-1).'" id="nilai-praktik" value="'.$row->psk.'" class="number" style="width: 60px; background: transparent; text-align:center; border:none;" disabled/></td>';
                    } else {
                        echo '<td align="center"><input type="text" data-kolom="nilai" name="nilai'.($i-1).'" id="nilai" value="'.$row->kgn.'" class="number" style="width: 60px; background: transparent; text-align:center; border:none;" disabled/></td>';
                        echo '<td align="center"><input type="text" data-kolom="nilai-praktik" name="nilai-praktik'.($i-1).'" id="nilai-praktik" value="'.$row->psk.'" class="number" style="width: 60px; background: transparent; text-align:center; border:none;"/></td>';
                    }
                } elseif ($kd_tagihan == 'KIN1' || $kd_tagihan == 'KIN2' || $kd_tagihan == 'PRJ1' || $kd_tagihan == 'PRJ2' || $kd_tagihan == 'POR1' || $kd_tagihan == 'POR2') {
                    echo '<td align="center"><input type="text" data-kolom="nilai-praktik" name="nilai-praktik'.($i-1).'" id="nilai-praktik" value="'.$row->psk.'" class="number" style="width: 60px; background: transparent; text-align:center; border:none;"/></td>';
                } else {
                    echo '<td align="center"><input type="text" max="4" data-kolom="nilai-sikap" name="nilai-sikap'.($i-1).'" id="nilai-sikap" value="'.$row->afk.'" class="number_afk" style="width: 60px; background: transparent; text-align:center; border:none;"/></td>';
                }
                $i++;
                echo '</tr>';
            }
        }  
    ?>
</table>
</div>
<?php if($this->input->post('submit')) { if($task->num_rows()>0) { ?>
<table style="width: 100%;">
    <tr>
        <td align="right" colspan="5" style="border-bottom: none; border-left: none; border-right: none;">
            <input type="button" id="btnSimpan" class="input-submit blue" value="Simpan" />
            <input type="reset" name="batal" id="batal" class="input-submit blue"value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/task/daftar'; ?>'"/>
        </td>
    </tr>
</table>
<?php }} ?>
</form>
</div>
</div>

    <!-- Dialog Proses -->
    <div id="proses" title="Sedang Proses, Mohon Tunggu!" style="text-align: center;vertical-align:center;">
        <br /><img src="<?php echo $base_img.'/ajax-loader.gif'; ?>" />
    </div> 
    
<!-- Footer -->
<?php $this->load->view('page_footer'); ?>

<script>
$(document).ready(function()
{
    console.log("Loading... Sukses");
    $('#btnSimpan').click(function(){
        simpan();
    });
    
    $('#mp').change(function(){
        setComboKd();
    });
    
    $('#kelas').change(function(){
        setComboKd();
    });

    $('#jn').change(function(){
        setComboKd();
    });
    
//    $('#filter').submit(function(e){
//        var aksi = $(this).attr('action');
//        var kelas = urlencode($('#kelas').val());
//        var kd_mp = urlencode($('#mp').val());
//        var jenis_penilaian = urlencode($('#jn').val());
//        var filter_kd = urlencode($('#filter-kd').val());
//        
//        aksi = aksi + "/" + kelas + "/" + kd_mp+ "/" + jenis_penilaian + "/" +filter_kd;
//
//        $(this).attr('action',aksi);
//        return true; 
//    });
    
});

function setComboKd()
{
    var kdMp   = $('#mp').val();
    var kelas  = $('#kelas').val();
    var jn     = $('#jn').val();
        
    var tujuan        = "<?php echo base_url() . 'index.php/task/ajSetComboKd/';?>"+jn+"/"+kdMp+"/"+kelas;
    $.ajax({
       type: "POST",
       async: false,
       url: tujuan,
       success: function (res){
            console.log(res);
           if (res!="") {
               $("#kolom-kd").html(res);
           }                       
       }
    });
}

//------------------- CRUD ----------------------------------------------------
function simpan()
{
    console.log('Eksekusi Simpan....');
    
    var AoA = new Array();
    var iUrutan = 0;
    var kd_mp = $('#mp').val();
    var kelas = $('#kelas').val();
    var kd_tagihan = $('#jn').val();
    var kdKi3 = $('#filter-kdKi3').val();
    // if (kd_tagihan = 'PAS') {
    //     if ($kd_ki_filter == 'ki3') {
    //         var kd_kd  = $('#filter-kd').val();
    //     } else if ($kd_ki_filter = 'ki4') {
    //         var kd_kd  = $('#filter-kd').val();
    //     }
    // } else {
        var kd_kd  = $('#filter-kd').val();
    // }
    
    
    $('#AdnTable tr').each(function(){

            var nis = $(this).find("[data-kolom='nis']");

            if ($(nis).val()!=undefined)
            {                
                var kgn = $(this).find("[data-kolom='nilai']").val();
                var psk = $(this).find("[data-kolom='nilai-praktik']").val();
                var afk = $(this).find("[data-kolom='nilai-sikap']").val();
                var o = new NilaiDtl(kd_mp, kelas,kd_tagihan, $(nis).html(),kgn,psk,afk);
                AoA.push(o);
                iUrutan++;
            }
    });

    if($(AoA).length <1)
    {
        alert('Nilai Tidak boleh kosong!');
        //$('#niai').focus();
    }
    else
    {
        $("#proses").dialog("open");
        var data = {
            kd_mp       : $('#mp').val(),
            kelas       : $('#kelas').val(),
            kd_tagihan  : $('#jn').val(),
            kd_ki       : $('#filter-ki').val(),
            kd_kd       : $('#filter-kd').val(),
            rows        : AoA
        };

        var json = JSON.stringify(data); 
        console.log(json);
//         $.post(
//             '<?php echo base_url(); ?>index.php/task/simpan_batch_from_ajax',
//             {data:json},
//             function(data) 
//             {
//                 var obj = jQuery.parseJSON(data);
//                 console.log(obj);
//                 // if (obj.IsSuccess) 
//                 // {
//                     //location.reload();
// //                    console.log($("#AdnTable [data-kolom='nilai']"));
// //                    $("#AdnTable [data-kolom='nilai']").each(function(){
// //                        $(this).val("0");    
// //                    });
                    
//                 // }
//                 alert("Update Data: " );
//                 $("#proses").dialog("close");
//             }
//         );


        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/task/simpan_batch_from_ajax',
            dataType: "json",
            contentType:'application/json',
            data: json,
            success: function(data){
                alert("Update Data: Berhasil");
                $("#proses").dialog("close");
                window.location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Update Data: " + data);
            }
        });
        
        console.log('Akhir Eksekusi Simpan....');
        return false; 
    }
}
    
// END CRUD ===============================================================  

function NilaiDtl(kd_mp, kelas, kd_tagihan, nis, kgn, psk, afk) 
{
    this.kd_mp = kd_mp;
    this.kelas = kelas;
    this.kd_tagihan = kd_tagihan;
    this.nis = nis;
    this.kgn= adn_cnum(kgn);
    this.psk =adn_cnum(psk);
    this.afk = adn_cnum(afk);  
}
</script>

</body>
</html>