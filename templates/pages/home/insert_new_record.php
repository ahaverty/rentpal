<h1>Add & View Records</h1>
<p>Add new records to track your rental</p>					

<form role="new-record-form"action="home.php" method="post" role="form">
	<input id='action' type='hidden' name='action' value='insertNewRecord' />	
	<div class="form-group">
		<label for="comment">Comment:</label>
		<textarea class="form-control" rows="5" id="record_text" name="record_text" ></textarea>
		</br>
		<button type="submit" class="btn btn-success btn-lg">Add Record <i class="glyphicon glyphicon-plus-sign"></i></button>
	</div>
</form>