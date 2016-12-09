$(document).ready(function(){
	var id2name;
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
				var gameid = game.gameID
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
				tr.className +=" game ";
				tr.id = gameid+" "+ t1 + " "+ t2;
				var th=document.createElement("th");
				th.className +=" game ";
				th.id =  gameid+" "+ t1 + " "+ t2;
				var stuff = document.createElement('td');
				stuff.className="gamenum";
				var gn = "Game: "+game.gameID;
				stuff.innerHTML=gn;
				th.appendChild(stuff);
				var h= document.createElement("tr");
				h.className +=" game ";
				h.id = gameid+" "+ t1 + " "+ t2;
				var h1n=document.createElement("th");
				h1n.className="homename";
				h1n.innerHTML= t1name;
				var h1s=document.createElement("th");
				h1s.className+="hs";
				h1s.innerHTML=t1score;
				h.appendChild(h1n);
				h.appendChild(h1s);
				th.appendChild(h);
				//h1s.appendTo(h1n);
				var a = document.createElement("tr");
				a.className +=" game ";
				a.id =  gameid+" "+ t1 + " "+ t2;
				var a1n =document.createElement("th");
				a1n.className+="awayname";
				a1n.innerHTML=t2name;
				var a1s = document.createElement("th");
				a1s.innerHTML=t2score;
				a1s.className="as"
				a.appendChild(a1n);
				a.appendChild(a1s);
				th.appendChild(a);
				th.className +=" game";
				tr.appendChild(th);
				var brk = document.createElement("br");
				tr.appendChild(brk);
				tr.className +=" game ";
				tr.id = gameid+" "+ t1 + " "+ t2; 

				$("#pool_container").append(tr);
				
			}
		}

		for(var i=0; i< bracket.length; i++){
			var game=bracket[i];
			var teams2=true;
			if(game.team1!=0){
				var t1=id2name[game.team1].team_name;
				var t1id=id2name[game.team1].team_id;
				var t1seed=id2name[game.team1].seed;
				var t1s=bracket[i].team1Score;
			}else{
				var t1=" ";
				var t1seed=" ";
				var t1s=" ";
				var t1id=" ";
				var teams2=false;
			}
			if(game.team2 !=0){
				var t2=id2name[game.team2].team_name;
				var t2s=bracket[i].team2Score;
				var t2seed=id2name[game.team2].seed;
				var t2id=id2name[game.team2].team_id;
			}else{
				var t2=" ";
				var t2s=" ";
				var t2seed=" ";
				var t2id=" ";
				var teams2=false;
			}

			var bracketpos = game.bracket_position;
			if(bracketpos==0){
				var gameid=game.gameID;
				document.getElementById("0home").innerHTML=t1seed + " " + t1;
				document.getElementById("0away").innerHTML=t2seed+ " " + t2;
				document.getElementById("0hscore").innerHTML=t1s;
				document.getElementById("0ascore").innerHTML=t2s;
				if(teams2){
					document.getElementById("0home").parentNode.id=gameid+ " " + t1id + " " + t2id;
					document.getElementById("0away").parentNode.id=gameid+ " " + t1id + " " + t2id;
				}
			}else if(bracketpos==1){
				var gameid=game.gameID;
				document.getElementById("1home").innerHTML=t1seed + " " + t1;
				document.getElementById("1away").innerHTML=t2seed+ " " + t2;
				document.getElementById("1hscore").innerHTML=t1s;
				document.getElementById("1ascore").innerHTML=t2s;
				if(teams2){
					document.getElementById("1home").parentNode.id=gameid+ " " + t1id + " " + t2id;
					document.getElementById("1away").parentNode.id=gameid+ " " + t1id + " " + t2id;
				}
			}else if(bracketpos==2){
				var gameid=game.gameID;
				document.getElementById("2home").innerHTML=t1seed + " " + t1;
				document.getElementById("2away").innerHTML=t2seed+ " " + t2;
				document.getElementById("2hscore").innerHTML=t1s;
				document.getElementById("2ascore").innerHTML=t2s;
				if(teams2){
					document.getElementById("2home").parentNode.id=gameid+ " " + t1id + " " + t2id;
					document.getElementById("2away").parentNode.id=gameid+ " " + t1id + " " + t2id;
				}
			}else if(bracketpos==3){
				var gameid=game.gameID;
				document.getElementById("3home").innerHTML=t1seed + " " + t1;
				document.getElementById("3away").innerHTML=t2seed+ " " + t2;
				document.getElementById("3hscore").innerHTML=t1s;
				document.getElementById("3ascore").innerHTML=t2s;
				if(teams2){
					document.getElementById("3home").parentNode.id=gameid+ " " + t1id + " " + t2id;
					document.getElementById("3away").parentNode.id=gameid+ " " + t1id + " " + t2id;
				}
			}else if(bracketpos==4){
				var gameid=game.gameID;
				document.getElementById("4home").innerHTML=t1seed + " " + t1;
				document.getElementById("4away").innerHTML=t2seed+ " " + t2;
				document.getElementById("4hscore").innerHTML=t1s;
				document.getElementById("4ascore").innerHTML=t2s;
				if(teams2){
					document.getElementById("4home").parentNode.id=gameid+ " " + t1id + " " + t2id;
					document.getElementById("4away").parentNode.id=gameid+ " " + t1id + " " + t2id;
				}}else if(bracketpos==5){
					var gameid=game.gameID;
					document.getElementById("5home").innerHTML=t1seed + " " + t1;
					document.getElementById("5away").innerHTML=t2seed+ " " + t2;
					document.getElementById("5hscore").innerHTML=t1s;
					document.getElementById("5ascore").innerHTML=t2s;
					if(teams2){
						document.getElementById("5home").parentNode.id=gameid+ " " + t1id + " " + t2id;
						document.getElementById("5away").parentNode.id=gameid+ " " + t1id + " " + t2id;
					}
				}else if(bracketpos==6){
					var gameid=game.gameID;
					document.getElementById("6home").innerHTML=t1seed + " " + t1;
					document.getElementById("6away").innerHTML=t2seed+ " " + t2;
					document.getElementById("6hscore").innerHTML=t1s;
					document.getElementById("6ascore").innerHTML=t2s;
					if(teams2){
						document.getElementById("6home").parentNode.id=gameid+ " " + t1id + " " + t2id;
						document.getElementById("6away").parentNode.id=gameid+ " " + t1id + " " + t2id;
					}
				}else if(bracketpos==7){
					var gameid=game.gameID;
					document.getElementById("7home").innerHTML=t1seed + " " + t1;
					document.getElementById("7away").innerHTML=t2seed+ " " + t2;
					document.getElementById("7hscore").innerHTML=t1s;
					document.getElementById("7ascore").innerHTML=t2s;
					if(teams2){
						document.getElementById("7home").parentNode.id=gameid+ " " + t1id + " " + t2id;
						document.getElementById("7away").parentNode.id=gameid+ " " + t1id + " " + t2id;
					}
				}else if(bracketpos==8){
					var gameid=game.gameID;
					document.getElementById("8home").innerHTML=t1seed + " " + t1;
					document.getElementById("8away").innerHTML=t2seed+ " " + t2;
					document.getElementById("8hscore").innerHTML=t1s;
					document.getElementById("8ascore").innerHTML=t2s;
					if(teams2){
						document.getElementById("8home").parentNode.id=gameid+ " " + t1id + " " + t2id;
						document.getElementById("8away").parentNode.id=gameid+ " " + t1id + " " + t2id;
					}
				}else if(bracketpos==9){
					var gameid=game.gameID;
					document.getElementById("9home").innerHTML=t1seed + " " + t1;
					document.getElementById("9away").innerHTML=t2seed+ " " + t2;
					document.getElementById("9hscore").innerHTML=t1s;
					document.getElementById("9ascore").innerHTML=t2s;
					if(teams2){
						document.getElementById("9home").parentNode.id=gameid+ " " + t1id + " " + t2id;
						document.getElementById("9away").parentNode.id=gameid+ " " + t1id + " " + t2id;
					}
				}else if(bracketpos==10){
					document.getElementById("10home").innerHTML=t1seed + " " + t1;
					document.getElementById("10away").innerHTML=t2seed+ " " + t2;
					document.getElementById("10hscore").innerHTML=t1s;
					document.getElementById("10ascore").innerHTML=t2s;
					if(teams2){
						document.getElementById("10home").parentNode.id=gameid+ " " + t1id + " " + t2id;
						document.getElementById("10away").parentNode.id=gameid+ " " + t1id + " " + t2id;
					}
				}else if(bracketpos==11){
					var gameid=game.gameID;
					document.getElementById("11home").innerHTML=t1seed + " " + t1;
					document.getElementById("11away").innerHTML=t2seed+ " " + t2;
					document.getElementById("11hscore").innerHTML=t1s;
					document.getElementById("11ascore").innerHTML=t2s;
					if(teams2){
						document.getElementById("11home").parentNode.id=gameid+ " " + t1id + " " + t2id;
						document.getElementById("11away").parentNode.id=gameid+ " " + t1id + " " + t2id;
					}
				}else if(bracketpos==12){
					var gameid=game.gameID;
					document.getElementById("12home").innerHTML=t1seed + " " + t1;
					document.getElementById("12away").innerHTML=t2seed+ " " + t2;
					document.getElementById("12hscore").innerHTML=t1s;
					document.getElementById("12ascore").innerHTML=t2s;
					if(teams2){
						document.getElementById("12home").parentNode.id=gameid+ " " + t1id + " " + t2id;
						document.getElementById("12away").parentNode.id=gameid+ " " + t1id + " " + t2id;
					}
				}else if(bracketpos==13){
					var gameid=game.gameID;
					document.getElementById("13home").innerHTML=t1seed + " " + t1;
					document.getElementById("13away").innerHTML=t2seed+ " " + t2;
					document.getElementById("13hscore").innerHTML=t1s;
					document.getElementById("13ascore").innerHTML=t2s;
					if(teams2){
						document.getElementById("13home").parentNode.id=gameid+ " " + t1id + " " + t2id;
						document.getElementById("13away").parentNode.id=gameid+ " " + t1id + " " + t2id;
					}
				}else if(bracketpos==14){
					var gameid=game.gameID;
					document.getElementById("14home").innerHTML=t1seed + " " + t1;
					document.getElementById("14away").innerHTML=t2seed+ " " + t2;
					document.getElementById("14hscore").innerHTML=t1s;
					document.getElementById("14ascore").innerHTML=t2s;
					if(teams2){
						document.getElementById("14home").parentNode.id=gameid+ " " + t1id + " " + t2id;
						document.getElementById("14away").parentNode.id=gameid+ " " + t1id + " " + t2id;
					}
				}
			}
		});

