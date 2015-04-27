<?php include_once 'html_doctype_and_head.php'; ?>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container">

			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#navbar-brand-centered">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo $baseUrl ?>"><?php echo $appName;?></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-brand">
				<ul class="nav navbar-nav">
					<li><a href="home.php">Home</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php echo $userStatus; ?>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Profile <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="index.php?action=logout">Logout</a></li>
						</ul></li>
				</ul>
			</div>
		</div>
	</nav>