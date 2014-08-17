<? $this->load->view('dashboard/template/header');?>

<body>
	
	<? $this->load->view('dashboard/template/navbar');?>
	<? $this->load->view('dashboard/template/sidebar');?>
	
	<!-- main container -->
    <div class="content">
        
		<div id="pad-wrapper">
			
			<? if($this->session->userdata('mensagem')){
				
				$mensagem  = $this->session->userdata('mensagem');
				$class 		= 'erro';
				
				$this->session->unset_userdata('mensagem');
				
				if($mensagem['retorno'] == 1 || $mensagem['retorno'] == 'sucess'){
					$class = 'alert alert-success';
				}
				?>
				
				<div class="<?=$class;?>">
					<p><?=$mensagem['mensagem'];?></p>
				</div>
			
			<? } ?>
			
            <div class="table-products">
				<h2>Selecione o menu ao lado para navegar</h2>
                <br />
			</div>
			
            <!-- end table sample -->
        </div>
    </div>

<? $this->load->view('dashboard/template/footer'); ?>