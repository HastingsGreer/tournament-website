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
		var id2name = {}
		for(var idx = 0; idx < teams.length; idx++){
			id2name[teams[idx].team_id] = teams[idx];
		}
		for(var leagueidx=0; leagueidx< games.leagues.length; leagueidx++){
			
			for(var g=0; g<games.leagues[leagueidx].games.length; g++){
				var game = games.leagues[leagueidx].games[g];
				var t1=game.team1;
				var t1name = id2name[t1].team_name;
				var t2=game.team2;
				var t2name=id2name[t2].team_name;
				var t1score=game.team1Score;
				var t2score=game.team2Score;
				var tr=document.createElement("tr");
				var th=document.createElement("th");
				th.innerHTML="Game: "+game.gameID;
				
				var h= document.createElement("tr");
				var h1n=document.createElement("th");
				h1n.innerHTML= t1name;
				var h1s=document.createElement("th");
				h1s.innerHTML=t1score;
				h.appendChild(h1n);
				h.appendChild(h1s);
				//h1s.appendTo(h1n);
				var a1n =document.createElement("th");
				a1n.innerHTML=t2name;
				var a1s = document.createElement("th");
				a1s.innerHTML=t2score;
				tr.appendChild(th);

				document.getElementById("pool_container").innerHTML=t2name;
				
			}
		}
		

	});

});