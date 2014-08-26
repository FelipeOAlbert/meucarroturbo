<? if(validation_errors()){ ?>
<div class="alert alert-danger">
	<?php echo validation_errors(); ?>
</div>
<? } ?>

<div class="row form-wrapper">
	
	<!-- left column -->
	<div class="col-md-9 with-sidebar">
		
		<div class="container">
			
			<form class="new_user_form" method="post" enctype="multipart/form-data" >
				
				<div class="col-md-12 field-box">
					<label>Nome:</label>
					<input class="form-control" type="text" name="name" value="<?=set_value('name', @$row['name'], $this->input->post('name')); ?>" />
				</div>
				<div class="col-md-12 field-box">
					<label>Email:</label>
					<input class="form-control" type="text" name="email" value="<?=set_value('email', @$row['email'], $this->input->post('email')); ?>" />
				</div>
				
				<div class="col-md-12 field-box">
					<label>Senha:</label>
					<div class="col-lg-6">
						<input class="form-control" type="password" name="password" style="margin-left:-15px;" />
					</div>
				</div>
				
				<div class="col-md-12 field-box">
					<label>Confirmar Senha:</label>
					<div class="col-lg-6">
						<input class="form-control" type="password" name="confirm_password" style="margin-left:-15px;" />
					</div>
				</div>
				
				<div class="col-md-11 field-box actions">
                    <input type="submit" class="btn btn-primary btn-ls" value="<?=($this->router->method == 'update') ? 'Editar' : 'Cadastrar';?>">
                    <span>OU</span>
                    <input type="reset" id="voltar" value="Cancelar" class="reset">
                </div>
			</form>
		</div>
	</div>

	<!-- side right column -->
	<div class="col-md-3 form-sidebar pull-right"></div>
	
</div>