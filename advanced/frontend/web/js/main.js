$(function(){
	yii.confirm = function (message, ok, cancel) {
		swal({
			title: message,
			type: "warning", 
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "删除",
			cancelButtonText: "取消",
			closeOnConfirm: false 
		}, function(isConfirm){
			if (isConfirm) { 
				//swal("Deleted!", "Your imaginary file has been deleted.", "success");  
				!ok || ok();
			} else { 
				//swal("Cancelled", "Your imaginary file is safe :)", "error");
				!cancel || cancel(); 
			}
		});
	}

	$('.modalBtn').on('click',function(){
		console.log($(this).data('toggle'))
		$("#modal .modal-body").load($(this).data('toggle'));
		$('#modal').modal('show')
	});
});