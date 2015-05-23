var base_url	= $('#base_url').val();
$(document).ready(function(){
   
}); 

function ceklogin(){
	var email = $('#inputEmail').val();
	var password = $('#inputPassword').val();

	if(email!="" && password!=""){

		//post ke kontroller
		var postvars = {email:email,password:password};
		$.ajax({ 
			type: 'POST', 
			url: base_url+'login/ceklogin', 
			data: postvars,  
		    statusCode: {
		      200: function (response) {
		         //jika sukses
		         if(response=="OK"){
		         	//direct ke home
		         	window.location.replace(base_url+'home');

		         }else{
		         	alert('username dan passsword anda salah');
		         	$('#inputPassword').val('');
		         }
		      },
		      500: function (response) {
		         //internal server error
		         alert('Terjadi Kesalahan, coba lagi.');
		         
		      }
		   },
		});


	}else{
		alert('field harus diisi');
	}
}