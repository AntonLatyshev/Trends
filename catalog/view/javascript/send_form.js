$(document).ready(function() {
    
$('#form-service').validate({
	submitHandler: function submitHandler() {
	    var action_post = $('#form-service').attr('action');
	    var name_post = $('#form-service input[name=name]').val();
	    var phone_post = $('#form-service input[name=phone]').val();
	    var comment_post = $('#form-service textarea[name=comment]').val();
	    var title_post = $('#form-service input[name=title]').val();
	    var subtitle_post = $('#form-service input[name=subtitle]').val();
	    var page_post = $('#form-service input[name=page]').val();

	    $.ajax({
			type:'POST',
			url:action_post,
			data:'name='+name_post+'&phone='+phone_post+'&comment='+comment_post+'&title='+title_post+'&subtitle='+subtitle_post+'&page='+page_post,
			success:function(data) {
				$('.name-danger').html('');
				$('.phone-danger').html('');
				$('.comment-danger').html('');

				if(data['success']){
					$('.popup-service').removeClass('active');

					$('#form-service').find('input, textarea').val('');
					
					$('.success-text').html(data['success']);

					$('.popup-after-add-review').addClass('active');

					setTimeout(function () {
						$('.popup-after-add-review').removeClass('active');
					}, 2000);
				}
				if(data['error']){
					if(data['error']['error_name']){
						$('.name-danger').html('<label class="error">' + data['error']['error_name'] + '</label>');
					}
					if(data['error']['error_phone']){
						$('.phone-danger').html('<label class="error">' + data['error']['error_phone'] + '</label>');
					}
					if(data['error']['error_comment']){
						$('.comment-danger').html('<label class="error">' + data['error']['error_comment'] + '</label>');
					}
				}
		    }
	    });
	}
});


$('#form-service-nf').validate({
	submitHandler: function submitHandler() {
	    var action_post = $('#form-service-nf').attr('action');
	    var phone_post = $('#form-service-nf input[name=phone]').val();
	    var comment_post = $('#form-service-nf textarea[name=comment]').val();
	    var title_nf_post = $('#form-service-nf input[name=title_nf]').val();
	    var subtitle_nf_post = $('#form-service-nf input[name=subtitle_nf]').val();

	    $.ajax({
			type:'POST',
			url:action_post,
			data:'phone='+phone_post+'&comment='+comment_post+'&title_nf='+title_nf_post+'&subtitle_nf='+subtitle_nf_post,
			success:function(data) {
				$('.phone-nf-danger').html('');
				$('.comment-nf-danger').html('');

				if(data['success']){
					$('#form-service-nf').find('input, textarea').val('');

					$('.success-text').html(data['success']);

					$('.popup-after-add-review').addClass('active');

					setTimeout(function () {
						$('.popup-after-add-review').removeClass('active');
					}, 2000);
				}
				if(data['error']){
					if(data['error']['error_phone']){
						$('.phone-nf-danger').html('<label class="error">' + data['error']['error_phone'] + '</label>');
					}
					if(data['error']['error_comment']){
						$('.comment-nf-danger').html('<label class="error">' + data['error']['error_comment'] + '</label>');
					}
				}
		    }
	    });
	}
});
	
});