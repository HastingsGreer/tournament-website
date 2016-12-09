$(document).ready(function(){
	var url=window.location.split('?');
	var id_string=url[1];
	if(id_string==""){
		window.location="tournament_view.html";
	}
	var link = 'gameTournament.php?id='+id_string;
	alert(link);
	//$.getJSON('gameTournament')

});