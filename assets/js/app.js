function addTotal(what){
	then=$('#wrap-total').html()+what;
	$('#wrap-total').html(then);
	updateQR();
}
function delTotal(){
	then=$('#wrap-total').html().slice(0,-1);
	$('#wrap-total').html(then);
	updateQR();
}

function updateQR(){
		$('#qr-wrap').html('');
		$.ajax({
		  method: "POST",
		  url: "/scripts/QR/png.php",
		  data: { address: "1Hhaq7Xbz6uNz4ESg8RhvDwJkDErsnar3X", amount: $('#wrap-total').html() }
			}).done(function( msg ) {
	    $('#qr-wrap').html(msg);
	  });
}

function initUser(){
			$.ajax({
					method: "POST",
					url: "/init"
				}).done(function( msg ) {
						$('#response').html(msg);
				});
}
