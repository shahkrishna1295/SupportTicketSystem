<?php
    session_start();
    //getting user id of logged in user
    $userid = $_SESSION['userid'];
	
    //load both xml files
    $tickets = simplexml_load_file('xml/tickets.xml');
    $users = simplexml_load_file('xml/users.xml');
	
    //getting tickets from the id
    $ticketID = (isset($_GET['id']) ? $_GET['id'] : '');
    
    for($i = 0; $i<sizeof($tickets); $i++){
        if($tickets->ticket[$i]['id'] == $ticketID){
           $ticketUserId = $tickets->ticket[$i]['userid'];
		   $ticketStatus = $tickets->ticket[$i]['status'];
           $ticketTitle = $tickets->ticket[$i]->title; 
           $ticketDescription = $tickets->ticket[$i]->description;
           $ticketDepartment = $tickets->ticket[$i]['department'];
           $ticketdate = $tickets->ticket[$i]->ticketdate; 
           $ticketMessage = $tickets->ticket[$i]->msg;
        }
    }
    //updating status of the ticket
    if(isset($_POST['status-update'])){
		
        $tstatus = $_POST['ticket-status'];
		
		for($i = 0; $i<sizeof($tickets); $i++){
			if($tickets->ticket[$i]['id'] == $ticketID){
				$tickets->ticket[$i]['status'] = $tstatus;
			}
		}
		$tickets->asXML('xml/tickets.xml');
    }
	
	//sending message
    if(isset($_POST['sendmsg'])){
        if($_POST['message'] != "" || $_POST['message'] != null){
            $msgText = $_POST['message'];
            //adding message element
            $msg = $tickets->ticket[$ticketID-1]->addChild('msg', $msgText);
            //attr of message element
			for($i = 0; $i<sizeof($users); $i++){
			if($tickets->ticket[$i]['userid']==$ticketUserId){
					$usertypeid = $users->user[$i]['id'];
					//echo $usertypeid;
				}
			}
            $msg->addAttribute('by', $userid);
            $tickets->saveXML('xml/tickets.xml');
        }
    }
?>

<html>
    <head>
        <title>Staff View ticket</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <main>
            
            <div class="container">
			
				<button class="extlink"><a href="staff.php">Home</a></button>
				<button class="extlink"><a href="index.php">Logout</a></button>
				
				 <h1><?=$ticketTitle?></h1>
				 <h5>Description : <?=$ticketDescription?> </h5>
                <div>
                    <form method="post">
						<h4>Status : </h4>
					
						<input type="radio" class="" name="ticket-status" value="reviewing">
						<label>Reviewing</label>
					
						<input type="radio" class="" name="ticket-status" value="resolved">
						<label>Resolved</label>
				
                        <input type="submit" id="updtbtn" value="Update" name="status-update" class="submit-button">
                    </form>
                </div>
				<h5>Department : <?=$ticketDepartment?> </h5>
            </div>
            <div class="container">
				
				<?php
                        foreach($ticketMessage as $ticketMsg){
							//echo($userid);
                            //display the messages
							if($ticketMsg['by']==$userid){
									echo( 'You :  ' . $ticketMsg . '<br>' );
								}
                                else{
									echo('Client : ' . $ticketMsg . '<br>'); 
								}			
						                            
                        }
                    ?>
				<form method="post">
					<div class="row comment-box-main p-3 rounded-bottom">
			  		<div class="col-md-9 col-sm-9 col-9 pr-0 comment-box">
					  <input type="text" class="form-control" name="message" placeholder="message ...." />
			  		</div>
			  		<div class="col-md-2 col-sm-2 col-2 pl-0 text-center send-btn">
			  			<button type="submit" class="extlink" name="sendmsg">Send</button>
			  		</div>
				</div>
				</form>
				
			</div>
        </main>
    </body>
</html>