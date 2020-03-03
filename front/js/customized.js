
jQuery(document).keydown(function(e) {
	
  if (e.keyCode == 222 && e.ctrlKey) {
	  
	  var myGridized = '<div id="gridized"><div class="container"><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div><div class="col-sm-1"><div></div></div></div></div>';
	  
	  jQuery("#gridized").remove();
	  jQuery("html").toggleClass("hint--gridized");
	  jQuery("html.hint--gridized body").append(myGridized);
  }
});
/*
var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
                    slidesPerView: 3,
                    slidesPerColumn: 2,
                    paginationClickable: true,
                    spaceBetween: 30,
					autoplay: 2500,
					autoplayDisableOnInteraction: false,
					breakpoints: {
						1024: {	slidesPerView: 3, spaceBetween: 40 },
						768: { slidesPerView: 2, spaceBetween: 30 },
						640: { slidesPerView: 1, spaceBetween: 20 },
						320: { slidesPerView: 1, spaceBetween: 10 }
					}			
            });
			*/


		jQuery("div").each(function (checkMediaType) {
			jQuery( this ).contents().find( "img" ).parent("*").addClass( "has-image" );
			jQuery( this ).contents().find( "iframe" ).parent("*").addClass( "has-iframe" );
			jQuery( this ).contents().find( "video" ).parent("*").addClass( "has-video" );
		});



		/**making a specific page unresponsive**/
		jQuery( document ).ready(function() {
			
			var rwdDisableCode = '<meta name="viewport" content="width=1440, user-scalable=no">';
			var rwdDisableMode = jQuery("section, div").hasClass("page--no-rwd");
			
			if (jQuery("body").hasClass("parameter--norwd")) {
				jQuery("body").append(rwdDisableCode);
			  }
			  
			if (rwdDisableMode) {
			  if (!jQuery("body").hasClass("parameter--rwd")) {
				jQuery("body").append(rwdDisableCode);
			  }
			}
		});
		/**./making a specific page unresponsive**/


/*
myLogs( param= "aa" );

(function myLogs($param) {
	jQuery(document).keydown(function(e) {
		if (e.keyCode == 32 && e.ctrlKey) {
			//alert(param);
			console.log(param);
	  }
	});
});

jQuery(document).keypress("c",function(e) {
  if(e.ctrlKey)
    alert("Ctrl+C was pressed!!");
});

*/


		var footerHeight = jQuery("footer").height();
		jQuery("footer").attr("data-height", footerHeight );
		console.log(footerHeight);



		/**Detecting AJAX request start and loaded**/
		jQuery(document).ajaxStart(function() {
			jQuery("body").removeClass("ajax--loaded").addClass("ajax--loading"); 
		});

		jQuery(document).ajaxStart(function() {	
			jQuery("body").removeClass("ajax--loading").addClass("ajax--loaded");
		});
		/**./Detecting AJAX request start and loaded **/


$(document).ajaxSuccess(function() {
  	var windowHeight = jQuery(window).height();
	var documentHeight = jQuery(document).height();
	var bodyHeight = jQuery('body').height()
	
	
	var documentHeight2 = documentHeight + footerHeight;
	var bodyHeight2 = bodyHeight + footerHeight;
	
	console.log("window height:" + windowHeight );
	console.log("document height:" + documentHeight );
	console.log("document height 2:" + documentHeight2 );
	console.log("Body height:" + bodyHeight );
	
	
	
	//setTimeout(function() {
		if( documentHeight2 < windowHeight   || bodyHeight2 < windowHeight ){
			console.log("short page");
			jQuery("body").addClass("page-height-short");
		}else{
			jQuery("body").removeClass("page-height-short");
		}
		//}, 2000);
		
});
