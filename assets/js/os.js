$(document).ready(function(){

	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
	
	$(".numeric").on('keydown', function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
	
	//Final de ações
	var id_to_delete	= false;
	var url_post		= false;
	
    // apagando user type
    $("a[id^='delete']").on('click', function(){
        
		id_to_delete  = $(this).attr("rel");
		url_post = $(this).attr("href");
		
		//console.log(url_post);return false;
		
		$('#deleteModal').modal('show');
		$("#btn-confirm-delete").button('reset');
    });

    $("#btn-confirm-delete").on('click', function(){
		$("#btn-confirm-delete").button('loading');

		$.ajax({
			type: "POST",
			url: url_post,
			data: 'id='+id_to_delete,
			success: function(data){
               //console.log(data);
				if(data.retorno == 'erro'){
					alert(data.mensagem);
				}else{
					alert(data.mensagem);
					window.location.reload(true);
				}
				
				$('#deleteModal').modal('hide');
			},
			error: function(){

			},
			dataType: 'json'
		});
	});



	// busca
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
	
	$("input[name='cpf']").mask("999.999.999-99").on('focusout', function (event) {
		var target, cnpj, element;
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;
		cpf = target.value.replace(/\D/g, '');

		if( validarCpf(cpf) != true)
			$(this).val("");
	});
	
	 $("input[name='placa']").mask("aaa-9999");
	   
	$(".select2").select2({
		placeholder: "Select a State"
    });
	
	$("input[name='telefone']").mask("(99) 9999-9999?9").on('focusout', function (event) {
		var target, phone, element;
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;
		phone = target.value.replace(/\D/g, '');
		element = $(target);
		element.unmask();
		if(phone.length > 10) {
			element.mask("(99) 99999-999?9");
		} else {
			element.mask("(99) 9999-9999?9");
		}
    });
	
	// toggle form between inline and normal inputs
    var $buttons = $(".toggle-inputs button");
	var $form = $("form.new_user_form");
	
	$buttons.click(function () {
		var mode = $(this).data("input");
        $buttons.removeClass("active");
        $(this).addClass("active");

		if (mode === "inline") {
			$form.addClass("inline-input");
		} else {
			$form.removeClass("inline-input");
        }
	});
	
	 $('#datetimepicker1, #datetimepicker2, #datetimepicker3').datetimepicker({  language: 'pt-BR',format:'DD/MM/YYYY HH:mm' } );
	 $('.datepicker').datetimepicker({  language: 'pt-BR',format:'DD/MM/YYYY',pickTime:false,pickDate:true } );
	 $('.timepicker').datetimepicker({pickTime:true,pickDate:false,format:'HH:mm' });
	 
	  $("input[name='cnpj']").mask("99.999.999/9999-99").on('focusout', function (event) {
        var target, cnpj, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        cnpj = target.value.replace(/\D/g, '');
    });
	  
	$("input[name='telefone1'], input[name='telefone2']").mask("(99) 9999-9999?9").on('focusout', function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });
	
	$('#autocomplete2').on('focus', function(){
        initialize($(this).attr('id'));
        geolocate();
    });
	
	
	// Chamados #---------------------------------------------	 
	//Deletar OS
	$("a[id^='delete_os_']").on('click', function(event){
		id_to_delete  = $(this).attr("id").replace("delete_os_","");
		$('#deleteModal').modal('show');
		$("#btn-confirm-delete").button('reset');
	});

	$('#deleteModal').on('show.bs.modal', function (e) {
  		$("#modal-title-delete-chamado").html("Chamado: "+id_to_delete);
	});

	$('#deleteModal').on('hide.bs.modal', function (e) {
  		id_to_delete = false;
	});

	//Caso ele clique em SIM, vamos remover o chamado selecionado
	$("#btn-confirm-delete").on('click', function(){

		$("#btn-confirm-delete").button('loading');
		var tmp_id = id_to_delete;

		$.ajax({
			type: "POST",
			url: '/os_ajax/encerrar',
			data: 'id='+id_to_delete,
			success: function(data,textStatus){
				if(data.retorno == 'erro'){
					alert(data.mensagem);
				}else{
					$("#status_corrida_"+tmp_id).html(data.status_novo);
					$("#botao_corrida_"+tmp_id).html(data.botao_novo);
				}

				$('#deleteModal').modal('hide');
				
				window.location.reload(true);
			},
			error: function(){
				alert("Erro ao encerrar, tente novamente mais tarde");

				$('#deleteModal').modal('hide');
			},
			dataType: 'json'
		});

	});


	//iniciando editor tinymce
	tinymce.init({
		selector: "textarea",
		plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		menubar: false
	});
	
	$('.delete_image').on('click', function(){
		$('#delete_img').val('1');
		$('#thumb').remove();
		$(this).remove();
	});
	
	$('.delete_image2').on('click', function(){
		
		var ref = $(this).attr('rel');
		
		$('#delete_img_' + ref).val('1');
		$('#thumb_' + ref).remove();
		$(this).remove();
	});
});