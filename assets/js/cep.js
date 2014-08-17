$(document).ready(function(){
	var buscado = false;
	$("#cep").keyup(function(){
		var cep = $(this).val();

		if(cep.length>=8 && buscado!=cep){
			buscado = cep;
			$("#img_cep_load").show();

			$.getJSON( "http://cep.republicavirtual.com.br/web_cep.php?cep="+cep+"&formato=json", function( data ) {

				if(data.resultado==1){
					$("input[name='bairro']").val(data.bairro);
					$("input[name='cidade']").val(data.cidade);
					$("input[name='UF']").val(data.uf);

					$("input[name='endereco']").val(data.tipo_logradouro+' '+data.logradouro);
					//$("input[name='cidade']").val(data.cidade);
				}

				$("#img_cep_load").hide();
				$("input[name='numero']").focus();
			});

		}
	});

});



var placeSearch, autocomplete;
var componentForm = {
		street_number: 'short_name',
		route: 'long_name',
		locality: 'long_name',
		administrative_area_level_1: 'short_name',
		country: 'short_name',
		postal_code: 'short_name'
};

function initialize() {
	autocomplete = new google.maps.places.Autocomplete(
			/** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
			{ types: ['geocode'] });
			google.maps.event.addListener(autocomplete, 'place_changed', function() {
		fillInAddress();
	});
}

function fillInAddress() {

	var place = autocomplete.getPlace();
	console.log(place.geometry.location.lat());
	console.log(place.geometry.location.lng());
	for (var component in componentForm) {
		document.getElementById(component).value = '';
		document.getElementById(component).disabled = false;
	}

	for (var i = 0; i < place.address_components.length; i++) {
		var addressType = place.address_components[i].types[0];
		if (componentForm[addressType]) {
			var val = place.address_components[i][componentForm[addressType]];
			document.getElementById(addressType).value = val;
		}
	}
}


function geolocate() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var geolocation = new google.maps.LatLng(
					position.coords.latitude, position.coords.longitude);
			autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
					geolocation));
		});
	}
}

