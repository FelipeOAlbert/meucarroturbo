<header role="banner" class="navbar navbar-inverse">
	<div class="navbar-header pull-left">
		<button id="menu-toggler" data-toggle="collapse" type="button" class="navbar-toggle">
			<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
			<span class="icon-bar"></span> <span class="icon-bar"></span>
		</button>
		<a href="<?=site_url("dashboard");?>" class="navbar-brand">
			<p>Admin Meu Carro Turbo</p>
		</a>
	</div>
	<ul class="nav navbar-nav pull-right">
		<li class="settings hidden-xs hidden-sm">
			<a role="button" href="<?=site_url("dashboard/personal_info");?>"> <i class="icon-cog"></i></a>
		</li>
		<li class="settings hidden-xs hidden-sm">
			<a role="button" href="<?=site_url("dashboard/logout");?>"> <i class="icon-share-alt"></i> </a>
		</li>
	</ul>
</header>

<!-- DELETAR TIPO DE USUÁRIO -->
<div  id="deleteModal"  aria-hidden="false" aria-labelledby="deleteModalLabel" role="dialog" tabindex="-1" class="modal fade in">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id='modal-title-delete-chamado'>Inativar Registro</h4>
      </div>
      <div class="modal-body" id="modal-body-delete-chamado">
        <p>IMPORTANTE: Ao apagar, você não poderá mais editar ou reativar</p>
        <p>Tem certeza disto?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
        <button type="button" class="btn btn-primary" id='btn-confirm-delete-usertype' data-loading-text="Apagando...">Tenho Certeza</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="valoresModal" tabindex="-1" role="dialog" aria-labelledby="valoresModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">


    </div>
  </div>
</div>
