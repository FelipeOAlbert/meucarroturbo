<div id="sidebar-nav">
	<ul id="dashboard-menu">
		<li>
			<a href="javascript:" class="dropdown-toggle"> <i class="icon-tasks"></i> <span>Categorias</span>
				<i class="icon-chevron-down"></i>
			</a>
			<ul class="submenu">
				<li>
					<a href="<?=site_url('category/index');?>">Listagem</a>
				</li>
				<li>
					<a href="<?=site_url('category/create');?>">Adicionar</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="<?=site_url("user/index")?>" class="dropdown-toggle"> <i class="icon-group"></i> <span>Usuários</span>
				<i class="icon-chevron-down"></i>
			</a>
			<ul class="submenu">
				<li>
					<a href="<?=site_url('user/index');?>">Listagem</a>
				</li>
				<li>
					<a href="<?=site_url('user/create');?>">Adicionar</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:" class="dropdown-toggle"> <i class="icon-group"></i> <span>Vendedores</span>
				<i class="icon-chevron-down"></i>
			</a>
			<ul class="submenu">
				<li>
					<a href="<?=site_url('seller/index');?>">Listagem</a>
				</li>
				<li>
					<a href="<?=site_url('seller/create');?>">Adicionar</a>
				</li>
			</ul>
		</li>
	</ul>
</div>