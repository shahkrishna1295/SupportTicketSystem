<?php

	 session_start();
    //fetching user id of logged in user
    $userid = $_SESSION['userid'];
    $userTickets = array();
	
	$tickets = simplexml_load_file("xml/tickets.xml"); 
	 
    //fetching tickets of a particular client
    for($i = 0; $i<sizeof($tickets); $i++){
        if($tickets->ticket[$i]['userid'] == $userid){
            array_push($userTickets,$tickets->ticket[$i]);
        }
    }
	 
?>
<html lang="en">
	<head>
		<title>User View</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		
		<div class="container">
		<button class="extlink"><a href="newticket.php">New Ticket</a></button>
		<button class="extlink"><a href="index.php">Logout</a></button>
			<div id="headings" class="row">
				<div class="col-sm-2">Sr. No.</div>
				<div class="col-sm-2">Ticket Status</div>
				<div class="col-sm-2">Ticket Title</div>
				<div class="col-sm-2">Ticket Department</div>
				<div class="col-sm-2">Ticket Date</div>
			</div>
			<?php
			
				for($i=0; $i<sizeof($userTickets); $i++){
					echo('<div id="listcticekt" class="row">
							<div class="col-sm-2">'.($i+1).'</div>
							<div class="col-sm-2">'.$userTickets[$i]['status'].'</div>
                            <div class="col-sm-2"><a href = "clientViewTicket.php?id='.$tickets->ticket[$i]['id'].'">'.$tickets->ticket[$i]['id']. " " .$tickets->ticket[$i]->title.'</a></div>
                            <div class="col-sm-2">'.$userTickets[$i]['department'].'</div>
                            <div class="col-sm-2">'.$userTickets[$i]->ticketdate.'</div>
						</div>');
				}
			?>
		</div>
		
	</body>
</html>