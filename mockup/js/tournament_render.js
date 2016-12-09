$(document).ready(function(){
	var url=String(window.location).split('?');
	var id_string=url[1];
	if(id_string==""){
		window.location="tournament_view.html";
	}
	var link = 'getTournament.php?'+id_string;
	var result = $.getJSON(link, function(json){
		var name=json.name;
		var numteams=json.numteams;
		var numleagues=json.numleagues;
		var teams = json.teams;
		var games = json.games;
		alert(games.length);
		for(var leagueidx=0; leagueidx< games.leagues.length; leagueidx++){
			alert(leagueidx);
			for(var g=0; g<games.leagues[leagueidx].games.length; g++){
				alert(g);
				alert(games.leagues[leagueidx].games[g].id);
			}
		}
		

	});

});