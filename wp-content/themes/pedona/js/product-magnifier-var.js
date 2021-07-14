"use strict";
// product-magnifier var
var pedona_magnifier_vars;
var yith_magnifier_options = {
		
		sliderOptions: {
			responsive: pedona_magnifier_vars.responsive,
			circular: pedona_magnifier_vars.circular,
			infinite: pedona_magnifier_vars.infinite,
			direction: 'left',
			debug: false,
			auto: false,
			align: 'left',
			height: 'auto', 
			//height: "100%", //turn vertical
			//width: 72,
			prev    : {
				button  : "#slider-prev",
				key     : "left"
			},
			next    : {
				button  : "#slider-next",
				key     : "right"
			},
			scroll : {
				items     : 1,
				pauseOnHover: true
			},
			items   : {
				visible: Number(pedona_magnifier_vars.visible),
			},
			swipe : {
				onTouch:    true,
				onMouse:    true
			},
			mousewheel : {
				items: 1
			}
		},
		
		showTitle: false,
		zoomWidth: pedona_magnifier_vars.zoomWidth,
		zoomHeight: pedona_magnifier_vars.zoomHeight,
		position: pedona_magnifier_vars.position,
		lensOpacity: pedona_magnifier_vars.lensOpacity,
		softFocus: pedona_magnifier_vars.softFocus,
		adjustY: 0,
		disableRightClick: false,
		phoneBehavior: pedona_magnifier_vars.phoneBehavior,
		loadingLabel: pedona_magnifier_vars.loadingLabel,
	};