var Ultra = {
	init : function(){
		Ultra.ajaxForm('[name=formContato]');
	},
		ajaxForm: function(selector,cb) {
		$('body').on('submit',selector,function(){
			var $self = $(this);
			if ($self.data('enviando')) return false;
			
			$self.data('enviando',true);
			$.fancybox.showLoading();
			
			var callback = function(resp) {
				$self.data('enviando',false);
				$.fancybox.hideLoading();

				if (cb) return cb(resp,$self);
				alert(resp.msg);
				if (resp.success) {
					$self[0].reset();
				}
			}
			
			$.ajax({
				url: $self.attr('action'),
				type: 'post',
				dataType: 'json',
				data: $self.serializeArray(),
				success: callback,
				error: function() {
					callback({success:false,msg:"Não foi possível enviar o formulário."});
				}
			});
			return false;
		});
	},
};

$(document).ready(function(){
	
	$(Ultra.init);
	
});