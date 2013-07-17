$ = @jQuery

$ -> 
	$('textarea[name="description"]:first')
		.closest('tr')
		.remove()