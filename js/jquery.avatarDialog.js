/*
 * Desarrollado por Shino del equipo Avatar
 */

(function($) {
	var constantes = {
		claseOverlay: 'avatarDialogOverlay',
		claseBox: 'avatarDialogBox',
		claseBoxTitleBar: 'avatarDialogBoxTitleBar',
		claseBoxTitle: 'avatarDialogBoxTitle',
		claseBoxTitleBarClose: 'avatarDialogBoxTitleBarClose',
		claseBoxContent: 'avatarDialogBoxContent',
		boxContentPadding: 20
	};
	
	var overlay = null;
	
	var metodos = {
		init: function(opcionesUser) {
			var opcionesDefault = {
				autoOpen: false,
				title: '',
				width: Math.round( $(window).width()/3 ) + 'px',
				height: 'auto',
				maxWidth: '100%',
				maxHeight: '100%'
			};
			
			var opciones = $.extend(opcionesDefault, opcionesUser);
			
			return this.each(function() {
				var box = $("<div>", { 'class': constantes.claseBox });
				var boxTitleBar = $("<div>", { 'class': constantes.claseBoxTitleBar });
				var boxTitle = $("<div>", { 'class': constantes.claseBoxTitle });
				var boxTitleBarClose = $("<div>", { 'class': constantes.claseBoxTitleBarClose });
				var boxContent = $("<div>", { 'class': constantes.claseBoxContent });
				var content = $(this).clone(true);
				
				if (overlay == null) {
					overlay = $("<div>", { 'class': constantes.claseOverlay });
					overlay.on('click', function() {
						metodos.close.apply(this, arguments);
					});
					$("body").append(overlay);
				}
				
				boxTitle.html(opciones.title);
				boxTitleBarClose.on('click', function() {
					metodos.close.apply(this, arguments);
				});
				boxTitleBar.append(boxTitle);
				boxTitleBar.append(boxTitleBarClose);
				box.append(boxTitleBar);
				
				$(this).remove();
				content.show();
				content.width(opciones.width);
				content.height(opciones.height);
				content.css('max-width', opciones.maxWidth);
				content.css('max-height', opciones.maxHeight);
				boxContent.append(content);
				boxContent.css('padding', constantes.boxContentPadding);
				box.width(content.width() + 2*constantes.boxContentPadding);
				box.append(boxContent);
				
				$("body").append(box);
				
				$(document).on('keyup', function(e) {
					if (overlay.is(':visible') && e.keyCode == 27) {
						metodos.close.apply(this, arguments);
					}
				});
				
				if (opciones.autoOpen) {
					metodos.open.apply(content, arguments);
				}
			});
		},
		open: function() {
			var box = $(this).closest("." + constantes.claseBox);
			var posTop = Math.round( $(window).height()/2 - box.height()/2 ) + 'px';
			var posLeft = Math.round( $(window).width()/2 - box.width()/2 ) + 'px';
			
			if ( $(window).height() > box.height() && $(window).width() > box.width()) {
				box.css('position', 'fixed');
			}
			else {
				box.css('position', 'absolute');
			}
			
			overlay.show();
			box.css('top', posTop);
			box.css('left', posLeft);
			box.show('clip', { duration: 300 });
			
			$.event.trigger({
				type: 'avatarDialogOpen',
				time: new Date()
			});
		},
		close: function() {
			var box = $(document).find("." + constantes.claseBox);
			box.hide('clip', { duration: 300 });
			overlay.hide();
			
			$.event.trigger({
				type: 'avatarDialogClose',
				time: new Date()
			});
		}
	};
	
	$.fn.avatarDialog = function(accion) {
		if (metodos[accion]) {
			return metodos[accion].apply(this, Array.prototype.slice.call(arguments, 1));
		}
		else if ( typeof accion === 'object' || !accion ) {
			return metodos.init.apply(this, arguments);
		} 
		else {
			$.error( 'La función ' + accion + ' no existe en jQuery.avatarDialog' );
		}
	};
})(jQuery);