<article class="panel panel-primary">
	<div class="panel-heading icon">
		<i class="glyphicon glyphicon-comment"></i>
	</div>
	<div class="panel-heading">
	
		<div class="panel-actions">	
			<!-- Edit Record button -->
			<form action="#" method="post">
				<input type='hidden' name='action' value='edit-record'>
				<input type='hidden' name='record_id' value='{{ recordId }}'>
				<button type="submit" class="btn btn-info btn-xs">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</button>
			</form>
			<!-- Delete Record button -->
			<form id="delete-record" action="#" method="post">
				<input type='hidden' name='action' value='deleteRecord'>
				<input type='hidden' name='record_id' value='{{ recordId }}'>
				<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this record?');">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			</form>
		</div>
		<div class="panel-heading-text">
			<h2 class="panel-title">{{ header }}</h2>
		</div>
	</div>
	<div class="panel-body">
		{{ body }}
	</div>
</article>