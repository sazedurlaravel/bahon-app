$(document).ready(function(){
	$nowShowing = 1;
	$(logo_toggler = function(){
		if($nowShowing == 1){
			$('.lgd-logo-bn').css({"position":"relative"});
			$('.lgd-logo').css({"position":"absolute"});
			$('.lgd-logo').hide();
			$('.lgd-logo-bn').fadeIn(2000);
			$nowShowing = 2;
		}
		else{
			$('.lgd-logo-bn').css({"position":"absolute"});
			$('.lgd-logo').css({"position":"relative"});
			$('.lgd-logo-bn').hide();
			$('.lgd-logo').fadeIn(2000);	
			$nowShowing = 1;		
		}
	});
	setInterval(function(){ logo_toggler(); },4000);
});
