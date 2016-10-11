(function($){
	$(document).ready(function(){
		$(".panel-heading a").click(function(e){
			if ($(this).hasClass('active')) {
				$(this).find('.icon').toggleClass('fa-plus fa-minus');
			} else {
				$(".panel-heading a").find('.icon').addClass('fa-plus').removeClass('fa-minus');
				$(this).find('.icon').addClass('fa-minus').removeClass('fa-plus');
			}

			$(".panel-heading a").removeClass('active');
			$(this).addClass('active');

			e.preventDefault();
		});
  });
})(jQuery);