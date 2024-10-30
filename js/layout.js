(function($){
	var initLayout = function() {
		$( '#bgcolorSelector' ).ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#bgcolorSelector div').css('backgroundColor', '#' + hex);
				$('#template_bgcolor' ).val('#' + hex);
			}
		});
		
		$('#ftcolorSelector').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#ftcolorSelector div').css('backgroundColor', '#' + hex);
				$('#template_ftcolor' ).val('#' + hex);
			}
		});
		
		$('#hvcolorSelector').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#hvcolorSelector div').css('backgroundColor', '#' + hex);
				$('#template_hvcolor' ).val('#' + hex);
			}
		});
		$( '#fccolorSelector' ).ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#fccolorSelector div').css('backgroundColor', '#' + hex);
				$('#template_fccolor' ).val('#' + hex);
			}
		});
		
		$('#btnbgcolorSelector').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#btnbgcolorSelector div').css('backgroundColor', '#' + hex);
				$('#template_btnbgcolor' ).val('#' + hex);
			}
		});
		
		$('#btncolorSelector').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#btncolorSelector div').css('backgroundColor', '#' + hex);
				$('#template_btncolor' ).val('#' + hex);
			}
		});
	};
	
	EYE.register(initLayout, 'init');
})(jQuery)