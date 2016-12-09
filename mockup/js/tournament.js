var Tournament = function() {
	var dropdown = document.getElementById('numTeams'); //good line
	dropdown.onchange = function(){
		document.getElementById('team_name_area').innerHTML= "";
		team_count = $("#numTeams option:selected").text(); //good
		for (var i=0; i < team_count; i++){
			var text = 'Team Name: <input type=text name=team1 class="team_name" required> <br>'; 	
			document.getElementById('team_name_area').innerHTML += text;
		}
	}
	function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}

	$('#submitbutton').click(function(e){
		e.preventDefault();
		var teams = [];
		var teams_box = document.getElementsByClassName("team_name");
		for(var i=0; i<teams_box.length; i++){
			teams.push(teams_box[i].value);
		}
		var name = document.getElementById('name').value;
		var start_date = document.getElementById('start_date').value;
		var end_date = document.getElementById('end_date').value;
		var numleagues = document.getElementById('numleagues').value;
		var numteams = document.getElementById('numTeams').value;

		var obj=new Object();
		obj.name=name;
		obj.numteams=numteams;
		obj.numleagues=numleagues;
		obj.start_date=start_date;
		obj.end_date=end_date;
		obj.in_bracket_play=false;
		obj.tournament_style="round_robin";
		obj.min_rest_time="1:00:00";
		obj.teams=teams;
		obj.userid=getCookie("userid");

		var json = JSON.stringify(obj);
		alert(json);
		$.ajax('makeTournament.php',
		{
			type:"POST",
			dataType: "json",
			data: json,
			success: function(json, status, jqXHR) {
				var id = json.id;
				var redirect = "tourneyView.html?id=" + id;
				window.location=redirect;
			},
			error: function(jqXHR, status, error) {
				alert(jqXHR.responseText);
			}
		});


	});
};