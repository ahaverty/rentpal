function toggle_edit_article_visibility(id) {
	var children = document.getElementById(id).children;

	for (var i = 0; i < children.length; i++) {
		if (children[i].style.display == 'block') {
			children[i].style.display = 'none';
		} else {
			children[i].style.display = 'block';
		}
	}
}