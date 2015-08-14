/* SCROLL SCRIPT */ 


console.log('plugin script called');

// $.noConflict();
jQuery( document ).ready(function() {
	// jQuery('body').append( '<div class="pageTop"></div>' );

	//smooth scroll to top
     jQuery('.pageTop').click(function(){
     	console.log('clicked');
        event.preventDefault();
        jQuery('body,html').animate({
            scrollTop: 0,
        }, scroll_top_duration);
    });
     
})



	// Config Vars
	var offset = 50,
    offset_opacity = 1200,
    scroll_top_duration = 700;
        

    //hide or show the "back to top" link
    jQuery(window).scroll(function() {
        ( jQuery(this).scrollTop() > offset ) ?  jQuery('.pageTop').addClass('cd-is-visible'):  jQuery('.pageTop').removeClass('cd-is-visible');
        
        if (jQuery(this).scrollTop() > offset_opacity) {
            jQuery('.pageTop').addClass('cd-fade-out');
        }

    });

    