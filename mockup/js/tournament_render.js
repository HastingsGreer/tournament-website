$(document).ready(function(){
	var url=String(window.location).split('?');
	var id_string=url[1];
	if(id_string==""){
		window.location="tournament_view.html";
	}
	var link = 'getTournament.php?'+id_string;
	var result = $.getJSON(link, function(json){
		alert(json);
	});

});