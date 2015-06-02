var base_url    = $('#base_url').val();
$(document).ready(function(){
	$("#txtperiode1").datepicker({ 
         dateFormat: "dd-mm-yy",
         beforeShow: function (input, inst) {
         var offset = $(input).offset();
         var height = $(input).height();
         window.setTimeout(function () {
             inst.dpDiv.css({ top: (offset.top + height + 4) + 'px', left: offset.left + 'px' })
         }, 1);
            },
         changeMonth: true,
         changeYear: true,
         yearRange: "-10:+0",
         onSelect: function (dateText, inst) 
         {
            var tglOK=false;
            var partsArray = dateText.split('-');
            
            var d = new Date(+partsArray[2],(+partsArray[1])-1,+partsArray[0]);
            tglOK=true;
            if(tglOK)
            {
                //var dateOffset = (24*60*60*1000) * 7;
                d.setDate(d.getDate()+6);
                //alert(d);
                var hasil=d.getDate()+'';
                if(d.getDate()<=9)
                {
                    hasil='0'+d.getDate();
                }
                
                if((d.getMonth()+1)<=9)
                {
                    hasil=hasil+'-0'+(d.getMonth()+1);
                }
                else
                {
                    hasil=hasil+'-'+(d.getMonth()+1);
                }
                hasil=hasil+'-'+(d.getFullYear());
                $("#txtperiode2").val(hasil);
            }
         }
      });



     $("#txtperiode2").datepicker({ 
         dateFormat: "dd-mm-yy",
         changeMonth: true,
         changeYear: true,
         yearRange: "-10:+0",
         onSelect: function (dateText, inst) 
         {
            var partsArray = dateText.split('-');
            
            var d = new Date(+partsArray[2],(+partsArray[1])-1,+partsArray[0]);
            var strmaxdate=$("#txtperiode1").val();
            
            var maxDateArray = strmaxdate.split('-');
            var maxdate=new Date(+maxDateArray[2],(+maxDateArray[1])-1,+maxDateArray[0]);
            if(d < maxdate)
            {
                alert("Tanggal Periode 2 tidak boleh [lebih kecil] dari tanggal Periode 1 ["+strmaxdate+"]");
                $("#txtperiode2").val("");
            }
         }
      }); 

});

function cari(valuee){
    var tanggal1 = $('#txtperiode1').val();
    var tanggal2 = $('#txtperiode2').val();
    var cmbcabang = $('#cmbcabang').val();

    if(tanggal1!="" && tanggal2!=""){
        var postvars = {tanggal1:tanggal1,tanggal2:tanggal2,cmbcabang:cmbcabang};
        $.ajax({ 
            type: 'POST', 
            url: base_url+'laporan/cari', 
            data: postvars,  
            statusCode: {
              200: function (response) {
                 //jika sukses
                 //render ke html
                 $('#tbldata').html(response);
              },
              500: function (response) {
                 //internal server error
                 alert('Terjadi Kesalahan, coba lagi.');
                 
              }
           },
        });

    }else{
        alert('Periode Wajib diisi');
    }
    
}

