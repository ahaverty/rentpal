<article class="panel panel-primary">
	<div class="panel-heading icon">
		<i class="glyphicon glyphicon-comment"></i>
	</div>
	<div class="panel-heading">

		<div class="panel-actions">

			<!-- Edit Record button -->
			<button class="btn btn-info btn-xs"
				onclick="toggle_edit_article_visibility('record-{{ recordId }}')">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			</button>

			<!-- Delete Record button -->
			<form id="delete-record" action="#" method="post">
				<input type='hidden' name='action' value='deleteRecord'> <input
					type='hidden' name='record_id' value='{{ recordId }}'>
				<button type="submit" class="btn btn-danger btn-xs"
					onclick="return confirm('Are you sure you want to delete this record?');">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
			</form>

		</div>
		<div class="panel-heading-text">
			<h2 class="panel-title">{{ header }}</h2>
		</div>
	</div>
	<div id="record-{{ recordId }}" class="panel-body">

		<div id="record-text" style="display: block;">{{ body }}</div>

		<!-- Edit record form -->
		<form id="edit-record-form" action="home.php" method="post"
			role="form" style="display: none;">
			<input id='action' type='hidden' name='action' value='editRecord' />
			<input type='hidden' name='record_id' value='{{ recordId }}'>
			<div class="form-group">
				<label for="comment">Update record:</label>
				<textarea class="form-control" rows="5" id="record_text"
					name="record_text">{{ body }}</textarea>
				</br>
				<button type="button" class="btn btn-danger btn-md"
					onclick="toggle_edit_article_visibility('record-{{ recordId }}')">
					Cancel <i class="glyphicon glyphicon-remove"></i>
				</button>
				<button type="submit" class="btn btn-success btn-md">
					Update Record <i class="glyphicon glyphicon-ok"></i>
				</button>
			</div>
		</form>

	</div>
</article>