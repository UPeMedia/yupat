		var pedona_brandnumber = 6,
			pedona_brandscrollnumber = 2,
			pedona_brandpause = 3000,
			pedona_brandanimate = 2000;
		var pedona_brandscroll = false;
							pedona_brandscroll = true;
					var pedona_categoriesnumber = 6,
			pedona_categoriesscrollnumber = 2,
			pedona_categoriespause = 3000,
			pedona_categoriesanimate = 700;
		var pedona_categoriesscroll = 'false';
					var pedona_blogpause = 3000,
			pedona_bloganimate = 2000;
		var pedona_blogscroll = false;
							pedona_blogscroll = false;
					var pedona_testipause = 3000,
			pedona_testianimate = 2000;
		var pedona_testiscroll = false;
							pedona_testiscroll = false;
					var pedona_catenumber = 6,
			pedona_catescrollnumber = 2,
			pedona_catepause = 3000,
			pedona_cateanimate = 700;
		var pedona_catescroll = false;
					var pedona_menu_number = 9;
		var pedona_sticky_header = false;
							pedona_sticky_header = true;
					jQuery(document).ready(function(){
			jQuery("#ws").on('focus', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("");
				}
			});
			jQuery("#ws").on('focusout', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("");
				}
			});
			jQuery("#wsearchsubmit").on('click', function(){
				if(jQuery("#ws").val()=="" || jQuery("#ws").val()==""){
					jQuery("#ws").focus();
					return false;
				}
			});
			jQuery("#search_input").on('focus', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("");
				}
			});
			jQuery("#search_input").on('focusout', function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("");
				}
			});
			jQuery("#blogsearchsubmit").on('click', function(){
				if(jQuery("#search_input").val()=="" || jQuery("#search_input").val()==""){
					jQuery("#search_input").focus();
					return false;
				}
			});
		});
		