#curl POST -H 'Content-Type: application/json' -d '{"name": "New item", "year": "2009"}' https://wwwp.cs.unc.edu/Courses/comp426-f16/users/tgreer/final_project_milestones/mockup/makeTournament.php
curl POST -H 'Content-Type: application/json' -d '{
              "name": "yball horse", 
              "numteams": 16,
              "numleagues": 4,
              "start_date" : "2013-12-3",
              "end_date":"2013-12-4", 

              "in_bracket_play": true,
              "tournament_style": "round_robin",
              "min_rest_time": "1:00:00",
              "teams" :["Broncos", "Bulls", "Wingnuts", "Gamecocks", "Ampersands", "xss", "tar heels", "snoot boopers", "fly balls", "team chaos", "cow tippers", "crazy 8s", "ballers", "robots", "cat-people", "brainsuckers"]}' https://wwwp.cs.unc.edu/Courses/comp426-f16/users/tgreer/final_project_milestones/mockup/makeTournament.php
