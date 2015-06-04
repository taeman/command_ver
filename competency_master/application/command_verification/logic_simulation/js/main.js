function linkPage(link_page, show_id){
	var show_html = "#"+show_id;
	$.get(link_page, function(data) {
	  $(show_html).html(data);
	  //alert('Load was performed.');
	});
}

function linkMainPage(link_page){
	var show_html = "main_content";
	linkPage(link_page, show_html);
}
