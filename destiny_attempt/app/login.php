<?php include_once "common/header.php"; ?>

<div id="login">
<div id="back_photo">
    <div id="login-section">
        <div id="title">BRACKET BUSTER</div> <br>
        <form id="login">

            Organizer Login:<br>
            Username: <input type=text name=username> <span id="username_availabilty"> </span><br> <br>
            <!-- //Going to do some ongoing username and password check -->
            Password: <input type=password name=password><span id="password_check"> </span><br> <br>
            <button type="submit">LOGIN</button>
        </form>

        <div id="tournament_list_button"><a href="tournament_view.html">ONGOING TOURNAMENTS</a></div>

        <div id="manage_button">TOURNAMENTS YOU MANAGE</div>

        <div id="rules_button">TOURNAMENT RULES - HOW YOU'RE SEEDED</div>

        <a href="create_tournament.html" style="text-decoration:none"> <div id="create_button">CREATE TOURNAMENT</div></a>
    </div>

</div>
</div>

<!--<?php include_once "common/sidebar.php"; ?> -->

<?php include_once "common/footer.php"; ?>