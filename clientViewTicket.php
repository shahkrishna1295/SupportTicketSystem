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
           $ticketDate = $tickets->ticket[$i]->ticketdate; 
           $ticketMessage = $tickets->ticket[$i]->msg;
		   $msgBY = $tickets->ticket[$i]->msg['id'];
        }
		
    }
	
	for($i = 0; $i<sizeof($users); $i++){
		if($tickets->ticket[$i]['userid']==$ticketUserId){
			$usertypeid = $users->user[$i]['id'];
			echo $usertypeid;
		}
        
    }
	
	//sending message
    if(isset($_POST['sendmsg'])){
        if($_POST['message'] != "" || $_POST['message'] != null){
            $msgText = $_POST['message'];
            //adding message element
            $msg = $tickets->ticket[$ticketID-1]->addChild('msg', $msgText);
            //attr of message element
            $msg->addAttribute('by', $userid);
            $tickets->saveXML('xml/tickets.xml');
        }
    }
   
?>

<html>
    <head>
        <title>Client View ticket</title>
        <meta charset="utf-8">
        <link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <main>
            <div class="container">
				<button class="extlink"><a href="client.php">Home</a></button>
				<button class="extlink"><a href="index.php">Logout</a></button>
				<h2><?=$ticketTitle?></h1>
				<h6>Description : <?=$ticketDescription?> </h6>
				<h6>Status : <?=$ticketStatus?></h6>	
				<h6>Department : <?=$ticketDepartment?> </h6>
            </div>
            <div class="container">
				
				<?php
                        foreach($ticketMessage as $ticketMsg){
							//echo($userid);
							//echo $ticketUserId;
                            //display the messages
                            
								if($ticketMsg['by']==$userid){
									echo( 'Staff :  ' . $ticketMsg . '<br>' );
								}
                                else{
									echo('You : ' . $ticketMsg . '<br>'); 
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