<!DOCTYPE html>
<html>
<head>
	<title>Admin Meu Carro Turbo | Login</title>
	<base href="<?=base_url();?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/dist/css/bootstrap.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap/bootstrap-overrides.css');?>" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/compiled/layout.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/compiled/elements.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/compiled/icons.css');?>" />

    <!--libraries -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/lib/font-awesome.css');?>" />


    <!-- this page specific styles -->
	<link rel="stylesheet" href="<?=base_url('assets/css/compiled/signin.css');?>" type="text/css" media="screen" />

    <!-- open sans font -->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" />

    <!-- nosso css -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/compiled/sonic.css');?>" />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
	<script src="<?=base_url('assets/js/jquery.js');?>"></script>

</head>

<body class="login-bg">

    <div class="login-wrapper">
        <h3>Admin</h3>
		<br />
		<br />

        <form method="post" id="form">

            <div class="box">

                <div class="content-wrap">

                    <h6>Login</h6>

                    <input class="form-control" name="login" type="text" placeholder="E-mail">
					<input class="form-control" name="password" type="password" placeholder="Senha">
                    
					<div class="remember" style="color: red"><?=$erro;?></div>
					
                    <a class="btn-glow primary login" id="login" href="#">Entrar</a>
                </div>
				
            </div>
			
        </form>

    </div>

	<!-- scripts -->
    <script src="<?=base_url('assets/dist/js/bootstrap.js');?>"></script>
    <script src="<?=base_url('assets/js/theme.js');?>"></script>
    

    <!-- pre load bg imgs -->
    <script type="text/javascript">
        $(function () {

            $("#login").on("click", function(event){
                event.preventDefault();
                $("#form").submit();
                return false;
            });
        });
    </script>

</body>
</html>