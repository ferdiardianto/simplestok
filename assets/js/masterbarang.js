//keterangan:
//.removeAttr('disabled');
//.attr('disabled','disabled');
var cabang = $('#cmbcabang').val();
var start='';
var base_url    = $('#base_url').val();
$(document).ready(function () {

    clearfield();


    $('#btnubah').attr('disabled','disabled');
    $('#btnhapus').attr('disabled','disabled');

    $("#jqGrid").jqGrid({
        colModel: [
            { label: 'Kode Barang', name: 'id', key: true, width: 100 },
            { label: 'Nama Barang', name: 'nama_barang', width: 430 },
            { label: 'Jumlah', name: 'quantity', width: 150 },
            { label: 'Berat (Gram)', name: 'berat', width: 150 },
            { label: 'Harga', name: 'harga', width: 300 },
            { label: 'Cabang', name: 'cabang', width: 1100, hidden:true },
            { label: 'Flag', name: 'flag', width: 1100, hidden:true }
        ],
		viewrecords: true,
        width: 'auto',
        height: 250,
        rowNum: 20,
        datatype: 'local',
        pager: "#jqGridPager",
        caption: "List Data Master Barang",
        onSelectRow: function(rowId){
            setfield(rowId);
            $('#btnubah').removeAttr('disabled');
            $('#btnhapus').removeAttr('disabled');

        }
    });

    // activate the toolbar searching
    $('#jqGrid').jqGrid('filterToolbar');
    $('#jqGrid').jqGrid('navGrid',"#jqGridPager", {                
        search: false, // show search button on the toolbar
        add: false,
        edit: false,
        del: false,
        refresh: true
    });

    // the bindKeys() 
    $("#jqGrid").jqGrid('bindKeys');

    fetchGridData(cabang);

});

 function fetchGridData(cabang) {
    var postvar  = {cabang:cabang}       
    var gridArrayData = [];
    // show loading message
    $("#jqGrid")[0].grid.beginReq();
    $.ajax({
        url: base_url+'masterbarang/getall',
        data: postvar,
        success: function (result) {
            if(result != null){
                gridArrayData=eval(result);
            }
            
            //clear grid
            $("#jqGrid").clearGridData(true);
            // set the new data
            $("#jqGrid").jqGrid('setGridParam', { data: gridArrayData});
            // hide the show message
            $("#jqGrid")[0].grid.endReq();
            // refresh the grid
            $("#jqGrid").trigger('reloadGrid');
        }
    });
}


function setfield(rowId){
    var rowData = jQuery("#jqGrid").getRowData(rowId); 

    var id = rowData['id'];
    var nama_barang = rowData['nama_barang'];
    var quantity = rowData['quantity'];
    var berat = rowData['berat'];
    var harga = rowData['harga'];
    var cabang = rowData['cabang'];
    var flag = rowData['flag'];

    clearfield();
    if(flag==2){
     
      $('input[name="optionsRadios"][value=2]').click();
      $('#fieldjumlah').hide();
      $('#fieldberat').show();

      $('#txtberat').val(berat);
      $('#txtberatkg').val(berat/1000);

    }else if (flag==1){

       $('input[name="optionsRadios"][value=1]').click();
       $('#fieldjumlah').show();
       $('#fieldberat').hide();
       $('#txtjumlah').val(quantity);
    }

    $('#txtkdbarang').val(id);
    $('#txtnamabarang').val(nama_barang);
    $('#txtharga').val(harga);
 
}

function tambah(){
    $('#modaldetailcabang').modal('show');

    //clear field
    clearfield();


    $("#jqGrid").jqGrid("resetSelection");
    $('#btnubah').attr('disabled','disabled');
    $('#btnhapus').attr('disabled','disabled');

    
    start='save';
}

function do_save(){
    var txtkdbarang = $('#txtkdbarang').val(); 
    var txtnamabarang = $('#txtnamabarang').val();
    var flag = $('input[name="optionsRadios"]:checked').val();
    var txtjumlah = $('#txtjumlah').val();
    var txtberat = $('#txtberat').val();
    var txtharga = $('#txtharga').val(); 
    var cmbcabang = $('#cmbcabang').val(); 

    if(txtkdbarang!=""){
        var postvars = {txtkdbarang:txtkdbarang,txtnamabarang:txtnamabarang,flag:flag,txtjumlah:txtjumlah,txtberat:txtberat,txtharga:txtharga,cmbcabang:cmbcabang};
        if(start=='save'){
            $.ajax({ 
                type: 'POST', 
                url: base_url+'masterbarang/save', 
                data: postvars,  
                statusCode: {
                  200: function (response) {
                     //jika sukses
                     if(response=="OK"){
                        fetchGridData(cmbcabang);
                        $('#modaldetailcabang').modal('hide');
                     }else{
                        alert('data gagal disimpan')
                     }
                  },
                  500: function (response) {
                     //internal server error
                     alert('Terjadi Kesalahan, coba lagi.');
                     
                  }
               },
            });
        }else if(start='update'){
            $.ajax({ 
                type: 'POST', 
                url: base_url+'masterbarang/update', 
                data: postvars,  
                statusCode: {
                  200: function (response) {
                     //jika sukses
                     if(response=="OK"){
                        fetchGridData(cmbcabang);
                        $('#modaldetailcabang').modal('hide');
                     }else{
                        alert('data gagal disimpan')
                     }
                  },
                  500: function (response) {
                     //internal server error
                     alert('Terjadi Kesalahan, coba lagi.');
                     
                  }
               },
            });
        }
    }else{
        alert('field harus diisi');
    }
}

