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
		var bracket = json.games.bracket;
		alert(bracket);
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
				var gamebox = document.createElement("table");
				gamebox.className="gamebox";
				var tr=document.createElement("tr");
				var th=document.createElement("th");
				var stuff = document.createElement('td');
				stuff.className="gamenum";
				var gn = "Game: "+game.gameID;
				stuff.innerHTML=gn;
				th.appendChild(stuff);
				var h= document.createElement("tr");
				var h1n=document.createElement("th");
				h1n.className="homename";
				h1n.innerHTML= t1name;
				var h1s=document.createElement("th");
				h1s.className="hs";
				h1s.innerHTML=t1score;
				h.appendChild(h1n);
				h.appendChild(h1s);
				th.appendChild(h);
				//h1s.appendTo(h1n);
				var a = document.createElement("tr");
				var a1n =document.createElement("th");
				a1n.className="awayname";
				a1n.innerHTML=t2name;
				var a1s = document.createElement("th");
				a1s.innerHTML=t2score;
				a1s.className="as"
				a.appendChild(a1n);
				a.appendChild(a1s);
				th.appendChild(a);
				tr.appendChild(th);
				var brk = document.createElement("br");
				tr.appendChild(brk);

				$("#pool_container").append(tr);
				
			}
		}

		for(var i=0; i< bracket.length; i++){
			var game=bracket[i];
			var t1=id2name[game.team1].team_name;
			alert(t1);
			var t1seed=id2name[bracket[i].team1].seed;
			var t1s=bracket[i].team1Score;
			var t2=id2name[bracket[i].team2].team_name;
			var t2s=bracket[i].team2Score;
			var t2seed=id2name[bracket[i].team2].seed;
			var bracketpos = bracket[i].bracket_position;
			if(bracketpos==7){
				$("#7home").innerHTML=t1seed + " " + t1;
				$("#7away").innerHTML=t2seed+ " " + t2;
				$("7hscore").innerHTML=t1s;
				$("#7ascore").innerHTML=t2s;
			}


			
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
				var gamebox = document.createElement("table");
				gamebox.className="gamebox";
				var tr=document.createElement("tr");
				var th=document.createElement("th");
				var stuff = document.createElement('td');
				stuff.className="gamenum";
				var gn = "Game: "+game.gameID;
				stuff.innerHTML=gn;
				th.appendChild(stuff);
				var h= document.createElement("tr");
				var h1n=document.createElement("th");
				h1n.className="homename";
				h1n.innerHTML= t1name;
				var h1s=document.createElement("th");
				h1s.className="hs";
				h1s.innerHTML=t1score;
				h.appendChild(h1n);
				h.appendChild(h1s);
				th.appendChild(h);
				//h1s.appendTo(h1n);
				var a = document.createElement("tr");
				var a1n =document.createElement("th");
				a1n.className="awayname";
				a1n.innerHTML=t2name;
				var a1s = document.createElement("th");
				a1s.innerHTML=t2score;
				a1s.className="as"
				a.appendChild(a1n);
				a.appendChild(a1s);
				th.appendChild(a);
				tr.appendChild(th);
				var brk = document.createElement("br");
				tr.appendChild(brk);

				$("#pool_container").append(tr);
				
			}
		}
		

	});

});