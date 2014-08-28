<html>
<head>
    <title>Teste de Login Facebook</title>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
 
<script>
    FB.init({
        appId  : '522018417928844',
        status: true, cookie: false, xfbml: false, oauth: true
    });
 
    function statusFacebook() {
        FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            
            
            var uid = response.authResponse.userID;
			var token = response.authResponse.accessToken;
            
            //console.log(uid, token);
            
            FB.api('/me', function(response) {
                if(response.email.length>0){
                    VerificaCadastroFB(response.name, token, uid, response.email);
                }
            });
            
            //window.location.replace("<?=site_url('home/login_fb')?>");
        } else if (response.status === 'not_authorized') {
                loginFacebook(); // nao autorizado, solicitar login
        } else {
                loginFacebook(); // nao autorizado, solicitar login
        }})
    }
 
    function loginFacebook() {
        FB.login(function(response) {
                if (response.authResponse) {
                    window.location.replace("<?=site_url();?>");
                }
        }, {scope: 'email,publish_stream,user_photos,friends_about_me' });
    }
 
    function VerificaCadastroFB(username, token, userid, email)
    {
		var arr = { name: username, token: token, id:userid, email: email };
        
		$.ajax({
			type: 'POST',
			dataType: 'json',
			data: arr,
			url: '/home/login_fb',
			async: true,
			success: function(response) {
                
				if( response.status=="exists"){
					
                    
                    alert(response.message);
                    
					//$.fn.showSection("5");
					//$("#login").hide();
					//$("#email").val(email);
					//$("#password").focus();
					//$("#login").fadeIn();

					//$.fn.showError(response.message, "div-erro-login");

				}else if( response.status=='error' ){
					alert(response.message);
				}else if( response.status == 'success' ){
					alert(response.message);
				}
			},
			error: function(){
				alert("Encontramos algum erro, tente novamente");
				$.fn.showSection("5");
			}
		});
	}
    
</script>
</head>
 
<body>
<a href="#" onClick="statusFacebook();">Continuar na APP</a>
 
</body>
</html>