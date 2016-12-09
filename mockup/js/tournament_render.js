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
			if(game.team1!=0){
				var t1=id2name[game.team1].team_name;
				var t1seed=id2name[game.team1].seed;
				var t1s=bracket[i].team1Score;
			}else{
				var t1=" ";
				var t1seed=" ";
				var t1s=" ";
			}
			if(game.team2 !=0){
				var t2=id2name[game.team2].team_name;
				var t2s=bracket[i].team2Score;
				var t2seed=id2name[game.team2].seed;
			}else{
				var t2=" ";
				var t2s=" ";
				var t2seed=" ";
			}

			var bracketpos = game.bracket_position;
			alert(bracketpos);
			if(bracketpos==0){

				document.getElementById("0home").innerHTML=t1seed + " " + t1;
				document.getElementById("0away").innerHTML=t2seed+ " " + t2;
				document.getElementById("0hscore").innerHTML=t1s;
				document.getElementById("0ascore").innerHTML=t2s;
			}else if(bracketpos==1){

				document.getElementById("1home").innerHTML=t1seed + " " + t1;
				document.getElementById("1away").innerHTML=t2seed+ " " + t2;
				document.getElementById("1hscore").innerHTML=t1s;
				document.getElementById("1ascore").innerHTML=t2s;
			}else if(bracketpos==2){
				document.getElementById("2home").innerHTML=t1seed + " " + t1;
				document.getElementById("2away").innerHTML=t2seed+ " " + t2;
				document.getElementById("2hscore").innerHTML=t1s;
				document.getElementById("2ascore").innerHTML=t2s;
			}else if(bracketpos==3){

				document.getElementById("3home").innerHTML=t1seed + " " + t1;
				document.getElementById("3away").innerHTML=t2seed+ " " + t2;
				document.getElementById("3hscore").innerHTML=t1s;
				document.getElementById("3ascore").innerHTML=t2s;
			}else if(bracketpos==4){
				document.getElementById("4home").innerHTML=t1seed + " " + t1;
				document.getElementById("4away").innerHTML=t2seed+ " " + t2;
				document.getElementById("4hscore").innerHTML=t1s;
				document.getElementById("4ascore").innerHTML=t2s;
			}else if(bracketpos==5){
				document.getElementById("5home").innerHTML=t1seed + " " + t1;
				document.getElementById("5away").innerHTML=t2seed+ " " + t2;
				document.getElementById("5hscore").innerHTML=t1s;
				document.getElementById("5ascore").innerHTML=t2s;
			}else if(bracketpos==6){
				document.getElementById("6home").innerHTML=t1seed + " " + t1;
				document.getElementById("6away").innerHTML=t2seed+ " " + t2;
				document.getElementById("6hscore").innerHTML=t1s;
				document.getElementById("6ascore").innerHTML=t2s;
			}else if(bracketpos==7){
				document.getElementById("7home").innerHTML=t1seed + " " + t1;
				document.getElementById("7away").innerHTML=t2seed+ " " + t2;
				document.getElementById("7hscore").innerHTML=t1s;
				document.getElementById("7ascore").innerHTML=t2s;
			}else if(bracketpos==8){
				document.getElementById("8home").innerHTML=t1seed + " " + t1;
				document.getElementById("8away").innerHTML=t2seed+ " " + t2;
				document.getElementById("8hscore").innerHTML=t1s;
				document.getElementById("8ascore").innerHTML=t2s;
			}else if(bracketpos==9){
				document.getElementById("9home").innerHTML=t1seed + " " + t1;
				document.getElementById("9away").innerHTML=t2seed+ " " + t2;
				document.getElementById("9hscore").innerHTML=t1s;
				document.getElementById("9ascore").innerHTML=t2s;
			}else if(bracketpos==10){
				document.getElementById("10home").innerHTML=t1seed + " " + t1;
				document.getElementById("10away").innerHTML=t2seed+ " " + t2;
				document.getElementById("10hscore").innerHTML=t1s;
				document.getElementById("10ascore").innerHTML=t2s;
			}else if(bracketpos==11){
				document.getElementById("11home").innerHTML=t1seed + " " + t1;
				document.getElementById("11away").innerHTML=t2seed+ " " + t2;
				document.getElementById("11hscore").innerHTML=t1s;
				document.getElementById("11ascore").innerHTML=t2s;
			}else if(bracketpos==12){
				document.getElementById("12home").innerHTML=t1seed + " " + t1;
				document.getElementById("12away").innerHTML=t2seed+ " " + t2;
				document.getElementById("12hscore").innerHTML=t1s;
				document.getElementById("12ascore").innerHTML=t2s;
			}else if(bracketpos==13){
				document.getElementById("13home").innerHTML=t1seed + " " + t1;
				document.getElementById("13away").innerHTML=t2seed+ " " + t2;
				document.getElementById("13hscore").innerHTML=t1s;
				document.getElementById("13ascore").innerHTML=t2s;
			}else if(bracketpos==14){
				document.getElementById("14home").innerHTML=t1seed + " " + t1;
				document.getElementById("14away").innerHTML=t2seed+ " " + t2;
				document.getElementById("14hscore").innerHTML=t1s;
				document.getElementById("14ascore").innerHTML=t2s;
			}
		}
		

	});

});