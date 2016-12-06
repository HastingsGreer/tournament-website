var Tournament = function() {
	var dropdown = document.getElementById('numTeams'); //good line
	var team_count = $("#numTeams option:selected").text(); //good
	alert(team_count); //good
	//var team_section = document.getElementById('team_name_area');
	dropdown.onchange = function(){
		alert("you messing")
		$('team_name_area').empty();
		//team_count = $("#numTeams option:selected").text(); //good
		for (var i=0; i < team_count; i++){
			var text = "Team Name: <input type=text name=team1 value="Enter a team name"> <br>";
			team_section.append(text);
		}
	}
};