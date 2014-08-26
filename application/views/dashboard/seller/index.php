<? $this->load->view('dashboard/template/header');?>

<body>

	<? $this->load->view('dashboard/template/navbar');?>
	<? $this->load->view('dashboard/template/sidebar');?>

	<!-- main container -->
    <div class="content">

        <div id="pad-wrapper" class="users-list">
			
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
            
			<div class="row">
                <h2 class="col-md-10 col-sm-10 col-xs-10">Vendedores</h2> 
                <div class="col-md-2 col-sm-2 col-xs-2">
                     <a href="<?=site_url($this->router->class."/create");?>" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Adicionar</a>
                </div>
            </div>
			<br />
			
            <?php if( $list!=false ){ ?>
            <!-- Users table -->
            <div class="row">
                <div class="col-md-12">
				  
				  <div class="panel panel-default">
					
					<?  $metodo = ($this->uri->segment(2) == NULL) ? 'index' : $this->uri->segment(2); ?>
					
                    <table class="table table-striped table-hover table-bordered table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th class="col-md-1">#</th>
                                <th class="col-md-2">Nome</th>
								<th class="col-md-2">Email</th>
								<th class="col-md-2">Status</th> 
                                <th class="col-md-2">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
							<tr>
								<form role="form" method="get" id="frmBusca" action="<?=site_url($this->uri->segment(1).'/'.$metodo.'/1');?>">
									<td>
										<input type="text" name="id" value="<?=@$search['id'];?>" placeholder="Filtrar por ID" class="form-control numeric" />
									</td>
									<td>
										<input type="text" name="name" value="<?=@$search['name'];?>" placeholder="Filtrar por Nome" class="form-control" />
									</td>
									<td>
										<input type="text" name="email" value="<?=@$search['email'];?>" placeholder="Filtrar por Email" class="form-control" />
									</td>
									<td>
										<select name="status_id" class="form-control" id="onChange">
											<option value="">Filtrar por Status</option>
											<?=select_status(@$search['status_id']);?>
										</select>
									</td>
								
									<td>
										<input type="submit" name="btSubmit" value="Filtrar" class="btn btn-primary" id="buscar" />
										<input type="button" name="btClear" value="Limpar" class="btn btn-info" id="limpa_busca" />
									</td>
								</form>
							</tr>
							
							<? foreach($list as $row){ ?>
							   <!-- row -->
							   <tr class="first">
									<td>
									   <?=$row['id'];?>
									</td>
									<td>
									   <?=$row['name'];?>
									</td>
									<td>
									   <?=$row['email'];?>
									</td>
									<td>
									   <?=status2txt($row['status_id']);?>
									</td>
									<td>
										<a href="<?=site_url("user/update/".$row['id']);?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Editar</a>
										
										<? if($row['status_id'] == 1){ ?>
											<a href="<?=site_url('user/delete/'.$row['id']);?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Inativar</a>
										<? }else{ ?>
											<a href="<?=site_url('user/active/'.$row['id']);?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Ativar</a>
										<? } ?>
									</td>
							   </tr>
						   <?php }?>
                        </tbody>
                    </table>
					</div>
                </div>
            </div>

            <?php }else{ ?>
               <p> Nenhum vendedor cadastrado, clique no botão acima para adicionar.</p>
            <?php } ?>

            <?=$paginacao?>

            <!-- end users table -->
        </div>
    </div>
    <!-- end main container -->

<? $this->load->view('dashboard/template/footer');?>