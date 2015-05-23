//keterangan:
//.removeAttr('disabled');
//.attr('disabled','disabled');
var start='';
var base_url    = $('#base_url').val();
$(document).ready(function () {

    $('#btnubah').attr('disabled','disabled');
    $('#btnhapus').attr('disabled','disabled');

    $("#jqGrid").jqGrid({
        colModel: [
            { label: 'ID', name: 'id', key: true, width: 40 },
            { label: 'Nama Cabang', name: 'nama_cabang', width: 1100 }
        ],
		viewrecords: true,
        width: 'auto',
        height: 250,
        rowNum: 20,
        datatype: 'local',
        pager: "#jqGridPager",
        caption: "List Data Master Cabang",
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

    
    fetchGridData();

});

 function fetchGridData() {
                
    var gridArrayData = [];
    // show loading message
    $("#jqGrid")[0].grid.beginReq();
    $.ajax({
        url: base_url+'mastercabang/getall',
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
    var nama_cabang = rowData['nama_cabang'];
    var id = rowData['id'];


    $('#txtnamacabang').val(nama_cabang);
    $('#txtid').val(id);

}

function tambah(){
    $('#modaldetailcabang').modal('show');
    $('#txtid').val('');
    $('#txtnamacabang').val('');
    $("#jqGrid").jqGrid("resetSelection");
    start='save';
}

function do_save(){
    var txtnamacabang = $('#txtnamacabang').val(); 
    var txtid = $('#txtid').val(); 

    if(txtnamacabang!=""){
        var postvars = {txtid:txtid,txtnamacabang:txtnamacabang};

        if(start=='save'){
            $.ajax({ 
                type: 'POST', 
                url: base_url+'mastercabang/save', 
                data: postvars,  
                statusCode: {
                  200: function (response) {
                     //jika sukses
                     if(response=="OK"){
                        fetchGridData();
                        $('#modaldetailcabang').modal('hide');
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
                url: base_url+'mastercabang/update', 
                data: postvars,  
                statusCode: {
                  200: function (response) {
                     //jika sukses
                     if(response=="OK"){
                        fetchGridData();
                        $('#modaldetailcabang').modal('hide');
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
    $('#modaldetailcabang').modal('show');
    start='update';
}

function hapus(){
    var txtnamacabang = $('#txtnamacabang').val(); 
    var txtid = $('#txtid').val(); 

    var r = confirm("Hapus data "+txtnamacabang);
    if (r == true) {
        var postvars = {txtid:txtid};
        $.ajax({ 
            type: 'POST', 
            url: base_url+'mastercabang/delete', 
            data: postvars,  
            statusCode: {
              200: function (response) {
                 //jika sukses
                 if(response=="OK"){
                    fetchGridData();
                 }
              },
              500: function (response) {
                 //internal server error
                 alert('Terjadi Kesalahan, coba lagi.');
                 
              }
           },
        });
    } 

}

