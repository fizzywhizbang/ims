var manageUserTable;

$(document).ready(function() {
	// top nav bar 
	$('#navAddrbook').addClass('active');
	// manage product data table
	manageUserTable = $('#manageUserTable').DataTable({
		'ajax': 'php_action/fetchClientList.php',
		'order': []
	});

	// add product modal btn clicked
	$("#addUserModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitUserForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
 

		// submit client form
		$("#submitUserForm").unbind('submit').bind('submit', function() {
			// form validation
            var clientName = $("#clientname").val();
            var clientPhone = $("#phone").val();
            var submitform = false;
            
			if(clientName == "") {
				$("#clientname").after('<p class="text-danger">User name field is required</p>');
                $('#clientname').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#clientname").find('.text-danger').remove();
				// success out for form 
                $("#clientname").closest('.form-group').addClass('has-success');
                submitform = true;	  	
			}	// /else
            
            if(clientPhone == "") {
				$("#phone").after('<p class="text-danger">Phone number field is required</p>');
                $('#phone').closest('.form-group').addClass('has-error');
                submitform = false;
			}	else {
				// remov error text field
				$("#phone").find('.text-danger').remove();
				// success out for form 
                $("#phone").closest('.form-group').addClass('has-success');
                submitform = true;	  	
			}	// /else
			

			
				// /else

			if(submitform == true) {
				// submit loading button
				$("#createUserBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {

						if(response.success == true) {
							// submit loading button
							$("#createUserBtn").button('reset');
							
							$("#submitUserForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-user-messages').html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="fas fa-thumbs-up"></i></strong> '+ response.messages +
		          '</div>');

							// remove the mesages
		          $(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

		          // reload the manage student table
							manageUserTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit product form

	}); // /add product modal btn clicked
	

	// remove product 	

}); // document.ready fucntion

function editUser(userid = null) {

	if(userid) {
		$("#userid").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');
        
		$.ajax({
			url: 'php_action/fetchSelectedClient.php',
			type: 'post',
			data: {"clientid": userid},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

			

				// clientid
                $("#id_clients").val(response.id_clients);
                
				// client name
                $("#eclientname").val(response.client_name);
                $("#eaddress").val(response.client_address);
                $("#ephone").val(response.client_phone);
                $("#estate").val(response.client_state);
                $("#ecity").val(response.client_city);
                $("#ezip").val(response.client_zip);
                $("#einfo").val(response.client_info);
				
				
				// update the product data function
				$("#editUserForm").unbind('submit').bind('submit', function() {

                    // form validation
                    var clientName = $("#eclientname").val();
                    var clientPhone = $("#ephone").val();
                    var submitform = false;
					
								

					if(clientName == "") {
						$("#eclientname").after('<p class="text-danger">Client Name field is required</p>');
                        $('#eclientname').closest('.form-group').addClass('has-error');
                        submitform = false;
					}	else {
						// remov error text field
						$("#eclientname").find('.text-danger').remove();
						// success out for form 
                        $("#eclientname").closest('.form-group').addClass('has-success');	
                        submitform = true;  	
					}	// /else

					if(clientPhone == "") {
						$("#ephone").after('<p class="text-danger">Phone field is required</p>');
                        $('#ephone').closest('.form-group').addClass('has-error');
                        submitform = false;
					}	else {
						// remov error text field
						$("#ephone").find('.text-danger').remove();
						// success out for form 
                        $("#ephone").closest('.form-group').addClass('has-success');	
                        submitform = true;  	
					}	// /else

					

					

					

									

					if(submitform == true) {
						// submit loading button
						$("#editUserBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								console.log(response);
								if(response.success == true) {
									// submit loading button
									$("#editUserBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-user-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="fas fa-thumbs-up"></i></strong> '+ response.messages +
				          '</div>');

									// remove the mesages
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          // reload the manage student table
									manageUserTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the product data function

				

			} // /success function
		}); // /ajax to fetch product image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit product function

// remove product 
function removeUser(userid = null) {
	if(userid) {
		// remove product button clicked
		$("#removeProductBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeProductBtn").button('loading');
			$.ajax({
				url: 'php_action/removeUser.php',
				type: 'post',
				data: {userid: userid},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeProductBtn").button('reset');
					if(response.success == true) {
						// remove product modal
						$("#removeUserModal").modal('hide');

						// update the product table
						manageUserTable.ajax.reload(null, false);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {

						// remove success messages
						$(".removeUserMessages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert

					} // /error
				} // /success function
			}); // /ajax fucntion to remove the product
			return false;
		}); // /remove product btn clicked
	} // /if userid
} // /remove product function

function clearForm(oForm) {
	// var frm_elements = oForm.elements;									
	// console.log(frm_elements);
	// 	for(i=0;i<frm_elements.length;i++) {
	// 		field_type = frm_elements[i].type.toLowerCase();									
	// 		switch (field_type) {
	// 	    case "text":
	// 	    case "password":
	// 	    case "textarea":
	// 	    case "hidden":
	// 	    case "select-one":	    
	// 	      frm_elements[i].value = "";
	// 	      break;
	// 	    case "radio":
	// 	    case "checkbox":	    
	// 	      if (frm_elements[i].checked)
	// 	      {
	// 	          frm_elements[i].checked = false;
	// 	      }
	// 	      break;
	// 	    case "file": 
	// 	    	if(frm_elements[i].options) {
	// 	    		frm_elements[i].options= false;
	// 	    	}
	// 	    default:
	// 	        break;
	//     } // /switch
	// 	} // for
}