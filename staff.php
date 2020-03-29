<?php

	 session_start();
    //fetching user id of logged in user
    $userid = $_SESSION['userid'];
	//var_dump($userid = $_SESSION['userid']);
	
	//get the ticket xml
	$tickets = simplexml_load_file("xml/tickets.xml"); 
	
?>
<html lang="en">
	<head>
		<title>Staff View</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
	<form action="" method="get">
		<div class="container" id="staffsticket">
		<button class="extlink"><a href="index.php">Logout</a></button>
			<div id="headings" class="row">
				<div class="col-sm-2">Sr. No.</div>
				<div class="col-sm-2">Ticket Status</div>
				<div class="col-sm-2">Ticket Title</div>
				<div class="col-sm-2">Ticket Department</div>
				<div class="col-sm-2">Ticket Date</div>
			</div>
			<?php
				//displaying all the tickets
				for($i=0; $i<sizeof($tickets); $i++){
					echo('<div id="liststicekt" class="row">
							<div class="col-sm-2">'.($i+1).'</div>
							<div class="col-sm-2">'.$tickets->ticket[$i]['status'].'</div>
                            <div class="col-sm-2"><a href = "staffViewTicket.php?id='.$tickets->ticket[$i]['id'].'">'.$tickets->ticket[$i]['id']. " " .$tickets->ticket[$i]->title.'</a></div>
                            <div class="col-sm-2">'.$tickets->ticket[$i]['department'].'</div>
                            <div class="col-sm-2">'.$tickets->ticket[$i]->ticketdate.'</div>
						</div>');
				}
			?>
		</div>
		</form>
	</body>
</html>