$('.game').on('click', function(e){
	var object = this;
	
	var id = this.id
	if(id != undefined){
		var variables = id.split(" ");
		if(variables.length==3 && variables[2] !="" && variables[1] !="" && variables[0] !=""){
			game=variables[0];
			hname="Team 1 Score";
			aname="Team 2 Score";
			document.getElementById("hometeamname").innerHTML=hname;
			document.getElementById("awayteamname").innerHTML=aname;
			$('#submitbutton').on('click', function(e){
						e.preventDefault();
						var gameid=variables[0];
						var home_score=document.getElementById('h1s').value;
						var away_score=document.getElementById('a1s').value;
						if(home_score == "" || away_score==""){
							alert("You must supply both scores.");
						}
						var obj=new Object();
						obj.gameid=gameid;
						obj.home_score=home_score;
						obj.away_score=away_score;
						var json = JSON.stringify(obj);
						$.ajax('php/declareWinner.php?gameid=' + gameid + "&home_score=" + home_score + "&away_score=" + away_score,
						{
							type:"POST",
							dataType: "json",
							data: json,
							success: function(json, status, jqXHR) {
								var id = json.id;
								var redirect = window.location; //reload
								window.location=redirect;
							},
							error: function(jqXHR, status, error) {
								//alert(jqXHR.responseText);
							}
						});
					});
		}
	}else{
		alert("undefinde");
	}	
}

);

});