<hr>

<div>
<h3>Search existing records</h3>
	<form method="get" >
		<div class="input-group">
			<input type="hidden" name="action" value="search">
			<input type="text" required name="query" class="form-control"
				placeholder="Search for records containing..."> <span
				class="input-group-btn">
				<button class="btn btn-default" type="submit">Search</button>
			</span>
		</div>
	</form>
</div>

<hr>

<div class="timeline">
	<!-- Line component -->
	<div class="line text-muted"></div>
	<?php echo $articlesHtml; ?>
</div>