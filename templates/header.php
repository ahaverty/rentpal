<?php include_once 'html_doctype_and_head.php'; ?>
<body>

	<div class="container-fluid">
		<div class='navbar navbar-fixed-top navbar-inverse'>
			<div class='navbar-inner'>
				<div class='container-fluid'>
					<a class='brand'><?php echo $appName;?> </a>
					<div class="navbar-form pull-right">
						<div class="navbar-form pull-left" style="padding:10px;"> 
							<?php echo "<font color='red'>" . $authenticationErrorMessage . "</font>"; ?>
						</div>
						<div class="navbar-form pull-right"> <?php echo $loginBox; ?> </div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row-fluid" style="margin-top: 20px">