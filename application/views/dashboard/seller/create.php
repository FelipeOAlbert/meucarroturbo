<? $this->load->view('dashboard/template/header');?>
<body>
	<? $this->load->view('dashboard/template/navbar');?>
	<? $this->load->view('dashboard/template/sidebar');?>
	
	<!-- main container -->
    <div class="content">
        <div id="pad-wrapper" class="new-user">
            <div class="row">
                <div class="col-md-12">
                    <h3>Novo vendedor</h3>
                </div>
            </div>
			<br /><br />
			<? $this->load->view('dashboard/'.$this->router->class.'/_form');?>
        </div>
    </div>
    <!-- end main container -->
<? $this->load->view('dashboard/template/footer');?>