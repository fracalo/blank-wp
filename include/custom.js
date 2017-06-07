jQuery(document).ready(function( $ ) { 
		
		function image_center_position($_this){
			$_this.removeAttr('top')
				.removeAttr('left')
				.css('top','0')
				.css('left','0')
				.removeAttr('width')
				.removeAttr('height')
				.css('width','')
				.css('height','');
		    var parentH = $_this.parent().height();
		    var parentW = $_this.parent().width();
		    var imgW = $_this.width();
		    var imgH = $_this.height();
		    var difW = parentH - (parentW * imgH / imgW);
		    var difH = parentW - (parentH * imgW / imgH);
		    if(difW < difH){
		        $_this.css('width','100%');
		        imgH = $_this.height();
		        $_this.css('top','-'+(((imgH - parentH ) / 2 )+'px')).css('left','0px');
		    }
		    else{
		        $_this.css('height','100%');
		        imgW = $_this.width();
		        $_this.css('left','-'+(((imgW - parentW ) / 2 )+'px')).css('top','0px');
		    }
		    $_this.fadeIn();
		}
		function image_center(elementClass){
		    $(elementClass).each(function(index){
		        var $_this = $(this);
		        var app = true;
		        /*
		        $_this.load(function(){
		            image_center_position($_this);
		            app = false;
		        });
		        if(app){
		            image_center_position($_this);
		        }*/
		        image_center_position($_this);
		    });
		}
		// -----
		function image_viewall_position($_this){
		    $_this.removeAttr('top').removeAttr('left').css('top','0').css('left','0').removeAttr('width').removeAttr('height').css('width','').css('height','');
		    var parentH = $_this.parent().height();
		    var parentW = $_this.parent().width();
		    var imgW = $_this.width();
		    var imgH = $_this.height();
		    var difW = parentH - (parentW * imgH / imgW);
		    var difH = parentW - (parentH * imgW / imgH);
		    if(difW < difH){
		        $_this.css('height','100%');
		        imgW = $_this.width();
		        $_this.css('left',''+(((parentW - imgW ) / 2 )+'px')).css('top','0px');
		    }
		    else{
		        $_this.css('width','100%');
		        imgH = $_this.height();
		        $_this.css('top',''+(((parentH - imgH ) / 2 )+'px')).css('left','0px');
		    }
		    $_this.fadeIn();
		}
		function image_viewall(elementClass){
		    $(elementClass).each(function(index){
		        var $_this = $(this);
		        var app=true;
		        /*
		        $_this.load(function(){
		            image_viewall_position($_this);
		            app = false;
		        });
		        if(app){
		            image_viewall_position($_this);
		        }*/
		        image_viewall_position($_this);
		    });
		}
		
		//Select
		$(window).on('load',function(){
			if($('.box_bg_center').length>0){
				image_center('.box_bg_center');
			}
		
			if($('.box_bg_viewall').length>0){
				image_viewall('.box_bg_viewall');
			}
		});
		
  		$(window).resize(function(){
  			if($('.box_bg_center').length>0){
				image_center('.box_bg_center');
			}
		
			if($('.box_bg_viewall').length>0){
				image_viewall('.box_bg_viewall');
			}
		});
	
});