$(document).ready(function()
{
   $( "#proses" ).dialog({
		autoOpen: false,
                resizable : false,
                modal:true,
		height: 150,
		width: 200
        }); 
});

function add(myurl)
{
    document.getElementById('tombol_add').href = myurl;
    return true;
}
function excel(myurl)
{
    var cari = document.getElementById('txtcari').value; 
    var kelas = document.getElementById('kelas').value;
    document.getElementById('tombol_excel').href = myurl+kelas+"/"+cari;
    return true;
}
function edit(myurl)
{
    //return false;
    var chks = document.getElementsByName('kode[]');
    var hasChecked = '';
    var j = 0;
    var iddituju = new Array();
    iddituju[j] = '';
    for(var x = 1;x <= chks.length; x++)
    {
        if(chks[x-1].checked)
        {
            iddituju[j] = String(chks[x-1].id);
            j++;
        }
    }
    if(iddituju[0]!='')
    {
        document.getElementById('tombol_edit').href = myurl+"/"+iddituju[0];
        return true;
    }
    else
    {
        alert('Minimal satu record terseleksi!');
        return false;
    }
}
function del(myurl)
{
    var chks = document.getElementsByName('kode[]');
    var hasChecked = '';
    var j = 0;
    var iddituju = new Array();
    for(var x = 1;x <= chks.length; x++)
    {
        if(chks[x-1].checked)
        {
            iddituju[j] = String(chks[x-1].id);
            j++;
        }
    }
    if(iddituju.length!=0)
    {    
        var test = confirm("Yakin akan dihapus ? ");
        if(test)
        {
            document.getElementById('tombol_del').href = myurl+"/"+iddituju[0];
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        alert('Minimal satu record terseleksi!');
        return false;
    }
}
function print(myurl)
{
    var tgldari = $('#tgldari').val();
    var tglsampai = $('#tglsampai').val();
    window.open(myurl+tgldari+'/'+tglsampai, 'Print','width=900,height=400,resizable,scrollbars=1,status=0,toolbar=0');

}
function ledger(myurl)
{
    var kelas = urlencode($('#skelas').val());
    var nis = $('#nis').val();
    window.open(myurl+kelas+'/'+nis, 'Ledger','width=900,height=650,resizable,scrollbars=1,status=0,toolbar=0');
}
function ledgeruts(myurl)
{
    var kelas = urlencode($('#skelas').val());
    var mp    = $('#mp').val();
    window.open(myurl+kelas+'/'+mp, 'Ledger','width=900,height=650,resizable,scrollbars=1,status=0,toolbar=0');
}
function ledger_depan(myurl)
{
    var nis = $('#nis').val();
    window.open(myurl+nis, 'Ledger','width=900,height=650,resizable,scrollbars=1,status=0,toolbar=0');
}

function profile(myurl)
{
    window.open(myurl, 'Profile Siswa','width=900,height=650,resizable,scrollbars=1,status=0,toolbar=0');
}
function addRow() 
{
    var tbl        = $('#tblDetail');
    var lastRow    = tbl.find("tr").length;
    var urllink    = $('input[name=urllink]').val();
    var emptyrows  = 0;
    for (i=1; i<lastRow; i++) 
    {
    	if ($("#durasi_teori"+i).val() == '' && $("#durasi_praktek"+i).val() == '') 
        {
            emptyrows += 1;
    	}
    }
    if (emptyrows == 0) 
    {
        var kelas   = '';
        var hehe    = lastRow % 2;
        if(hehe == 0)
        {
            kelas = ' class = "bg" ';
        }
        var imgdokumen      = '<img src="'+urllink+'imageapp/dokumen.png" style="cursor: pointer" onclick="nampil_barang('+lastRow+')" />';
        var txtbarangkdnmpl = '<input type="text" class="input-text required" style="width: 90%;" name="barang_kd_nampil'+lastRow+'" id="barang_kd_nampil'+lastRow+'" disabled="disabled" />';
        var txtbarangkd     = '<input type="hidden" name="barang_kd[]" id="barang_kd'+lastRow+'" value=""/>';
        var txtbarangnmnmpl = '<input type="text" class="input-text required" style="width: 100%;" name="barang_nm_nampil'+lastRow+'" id="barang_nm_nampil'+lastRow+'" disabled="disabled" />';
        var txtbarangnm     = '<input type="hidden" name="barang_nm'+lastRow+'" id="barang_nm'+lastRow+'" value=""/>';
        var txtqty          = '<input type="text" class="input-text required" style="width: 100%;" name="qty'+lastRow+'" id="qty'+lastRow+'" />';
        var txtstok         = '<input type="text" class="input-text required" style="width: 100%;" name="stok'+lastRow+'" id="stok'+lastRow+'" />'; 
        var txtqtyapp       = '<input type="text" class="input-text required" style="width: 100%;" name="qty_app'+lastRow+'" id="qty_app'+lastRow+'"  />';
        var imgdokumenpo    = '<img src="'+urllink+'imageapp/dokumen1.png" style="cursor: pointer" onclick="nampil_po('+lastRow+')" />';
        var txtponampil     = '<input type="text" class="input-text required" style="width: 90%;" name="po_nampil'+lastRow+'" id="po_nampil'+lastRow+'"  />';
        var txtpo           = '<input type="hidden" name="po1" id="po1" value="" />';
        var gambarhapus     = '<img class="delete" src="'+urllink+'imageapp/no2.png" width="25" style="margin:0;padding:0;cursor:pointer" onclick="$(this).parent().parent().remove();" />';
        tbl.children().append('<tr'+kelas+'><td>'+lastRow+'</td><td>'+imgdokumen+txtbarangkdnmpl+txtbarangkd+'</td><td>'+txtbarangnmnmpl+txtbarangnm+'</td><td>'+txtqty+'</td><td>'+txtstok+'</td><td>'+txtqtyapp+'</td><td>'+imgdokumenpo+txtponampil+txtpo+'</td><td style="vertical-align: top">'+gambarhapus+'</td></tr>');
    }
    else
    {
        alert('Isi terlebih dulu inputan yang ada!');
    }
}
function delRow()
{
    /*$('#tblDetail td img.delete').click(function(){*/
        $(this).parent().parent().remove();
    /*});*/
}
function urlencode (str) {
    str = (str + '').toString();
    strencode = encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
    return strencode;
}
function masukkelas()
{
    var myurl       = $('#myurl').val();
    var kelas       = $('#kelas').val();
    var chks        = document.getElementsByName('kodesiswabelum[]');
    $('#gambarloading').attr('src',myurl+'edusis_asset/edusisimg/ajax-loader.gif');
    var nismasuk    = new Array();
    var j = 0;
    for(var x = 1;x <= parseInt(chks.length); x++)
    {
        if(chks[x-1].checked)
        {
            nismasuk[j] = String(chks[x-1].id);
            j++;
        }
    }
    if(kelas!='')
    {
        $.ajax({
            type: "POST",
            url: myurl+'index.php/kelas/rombongan_belajar_exec',
            data: "tipe=masukkelas&kelas="+kelas+"&nis="+nismasuk,
            success: function(msg) 
            {
                window.location=myurl+'index.php/kelas/rombongan_belajar/'+urlencode(kelas);
            }
        });
    }
    else
    {
        alert('Pilih kelas terlebih dahulu!');
    }
}
function keluarkelas()
{
    var myurl       = $('#myurl').val();
    var kelas       = $('#kelas').val();
    var chks        = document.getElementsByName('kodesiswakelas[]');
    $('#gambarloading').attr('src',myurl+'edusis_asset/edusisimg/ajax-loader.gif');
    var nismasuk    = new Array();
    var j = 0;
    for(var x = 1;x <= parseInt(chks.length); x++)
    {
        if(chks[x-1].checked)
        {
            nismasuk[j] = String(chks[x-1].id);
            j++;
        }
    }
    if(kelas!='')
    {
        $.ajax({
            type: "POST",
            url: myurl+'index.php/kelas/rombongan_belajar_exec',
            data: "tipe=keluarkelas&kelas="+kelas+"&nis="+nismasuk,
            success: function(msg) 
            {
                window.location=myurl+'index.php/kelas/rombongan_belajar/'+urlencode(kelas);
            }
        });
    }
    else
    {
        alert('Pilih kelas terlebih dahulu!');
    }
}
function checkedsiswakelas()
{
    var myurl       = $('#myurl').val();
    var kelas       = $('#kelas').val();
    var name        = $('#checkedmasukkelas').text();
    var chks        = document.getElementsByName('kodesiswakelas[]');
    var nismasuk    = new Array();
    var chksval     = '';
    var j = 0;
    for(var x = 1;x <= parseInt(chks.length); x++)
    {
        if(name=='Pilih Semua >> ')
        {
            chksval     = chks[x-1].value;
            chks[x-1].checked = true;
            $('#checkedmasukkelas').text('Tidak Pilih >> ');
        }
        else
        {
            chksval     = chks[x-1].value;
            chks[x-1].checked = false;
            $('#checkedmasukkelas').text('Pilih Semua >> ');
        }
    }
}
function checkedsiswabelum()
{
    var myurl       = $('#myurl').val();
    var kelas       = $('#kelas').val();
    var name        = $('#checkedkeluarkelas').text();
    var chks        = document.getElementsByName('kodesiswabelum[]');
    var nismasuk    = new Array();
    var chksval     = '';
    var j = 0;
    for(var x = 1;x <= parseInt(chks.length); x++)
    {
        if(name==' << Pilih Semua')
        {
            chksval     = chks[x-1].value;
            chks[x-1].checked = true;
            $('#checkedkeluarkelas').text(' << Tidak Pilih');
        }
        else
        {
            chksval     = chks[x-1].value;
            chks[x-1].checked = false;
            $('#checkedkeluarkelas').text(' << Pilih Semua');
        }
    }
}
function checkedotorisasi()
{
    var myurl       = $('#myurl').val();
    var kelas       = $('#kelas').val();
    var name        = $('#checkedmasukotorisasi').text();
    var chks        = document.getElementsByName('kodeotorisasi[]');
    var kd_mpmasuk  = new Array();
    var chksval     = '';
    var j = 0;
    for(var x = 1;x <= parseInt(chks.length); x++)
    {
        if(name=='Pilih Semua >> ')
        {
            chksval     = chks[x-1].value;
            chks[x-1].checked = true;
            $('#checkedmasukotorisasi').text('Tidak Pilih >> ');
        }
        else
        {
            chksval     = chks[x-1].value;
            chks[x-1].checked = false;
            $('#checkedmasukotorisasi').text('Pilih Semua >> ');
        }
    }
}
function checkedbelumotorisasi()
{
    var myurl       = $('#myurl').val();
    var kelas       = $('#kelas').val();
    var name        = $('#checkedkeluarotorisasi').text();
    var chks        = document.getElementsByName('kodebelumotorisasi[]');
    var kd_mpmasuk  = new Array();
    var chksval     = '';
    var j = 0;
    for(var x = 1;x <= parseInt(chks.length); x++)
    {
        if(name==' << Pilih Semua')
        {
            chksval     = chks[x-1].value;
            chks[x-1].checked = true;
            $('#checkedkeluarotorisasi').text(' << Tidak Pilih');
        }
        else
        {
            chksval     = chks[x-1].value;
            chks[x-1].checked = false;
            $('#checkedkeluarotorisasi').text(' << Pilih Semua');
        }
    }
}
function masukotorisasi()
{
    var myurl       = $('#myurl').val();
    var kd_group    = $('#kd_group').val();
    var kelas       = $('#kelas').val();
    var chks        = document.getElementsByName('kodebelumotorisasi[]');
    $('#gambarloading').attr('src',myurl+'edusis_asset/edusisimg/ajax-loader.gif');
    var kd_mpmasuk    = new Array();
    var j = 0;
    for(var x = 1;x <= parseInt(chks.length); x++)
    {
        if(chks[x-1].checked)
        {
            kd_mpmasuk[j] = String(chks[x-1].id);
            j++;
        }
    }
    if(kd_group!='' && kelas!='')
    {
        $.ajax({
            type: "POST",
            url: myurl+'index.php/sekuriti/otorisasi_exec',
            data: "tipe=masukotorisasi&kd_group="+kd_group+"&kelas="+kelas+"&kd_mp="+kd_mpmasuk,
            success: function(msg) 
            {
                //alert(msg);
                //alert(myurl+'index.php/sekuriti/otorisasi/'+kd_group+'/'+urlencode(kelas));
                window.location=myurl+'index.php/sekuriti/otorisasi/'+kd_group+'/'+urlencode(kelas);
            }
        });
    }
    else
    {
        alert('Pilih group dan kelas terlebih dahulu!');
    }
}
function keluarotorisasi()
{
    var myurl       = $('#myurl').val();
    var kd_group    = $('#kd_group').val();
    var kelas       = $('#kelas').val();
    var chks        = document.getElementsByName('kodeotorisasi[]');
    $('#gambarloading').attr('src',myurl+'edusis_asset/edusisimg/ajax-loader.gif');
    var kd_mpmasuk    = new Array();
    var j = 0;
    for(var x = 1;x <= parseInt(chks.length); x++)
    {
        if(chks[x-1].checked)
        {
            kd_mpmasuk[j] = String(chks[x-1].id);
            j++;
        }
    }
    if(kd_group!='' && kelas!='')
    {
        $.ajax({
            type: "POST",
            url: myurl+'index.php/sekuriti/otorisasi_exec',
            data: "tipe=keluarotorisasi&kd_group="+kd_group+"&kelas="+kelas+"&kd_mp="+kd_mpmasuk,
            success: function(msg) 
            {
                //alert(msg);
                //alert(myurl+'index.php/sekuriti/otorisasi/'+kd_group+'/'+urlencode(kelas));
                window.location=myurl+'index.php/sekuriti/otorisasi/'+kd_group+'/'+urlencode(kelas);
            }
        });
    }
    else
    {
        alert('Pilih group dan kelas terlebih dahulu!');
    }
}

function adn_cnum(str)
{
    if (str=='' || str == undefined )
    {
        return 0;
    }
    else
    {
        var hasil = str.replace(/\./g,'');
        var angka = parseFloat(hasil);
        return angka;
    }
}
