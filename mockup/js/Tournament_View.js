var Tournament_View = function(){

	var tournament_section = document.getElementById("team_container");
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
	var userid = getCookie("userid");
	alert(userid);
	if(userid != null){
	var url = 'php/listTournament.php?userid=' + userid;
	}else{
	var url = 'php/listTournament.php/';	
	}
	var getTournamentNames = $.getJSON(url, function(json) {
		tournament_section.innerHTML="";
		var names = [];
		if(json.tournament.length==0){
			tournament_section.innerHTML="NO ONGOING TOURNAMENTS";
		}else{
			for(var i = 0; i < json.tournament.length; i++){
				//console.log(json.tournament[i].name);
				var tournament = document.createElement('div');
				tournament.className = "tournament_card";
				tournament.innerHTML=String(json.tournament[i].name);
				tournament_section.appendChild(tournament);
			}
		}
		//return names;

	});
	// alert(getTournamentNames);

	// var showTournamentName = function() {
	// 	tournament_section.empty();
	// 	alert("someting");
	// 	var tournament_names = getTournamentNames;
	// 	var tournament_count = tournament_names.length;//tournament_names.length;//get(SQLCOMMANDRETURNTHINGHERE);
	// 	for(var t = 0; t < tournament_count; t++){
	// 		var tournament = document.createElement('div');
	// 		tournament.className = "tournament_card";
	// 		tournament.innerHTML=String(tournament_names[i]);
	// 	}
	// };


};
