<?php include_once "common/header.php"; ?>


<div id="tournament_list">

	<noscript>This site just doesn't work, period, without JavaScript</noscript>

	<!-- IF LOGGED IN -->
	<!-- All tournaments with a see my league buttons-->

	<!-- IF LOGGED OUT -->
	<div id=login_header>FAN MODE. LOGIN TO SEE TOURNAMENTS YOU MANAGE. <span class="right"><a href="index.html">LOGIN</a></span></div>
	<h1>Pick an ongoing tournament</h1>
	<div id="team_container">
		<!-- Tournament info appears here via database call -->
	</div>

	<!-- Alternate content here -->

</div>

<?php include_once "common/sidebar.php"; ?>

<?php include_once "common/footer.php"; ?>