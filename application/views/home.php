<!doctype html>
<html>
<head>
	<?php
		include_once "incl.php";
		include_once "script.php";
	?>
</head>

<body>
	<div id="navigation">
		<div class="container-fluid">
			<a href="<?php echo base_url(); ?>index.php/home" id="brand">Technokal</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
			<ul class='main-nav'>
				<?php
                	if($this->session->userdata('id_level')=='01'){
                    		echo $this->load->view('main_nav');
                	}elseif($this->session->userdata('id_level')=='02'){
                    	echo $this->load->view('admin_nav');
                	}else{
                    	echo $this->load->view('user_nav');
                	}
                	?>            
		       </ul>
			<div class="user">
				<ul class="icon-nav">

					<li class="dropdown sett">
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-cog"></i></a>
						<ul class="dropdown-menu pull-right theme-settings">
							<li>
								<span>Layout-width</span>
								<div class="version-toggle">
									<a href="#" class='set-fixed'>Fixed</a>
									<a href="#" class="active set-fluid">Fluid</a>
								</div>
							</li>
							<li>
								<span>Topbar</span>
								<div class="topbar-toggle">
									<a href="#" class='set-topbar-fixed'>Fixed</a>
									<a href="#" class="active set-topbar-default">Default</a>
								</div>
							</li>
							<li>
								<span>Sidebar</span>
								<div class="sidebar-toggle">
									<a href="#" class='set-sidebar-fixed'>Fixed</a>
									<a href="#" class="active set-sidebar-default">Default</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
				<div class="dropdown">
					<?php include_once "logout.php"; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid nav-hidden" id="content">
		<div id="left">

			<?php include_once "nav_super.php" ?>
        </div>
		<div id="main">
            <div class="container-fluid">
                <?php include_once "breadcumb.php"; ?>
                <?php echo $content; ?>
            </div>
        </div>
	</body>

	</html>

