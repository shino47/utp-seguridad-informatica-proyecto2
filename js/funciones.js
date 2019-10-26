var loaderOverlay = $("<div>", { 'id': 'loaderOverlay' });
var loaderBox = $("<div>", { 'id': 'loaderBox' });

loaderBox.html("Cargando. Por favor espere...");

$(document).ready(function() {
	$("body").append(loaderOverlay);
	$("body").append(loaderBox);
	
	$("#cuerpo").css("padding-bottom", $("#pie").outerHeight());
	
	$("#contenido").children().hide();
	$("#contenido").children(":first").show();
	$("#menuLat").find("a:first").addClass("sltd").show();
	$("#menuLat").on('click', 'a', function() {
		if( !$(this).hasClass("sltd") ) {
			mostrar(this);
		}
		return false; 
	});
	
	$("input, textarea").tooltipster({
		trigger: 'custom',
		onlyOne: false,
		position: 'right',
		theme: 'seg'
	});

	$("#errorDialog").avatarDialog({
		autoOpen: false, 
		title: '<span>Error en la solicitud</span>',
		width: '550px' 
	});
	$("#errorDialogClose").on("click", function() {
		$("#errorDialog").avatarDialog("close");
	});
	
	$("select[name='tipoInput']").each(setDescifradoInput);
	$("select[name='tipoInput']").on("change", setDescifradoInput);
	
	$("form.cifrado").each(function() {
		var llave = $(this).find("input[name='llave']");
		var size = llave.attr("size");
		llave.attr("maxlength", size);
		$(this).validate({
			errorPlacement: function(error, element) {
				$(element).tooltipster('update', $(error).text());
				$(element).tooltipster('show');
			},
			success: function(label, element) {
				$(element).tooltipster('hide');
			},
			rules: {
				texto: {
					required: true
				},
				llave: {
					required: true,
					minlength: size
				}
			},
			messages: {
				texto: {
					required: 'Debes ingresar el texto a cifrar'
				},
				llave: {
					required: 'Debes ingresar una llave',
					minlength: 'La llave debe tener un mínimo de ' + size + ' caracteres.'
				}
			},
			submitHandler: function(form) {
				var resultado = $(form).siblings("form.resultado");
				$(form).ajaxSubmit({
					async: true,
					dataType: "json",
					beforeSend: function() {
						resultado.hide();
						loaderShow();
					},
					success: function(response) {
						if (response.code == 0 && response.data != null && response.data != false) {
							var texto = response.data.replace(/\u0000/g, "").replace(/\u0004/g, "");
							resultado.find("textarea[name='data']").val(texto);
							resultado.find("input[name='tipo']").val(response.tipo);
							resultado.find("input[name='llave']").val(response.llave);
							resultado.slideDown();
						}
						loaderHide();
					},
					error: function() {
						loaderHide();
					}
				});
				return false;
			}
		});
	});
	
	$("form.descifrado").each(function() {
		var llave = $(this).find("input[name='llave']");
		var size = llave.attr("size");
		llave.attr("maxlength", size);
		$(this).validate({
			errorPlacement: function(error, element) {
				$(element).tooltipster('update', $(error).text());
				$(element).tooltipster('show');
			},
			success: function(label, element) {
				$(element).tooltipster('hide');
			},
			rules: {
				texto: {
					required: {
						depends: function(element) {
							return $(element).closest("form").find("select[name='tipoInput']").val() == 'base64' ? true : false;
						}
					}
				},
				binario: {
					required: {
						depends: function(element) {
							return $(element).closest("form").find("select[name='tipoInput']").val() == 'binario' ? true : false;
						}
					}
				},
				llave: {
					required: true,
					minlength: size
				}
			},
			messages: {
				texto: {
					required: 'Debes ingresar el texto a cifrar'
				},
				binario: {
					required: 'Debes seleccionar un archivo binario'
				},
				llave: {
					required: 'Debes ingresar una llave',
					minlength: 'La llave debe tener un mínimo de ' + size + ' caracteres.'
				}
			},
			submitHandler: function(form) {
				var resultado = $(form).siblings("form.resultado");
				$(form).ajaxSubmit({
					async: true,
					dataType: "json",
					beforeSend: function() {
						resultado.hide();
						loaderShow();
					},
					success: function(response) {
						if (response.code == 0 && response.data != null && response.data != false) {
							var texto = response.data.replace(/\u0000/g, "").replace(/\u0004/g, "");
							resultado.find("textarea[name='data']").val(texto);
							resultado.slideDown();
						}
						else {
							$("#errorDialog").avatarDialog("open");
						}
						loaderHide();
					},
					error: function() {
						$("#errorDialog").avatarDialog("open");
						loaderHide();
					}
				});
				return false;
			}
		});
	});
	
	$("input.download-key").on('click', function() {
		var form = $(this).closest("form");
		form.find("input[name='descarga']").val('llave');
		form.submit();
	});
	$("input.download-bin").on('click', function() {
		var form = $(this).closest("form");
		form.find("input[name='descarga']").val('binario');
		form.submit();
	});
});

function mostrar(el) {
	$("input, textarea").tooltipster("hide");
	var show = $(el).attr("href");
	$(el).closest("#menuLat").find("a.sltd").removeClass("sltd");
	$(el).addClass("sltd");
	$("#contenido").children().hide();
	$("html, body").animate({ scrollTop: 0 }, 400);
	$(show).find("form").each(function() {
		this.reset();
		$(this).find("select[name='tipoInput']").each(setDescifradoInput);
	});
	$(".resultado").hide();
	$(show).fadeIn();
}

function setDescifradoInput() {
	$("input, textarea").tooltipster("hide");
	var form = $(this).closest("form");
	var show = $(this).val();
	form.find("p.input").hide();
	form.find("p."+show).slideDown();
}

function loaderShow() {
	var posTop = Math.round( $(window).height()/2 - loaderBox.outerHeight()/2 ) + 'px';
	var posLeft = Math.round( $(window).width()/2 - loaderBox.outerWidth()/2 ) + 'px';
	
	loaderOverlay.show();
	loaderBox.css('top', posTop);
	loaderBox.css('left', posLeft);
	loaderBox.show();
}

function loaderHide() {
	loaderOverlay.hide();
	loaderBox.hide();
}