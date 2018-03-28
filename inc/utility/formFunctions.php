<script>
	function validateForm(idform){
		errors='no';
		$('#'+idform).find('.validatefield').each(function(){
			attr = $(this).attr('required');
			value = $(this).val();
			type = $(this).attr('type');
			if (typeof attr !== typeof undefined && attr !== false) {
				
				if(value==''){
					errors='si';
					$(this).addClass('input-error');
					console.log($(this).attr('name'));
				}else{
					if(type=='email'){
						if(IsEmail(value)===false){
							errors='si';
							console.log($(this).attr('name'));
						}
					}else{
						$(this).removeClass('input-error');
					}
				}	
			}
		});
		
		if(errors=='no'){
			$('#'+idform).submit();
		}else{
			alert("<?php echo $compilaform; ?>");
		}
	}
	function IsEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}
</script>