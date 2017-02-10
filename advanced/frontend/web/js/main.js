$(function(){
	/**
	 * 重写alert
	 */
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
	/**
	 * modal 显示隐藏层
	 */
	$('.modalBtn').on('click',function(){
		$("#modal .modal-title").html($(this).data('title'));
		$("#modal .modal-body").load($(this).data('toggle'));
		$('#modal').modal('show')
	});
});