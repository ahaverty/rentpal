<article class="panel panel-primary">
	<div class="panel-heading icon">
		<i class="glyphicon glyphicon-comment"></i>
	</div>
	<div class="panel-heading">
		<h2 class="panel-title">{{ header }}</h2>
		
	</div>
	<div class="panel-body">
		{{ body }}
		
		<div></div>
	
		<form action="#" method="post">
			<input type='hidden' name='action' value='delete-record'>
			<input type='hidden' name='record-id' value='{{ recordId }}'>
			<button type="submit" class="btn btn-danger btn-xs">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			</button>
		</form>
		
		<form action="#" method="post">
			<input type='hidden' name='action' value='edit-record'>
			<input type='hidden' name='record-id' value='{{ recordId }}'>
			<button type="submit" class="btn btn-info btn-xs">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			</button>
		</form>
		
	</div>
</article>