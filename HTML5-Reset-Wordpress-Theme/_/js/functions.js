// remap jQuery to $
(function($){})(window.jQuery);


/* trigger when page is ready */
$(document).ready(function (){
	
	// Hide all the subworld layer divs
	
	$('.subworld').fadeOut(0);
	
	// Add tooltips to each area on the main map
	
	$('.maparea').tooltip();
	
	// Add world map map area backgrounds
	
	$('#worldmap .maparea').each(function() {
//		alert($(this).css('left'));
//		alert($(this).css('top'));
		$(this).css('background', 'url('+$('#worldmap > .mapimage > img').attr('src')+') no-repeat -'+$(this).css('left')+' -'+$(this).css('top'));
//		$(this).css('background-position-x', '-=1');
//		$(this).css('background-position-y', '-=1');
		
	})
	
	$('.imagedimmer').css('background', 'url('+$('#worldmap > .mapimage > img').attr('src')+') no-repeat');
	
	$('#worldmap > .maparea').hover(function () {
		$('.imagedimmer').stop().fadeTo(500, 0.7);
		$(this).siblings('.maparea').stop().fadeTo(500, 0);
	}, function () {
		$('.imagedimmer').stop().fadeTo(500, 1)
		$(this).siblings('.maparea').stop().fadeTo(500, 1);
	})
	
	// If a map area is clicked, use the href to show the matching .subworld div , .addtowishlist
	
	$('#worldmap .maparea').click(function() {
		var worldID = $(this).attr('href');
		$(worldID).fadeIn(500);
		return false;
	})
	
	// Hide the current .subworld if the .closesubworld button is clicked
	
	$('.closesubworld').click(function() {
		$(this).parent().fadeOut(500);
	})
	
	// Show the next sub world div if .nextmap is clicked AND it's not the last map otherwise show the first submap
	
	$('.nextmap').click(function() {
		if($(this).parent().next('.subworld').length == 0) {
			$(this).parent().fadeOut(500).siblings('.subworld').first().fadeIn(500);
		}
		
		else {
			$(this).parent().fadeOut(500).next('.subworld').fadeIn(500);
		}
	})
	
	// When hovering over .subworld.maparea show it's hidden .subworldsectiondetail AND hide others that might be currently displayed. Hover out has been removed so it will stay until another .subworld.maparea is hovered over or the close button is clicked
	
	$('.subworld.maparea').hover(function () {
		$(this).parent().children('.subworld.maparea').children('.subworldsectiondetail').stop(true).animate({opacity: 0}, {queue: false, duration: 300, complete: function () {$(this).hide();}});
		$(this).children('.subworldsectiondetail').stop(true).show().animate({opacity: 1}, {queue: false, duration: 300});
		//$(this).children('.subworldsectiondetail').fadeIn(400);
		
	}, function () {
		//$(this).children('.subworldsectiondetail').stop(true).animate({opacity: 0}, {queue: false, duration: 500, complete: function () {$(this).hide();}});
		//$(this).children('.subworldsectiondetail').fadeOut(400);
	})
	
	// Close button for .subworld.maparea
	
	$('.subworldsectiondetail .close').click(function() {
		$(this).parent().stop(true).animate({opacity: 0}, {queue: false, duration: 300, complete: function () {$(this).hide();}});
	})
		
	// Sortable lists
	
	$( "#sortable1" ).sortable({
		connectWith: ".connectedSortable"
	}).disableSelection();
	
	// Add to wishlist
	
	$('.addtowishlist').click(function() {
		newlistitem = $(this).parent().children('.title').text();
		locationID = $(this).attr('title');
		if($('.sortablelist ul li').length < 9 && !$(this).hasClass('disabled')) {
			$('.sortablelist ul').append('<li class="'+locationID+'" title="'+locationID+'"><a class="close">&times;</a><span>'+newlistitem+'</span></li>');
			$('li.'+locationID).fadeOut(0).fadeIn(500);
			//$('.sortablelist ul').append('<li>'+newlistitem+'<a class="close">&times;</a></li>');
			$(this).addClass('disabled');
			
			// determine what the next list item number will be based on the length of the number of li elements in the .sortable list and then change the location id for the locationlistids array and push the jauery bbq
			
			var listlength = $('.sortablelist ul li').length;
			
			locationlistids[listlength] = locationID;
			
			$.bbq.pushState( locationlistids );
			
		}
		else if ($('.sortablelist ul li').length == 9 && !$(this).hasClass('disabled')) {
			alert('Too many items. Please remove some before adding more.');
		}
		else if ($(this).hasClass('disabled')) {
			alert('This item has already been added');
		}
		
		// Remove from wishlist has to be added here to have listeners on each newly added item
		
		removelocationfromlist();
		
		// Open that item location if clicked
		
		openlocationfromlist();
		
		// Show the list
		
		$('.planandwinpanel').children().hide();
		$('.sortablelist').show();
		
		return false;
		
	})
	
	$('.copysharelink').click(function() {this.select();});
	
	// Panel Sections
	
	$('.planandwinpanel a.back').click(function() {
	
		$(this).parents('.panel').hide(0, function() {$(this).prev().show()})
	
	})
	
	// close welcome panel and open next panel
	$('.welcomepanel a.btn').click(function() {
		$(this).parents('.welcomepanel').hide(0, function () {$('.welcomepanel').next().show(0);});
		return false;
	});
	
	// When enter button is selected
	
	$('.sortablelist .newlist a.btn').click(function() {
		
		// if 9 items have been added
		
		if($('#sortable1').children('li').length >= 9) {
			
			// collect up all the items into the wishlistitems variable
			
			wishlistitems = "";
			
			$('#sortable1 > li > span').each(function (index) {
				
				// apply a little formatting to the variable for each item
				
				if (index == 0) {
					wishlistitems += (index+1) + ": " + $(this).text();
				}
				else {
					wishlistitems += ", " + (index+1) + ": " + $(this).text();
				}
				
			});
			
			// add the resulting list items to the hidden field on the submit panel form
			
			$('.sharepanel .wishlist input').val(wishlistitems);
			
			//alert($('.sharepanel .wishlist input').val());
			
			// put together the share wishlist hashtag
			
			wishlisthashtag = "#";
			
			$('#sortable1 > li').each(function (index) {
				
				// apply a little formatting to the variable for each item
				
				if (index == 0) {
					wishlisthashtag += (index+1) + "=" + $(this).attr('class');
				}
				else {
					wishlisthashtag += "&" + (index+1) + "=" + $(this).attr('class');
				}
				
			});
			
			//alert(encodeURI(wishlisthashtag));
			
			// show the next panel
			
			$(this).parents('.sortablelist').hide(0, function () {$('.sentancepanel').show(0);});
			
			return false;
			
		}
		
		// if there aren't 9 items in the list yet, display alert
		
		else {alert('Select more items');}
	});
	
	// Go to travelplan panel
	
	$('.gototravelplanpanel').click(function() {
		
		$('.planandwinpanel').children().hide(0, function() { $('.planandwinpanel .sortablelist').show(0); });
		
		return false;
		
	});
	
	// Go to the sentance panel
	
	$('.sentancepanel .collumn3 a.btn').click(function() {
		$('.sentancepanel').hide(0, function() {
			$(this).next().show()
		})
		
		return false;
	});
	
	// Verify fields on details panel and then transfer them to the share panel form if they are valid
	
	var errors = 0;
	
	// Set the initial settings for the addthis shares
	
//	var addthis_share =
//	{
//		url: "http://localhost:8888/phillipisland/wordpress/",
//		title: "Phillip Island",
//		description: "Best holiday ever"
//	}
	
	//alert(addthis_share['url']);
	
	
	
	$('.detailsform').validate({
		invalidHandler: function(form, validator) {
			errors = validator.numberOfInvalids();
			if (errors) {
				//$('.submitpanel input.submit.btn').addClass('disabled');
			} else {
				//$('.submitpanel input.submit.btn').removeClass('disabled');
			}
		},
		submitHandler: function(form) {
			
			// Move to next panel
			
			$('.planandwinpanel').children().hide(0, function() {$('.planandwinpanel .sharepanel').show(0); });
			
			// Move details from submit panel into hidden fields on the share panel
			
			$('.hiddenformfields .your-name input').val($('.submitpanel .text-field.name').val());
			
			$('.hiddenformfields .your-email input').val($('.submitpanel .text-field.email').val());
			
			$('.hiddenformfields .phone-number input').val($('.submitpanel .text-field.phone-number').val());
			
			$('.hiddenformfields .postcode input').val($('.submitpanel .text-field.postcode').val());
			
			// Move wishlist hashtag and name encoded to twitter URL
			
			// Need to manually replace the hash symbol with it's %23 code since encodeURI doesn't do it
			
			//var twitterwishlisthashtag = encodeURI(wishlisthashtag).replace("#", "%23");
			
			//twitterwishlisthashtag = twitterwishlisthashtag.replace("&", "")
			
			//alert(twitterwishlisthashtag);
			
			//alert($('.addthis_toolbox').attr('addthis:url'));
			
			$('.sharepanel .addthis_toolbox').attr('addthis:url', $('.sharepanel .addthis_toolbox').attr('addthis:url')+wishlisthashtag)
			
			//$('.sharepanel .twittershare.btn').attr("href", $('.sharepanel .twittershare.btn').attr("href")+encodeURIComponent("&name="+$('.hiddenformfields .your-name input').val())+encodeURIComponent("&text=My Phillip Island Getaway&via=phillipislandvia"));
			
			// Move Facebook hashtag link to data in facebook share link
			
			//$('.sharepanel .facebookshare.btn').attr("data-link", $('.sharepanel .facebookshare.btn').attr("data-link")+encodeURI(wishlisthashtag+"&name="+$('.hiddenformfields .your-name input').val()));
			
			addthis.button(".addthis_button_facebook");
			
			addthis.button(".addthis_button_twitter");
			
			//alert($('.sharepanel .facebookshare.btn').data("link"));
			
			//alert(encodeURI(wishlisthashtag+"&name="+$('.hiddenformfields .your-name input').val()+"&text=My perfect Phillip Island Getaway itinerary&via=phillipislandvia&related=phillipislandrelated&hashtags=phillipislandhashtag"));
			
			return false;
		    
		    // do other stuff for a valid form
			//form.submit();
		}
	});
	
	$('.sharepanel input.wpcf7-submit.btn').click(function() {
	
		$('.planandwinpanel').children().hide(0, function() { $('.planandwinpanel .finishpanel').show(0); });
		
		//alert($('.submitpanel input.email').val());
		//validateEmail($('.submitpanel input.email').val());
		//if () {
		//	$('.planandwinpanel').children().hide(0, function() { $('.planandwinpanel .sharepanel').show(0); });
			
			//if (errors <= 0) {
			
				//alert("hi")
				
			//}
			
			//else {
				
				
				
			//	return false;
				
			//}
			
		//};
		
	});
	
	
	
	
	
	
	// jquery BBQ
	
	var params = new Array();
	
	$(window).bind( 'hashchange', function( event ){
	  // get options object from hash
	  params = $.deparam.fragment();
	})
	
	// trigger hashchange to capture any hash data on init
	.trigger('hashchange');
	
	// Values are not coerced.
	//var params = $.deparam.querystring();
	
	// Put all the location list ids into a new array
	
	var locationlistids = new Array();
	
	locationlistids["1"] = params["1"];
	locationlistids["2"] = params["2"];
	locationlistids["3"] = params["3"];
	locationlistids["4"] = params["4"];
	locationlistids["5"] = params["5"];
	locationlistids["6"] = params["6"];
	locationlistids["7"] = params["7"];
	locationlistids["8"] = params["8"];
	locationlistids["9"] = params["9"];
	
	//alert(locationlistids["1"]);
	
	
	$.each(locationlistids, function(index) {
		
		locationID = params[index];
		
		if(locationID) {
			$('.planandwinpanel').children().hide();
			$('.sortablelist').show();
		}
		
		if(locationID){
			
			newlistitem = $('.'+locationID+' .title').text();
			
			$('.sortablelist ul').append('<li class="'+locationID+'" title="'+locationID+'"><span>'+newlistitem+'</span><a class="close">&times;</a></li>');
			$('li.'+locationID).fadeOut(0).fadeIn(500);
			
			// disable the add to wishlist button for this item
			$('.'+locationID+'.addtowishlist').addClass('disabled');
			
		}
		
	});
	
	
	// Remove from wishlist has to be added here to have listeners on each newly added item
	
	removelocationfromlist();
	
	// Open that item location if clicked
	
	openlocationfromlist();
		
			
	
	
	
	
	
	
	// show location sortable list if any location ids in the query string
	
	//if (location1id === 'undefined') {
	//	alert(location1id);
	//}
	
	if(params["name"]){
		name = params["name"];
		
		$('.sortablelist .newlist').hide();
		
		$('.sortablelist .sharedlist').show();
		
		$('.sortablelist .collumn1 .sharedlist').prepend('<p>You are viewing '+name+'\'s Island itinerary. <a href="#" class="makenewitinerary">Make your own</a> and you could win a perfect family getaway!</p>');
		
		$('.sortablelist a.close').hide();
		
		// Show the list
		
		$('.planandwinpanel').children().hide();
		$('.sortablelist').show();
	}
	
	// Remove list when .makenewitinerary button is clicked
	
	$('.makenewitinerary').click(function() {
	
		$('.sortablelist .newlist').show();
		
		$('.sortablelist .sharedlist').hide();
		
		$('.sortablelist a.close').show();
		
		$('.sortablelist ul li').remove();
		
		$('.addtowishlist.disabled').removeClass('disabled');
		
		locationlistids.splice(1, 9);
		
		//.splice(startIndex, deleteCount, replacingItem1, ...)
		
		jQuery.bbq.removeState();
		
		$.bbq.pushState( locationlistids, 0 );
		
		return false;
		
	});
		
	
	// get the shared location id and show if it there is one
	
	sharedlocationid = params["sharedlocation"];
	
	$('.subworldsectiondetail').stop(true).animate({opacity: 0}, {queue: false, duration: 300, complete: function () {$(this).hide();}});
	$('.'+sharedlocationid+'.subworldsectiondetail').stop(true).show().animate({opacity: 1}, {queue: false, duration: 300}).parent().parent('.subworld').fadeIn(500).siblings('.subworld').fadeOut(500);
	
	  
	//debug.log( 'not coerced', params );
	//$('#deparam_string').text( JSON.stringify( params, null, 2 ) );
	
	// Values are coerced.
	//params = $.deparam.querystring( true );
	
	//alert(params['1']);
	
	//debug.log( 'coerced', params );
	//$('#deparam_coerced').text( JSON.stringify( params, null, 2 ) );
	
	// Highlight the current sample query string link
	//var qs = $.param.querystring();
	
	//$('li a').each(function(){
	//  if ( $(this).attr( 'href' ) === '?' + qs ) {
	//    $(this).addClass( 'current' );
	//  }
	//});
	
	//alert(JSON.stringify( params, null, 2 ));
	
	
	
	// Functions
	
	
	// Open location when item clicked in the list
	
	function openlocationfromlist() {
		
		$('#sortable1 li').click(function() {
			
			locationID = $(this).attr('title');
			$('.subworldsectiondetail').stop(true).animate({opacity: 0}, {queue: false, duration: 300, complete: function () {$(this).hide();}});
			$('.'+locationID+'.subworldsectiondetail').stop(true).show().animate({opacity: 1}, {queue: false, duration: 300}).parent().parent('.subworld').fadeIn(500).siblings('.subworld').fadeOut(500);
		})
		
	}
	
	// Remove location from list
	
	function removelocationfromlist() {
	
		$('.sortablelist a.close').click(function() {
			
			enableclass = $(this).parent().attr('title');
			enabledclass = '.btn.addtowishlist.'+enableclass;
			$('.btn.addtowishlist.'+enableclass).removeClass('disabled');
			$(this).parent().fadeOut(500, function() {$(this).remove();});
			
			
			var listlength = $(this).parent().prevAll().length + 1;
			
			//alert(listlength);
			//var listlength = $('.sortablelist ul li').length;
			
			//if(locationlistids[listlength] == ""){while(locationlistids[listlength] == ""){listlength++;}}
			
			//locationlistids[listlength] = "";
			
			locationlistids.splice(listlength, 1);
			
			//.splice(startIndex, deleteCount, replacingItem1, ...)
			
			jQuery.bbq.removeState();
			
			$.bbq.pushState( locationlistids, 0 );
			
			//locationlistids.splice(listlength, 1);
			
			return false;
			
		});
	
	}
	
	// Facebook Posting
	
	//<p><a onclick='postToFeed(); return false;'>Post to Feed</a></p>
	//<p id='msg'></p>
	
	//$('.facebookshare').data('testing', 'test');
	
	$('.subworldsectiondetail .facebookshare').click(function() {
		
		//alert($(this).data(sharedlocation));
		//$(this).data('testing', 'test');
		//alert($(this).data("testing"));
		//alert('hi');
		//
		
		link = $(this).data("link");
		picture = $(this).parent().siblings('.image').children('img').attr('src');
		name = $(this).parent().siblings('.title').text();
		caption = $(this).parent().siblings('.subtitle').text();
		description = $(this).parent().siblings('.description').text();
		itinerary = false;
		
		postToFeed(link, picture, name, caption, description, itinerary);
		//alert(link); 
		//alert(picture);
		//alert(name);
		//alert(caption);
		//alert(description);
		return false;
		//postToFeed();
		
	});
	
	$('.sharepanel .facebookshare').click(function() {
		
		// need to update these details and choose an image for itinerary shares
		
		link = $(this).data("link");
		picture = $(this).parent().siblings('.image').children('img').attr('src');
		name = "My Perfect Phillip Island getaway";
		caption = "My Perfect Phillip Island getaway";
		description = "My Perfect Phillip Island getaway";
		itinerary = true;
		
		postToFeed(link, picture, name, caption, description, itinerary);
		return false;
		
	});
	
	$('.sharepanel .twittershare').click(function() {
		
		$(this).addClass("done");
		
		$('.sharepanel .extrapoints input').val($('.sharepanel .extrapoints input').val()+"Twitter Shared. ");
	
	});
	
	
	function postToFeed(link, picture, name, caption, description, itinerary) {
	
		// calling the API ...
		var obj = {
			method: 'feed',
			link: link,
			picture: picture,
			name: name,
			caption: caption,
			description: description
		};
		
		function callback(response) {
			//document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
			
			if (itinerary) {
			
				if (response && response.post_id) {
					//alert('Post was published.');
					
					// if post is successfully posted to facebook, add done class to facebook button and update the points field in the submit field
					
					$('.sharepanel .facebookshare.btn').addClass("done");
					
					$('.sharepanel .extrapoints input').val($('.sharepanel .extrapoints input').val()+"Facebook Shared. ");
					
					//alert($('.sharepanel .extrapoints input').val());
					
				} else {
					//alert('Post was not published.');
				}
			
			}
		}
		
		FB.ui(obj, callback);
	}
	
	
	
	// Twitter posting
	
//	$('.twittershare').click(function(event) {
//	    
//	    twttr.widgets.load();
//	    
//	    var width  = 575,
//	        height = 400,
//	        left   = ($(window).width()  - width)  / 2,
//	        top    = ($(window).height() - height) / 2,
//	        url    = $(this).attr('href'),
//	        opts   = 'status=1' +
//	                 ',width='  + width  +
//	                 ',height=' + height +
//	                 ',top='    + top    +
//	                 ',left='   + left;
//		    
//	    window.open(url, 'twitter', opts);
//	 	
//	    return false;
//	});

});


/* optional triggers

$(window).load(function() {
	
});

$(window).resize(function() {
	
});

*/