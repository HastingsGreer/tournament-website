var Tournament = function() {
	var dropdown = document.getElementById('numTeams'); //good line
	dropdown.onchange = function(){
		document.getElementById('team_name_area').innerHTML= "";
		team_count = $("#numTeams option:selected").text(); //good
		for (var i=0; i < team_count; i++){
		 	var text = 'Team Name: <input type=text name=team1 value="Enter a team name"> <br>'; 	
		 	document.getElementById('team_name_area').innerHTML += text;
		 }
	}
};