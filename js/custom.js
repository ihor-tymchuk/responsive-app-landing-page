var control_timeout, footerHeight;
$(document).foundation();
$(document).ready(function(){
	$("html").niceScroll({ autohidemode: false });
	$('#menu').localScroll({hash:true, onAfterFirst:function(){$('html, body').scrollTo( {top:'-=25px'}, 'fast' );}});
	$('.flexslider').flexslider({
      animation: "fade",
      directionNav: true,
      controlNav: false,
      pauseOnAction: true,
      pauseOnHover: true,
      direction: "horizontal",
      slideshowSpeed: 5500
    });
	
	$('#button-send').click(function(event){
		$('#button-send').html('ЗАЧЕКАЙТЕ ...');
		event.preventDefault();
		
		$('html, body').scrollTo( $('#contact'), 'fast' );
		
		$.ajax({
			type: 'POST',
			url: 'http://gib-education.com/php/send_form_email.php',
			data: $('form').serialize(),
			success: function(html) {
				console.log(html)
				if(html.success == '1')
				{
					$('#button-send').html('ВІДПРАВИТИ');
					$('#success').show();
				}
				else
				{
					$('#button-send').html('ВІДПРАВИТИ');
					$('#error').show();
				}					
			},
			error: function(){
				$('#button-send').html('ВІДПРАВИТИ');
				$('#error').show();
			}
		});
		
	});
	
	
});


function valemail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return true;
}
