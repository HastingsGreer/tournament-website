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
				if(t1score==null){
					t1score="--";
				}
				var t2score=game.team2Score;
				if(t2score==null){
					t2score="--";
				}
				var tr=document.createElement("tr");
				var th=document.createElement("th");
				var stuff = document.createElement('td');
				var gn = "Game: "+game.gameID;
				stuff.innerHTML=gn;
				th.appendChild(stuff);
				var h= document.createElement("tr");
				var h1n=document.createElement("th");
				h1n.innerHTML= t1name;
				var h1s=document.createElement("th");
				h1s.innerHTML=t1score;
				h.appendChild(h1n);
				h.appendChild(h1s);
				th.appendChild(h);
				//h1s.appendTo(h1n);
				var a = document.createElement("tr");
				var a1n =document.createElement("th");
				a1n.innerHTML=t2name;
				var a1s = document.createElement("th");
				a1s.innerHTML=t2score;
				a.appendChild(a1n);
				a.appendChild(a1s);
				th.append(a);
				tr.appendChild(th);
				var brk = document.createElement("br");
				tr.appendChild(brk);

				$("#pool_container").append(tr);
				
			}
		}
		

	});

});