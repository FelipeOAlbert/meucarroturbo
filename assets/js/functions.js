$(document).ready(function(){
    
    $('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
    
    $('#buscar').click(function (e) {
		var url 	= $('#frmBusca').attr('action');
		var busca 	= $.base64.encode($("#frmBusca" ).serialize());
		var url 	= url + "/" + busca;
		
		window.location = url;
		
		return false;
	});
	
	$('#limpa_busca').click(function (e){
		var url 		= $('#frmBusca').attr('action');
		window.location = url;
		
		return false;
	});

});