<?php include_once 'html_doctype_and_head.php'; ?>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container">

			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#navbar-brand">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo $this->baseUrl ?>"><?php echo $this->appName;?></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-brand">
				<ul class="nav navbar-nav">
					<?php echo $this->navigationLinks; ?>
				</ul>
				<ul class='nav navbar-nav navbar-right'>
					<li class='dropdown'>
						<?php echo $this->userOptions; ?>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<?php echo $this->pageAlert;?>