function ubah(){
    var txtkdbarang = $('#txtkdbarang').val(); 
    if(txtkdbarang!=""){
        $('#modaldetailcabang').modal('show');
        start='update';
    }else{
        alert('data belum dipilih');
    }
}

function hapus(){
    var txtnamabarang = $('#txtnamabarang').val(); 
    var txtkdbarang = $('#txtkdbarang').val(); 
    var cmbcabang = $('#cmbcabang').val(); 
    if(txtkdbarang!=""){

        var r = confirm("Hapus data "+txtnamabarang);
        if (r == true) {
            var postvars = {txtkdbarang:txtkdbarang};
            $.ajax({ 
                type: 'POST', 
                url: base_url+'masterbarang/delete', 
                data: postvars,  
                statusCode: {
                  200: function (response) {
                     //jika sukses
                     if(response=="OK"){
                        fetchGridData(cmbcabang);
                     }
                  },
                  500: function (response) {
                     //internal server error
                     alert('Terjadi Kesalahan, coba lagi.');
                     
                  }
               },
            });
        } 
    }else{
        alert('data belum dipilih')
    }
}

function gridchange(value){
    fetchGridData(value);
}

$(function(){
  $('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
        var value = $(this).val();
        
        if(value=='2'){
            $('#fieldjumlah').hide();
            $('#txtjumlah').val('');
            $('#fieldberat').show();
        }else if(value=='1'){
            $('#fieldjumlah').show();
            $('#fieldberat').hide();
            $('#txtberat').val('');
        }
    }
  });
});

//buat number format
function number_format(number, decimals, dec_point, thousands_sep) {
      // http://kevin.vanzonneveld.net
      // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
      // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
      // +     bugfix by: Michael White (http://getsprink.com)
      // +     bugfix by: Benjamin Lupton
      // +     bugfix by: Allan Jensen (http://www.winternet.no)
      // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
      // +     bugfix by: Howard Yeend
      // +    revised by: Luke Smith (http://lucassmith.name)
      // +     bugfix by: Diogo Resende
      // +     bugfix by: Rival
      // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
      // +   improved by: davook
      // +   improved by: Brett Zamir (http://brett-zamir.me)
      // +      input by: Jay Klehr
      // +   improved by: Brett Zamir (http://brett-zamir.me)
      // +      input by: Amir Habibi (http://www.residence-mixte.com/)
      // +     bugfix by: Brett Zamir (http://brett-zamir.me)
      // +   improved by: Theriault
      // *     example 1: number_format(1234.56);
      // *     returns 1: '1,235'
      // *     example 2: number_format(1234.56, 2, ',', ' ');
      // *     returns 2: '1 234,56'
      // *     example 3: number_format(1234.5678, 2, '.', '');
      // *     returns 3: '1234.57'
      // *     example 4: number_format(67, 2, ',', '.');
      // *     returns 4: '67,00'
      // *     example 5: number_format(1000);
      // *     returns 5: '1,000'
      // *     example 6: number_format(67.311, 2);
      // *     returns 6: '67.31'
      // *     example 7: number_format(1000.55, 1);
      // *     returns 7: '1,000.6'
      // *     example 8: number_format(67000, 5, ',', '.');
      // *     returns 8: '67.000,00000'
      // *     example 9: number_format(0.9, 0);
      // *     returns 9: '1'
      // *    example 10: number_format('1.20', 2);
      // *    returns 10: '1.20'
      // *    example 11: number_format('1.20', 4);
      // *    returns 11: '1.2000'
      // *    example 12: number_format('1.2000', 3);
      // *    returns 12: '1.200'
      var n = !isFinite(+number) ? 0 : +number, 
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
}

/* cara penggunaan
var txtnett=$("#txtnett").val();
if(txtnett=='')
{
 txtnett='0';
}
var numbertxtnett=txtnett.split(',').join('');
if(isNaN(numbertxtnett))
{
 numbertxtnett='0';
}
var numbertxtnettOK=number_format(numbertxtnett,2,'.',',');
*/

function konversiangka(param){
  //buat jumlah
  if(param==1){
     desimal2('txtjumlah');
  }else if(param==2){
    desimal2('txtberat');
  }else if(param==3){
    desimal2('txtharga');
  }

}

function desimal2(parameter){
  var param=$("#"+parameter+"").val();
  if(param=='')
  {
   param='0';
  }
  var numberparam=param.split(',').join('');
  if(isNaN(numberparam))
  {
   numberparam='0';
  }
  var numberparamOK=number_format(numberparam,2,'.',',');

  //return numberparamOK;
  $("#"+parameter+"").val(numberparamOK);
}

function clearfield(){
  $('#fieldjumlah').hide();
  $('#fieldberat').hide();

  $('#txtkdbarang').val('');
  $('#txtnamabarang').val('');
  $('#txtjumlah').val('');
  $('#txtberat').val('');
  $('#txtharga').val('');
  $('#txtberatkg').val('');

  //radio buttn clear
  $('input[type="radio"]').attr('checked',false)
}

function konversikgtog(){
  var kg = $('#txtberatkg').val();
  var hasil = kg*1000;

  $('#txtberat').val(hasil);
}

function konversigtokg(){
  var g = $('#txtberat').val();
  var hasil = g/1000;

  $('#txtberatkg').val(hasil);
}