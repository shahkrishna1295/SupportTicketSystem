<?php

?>
<html lang="en">
	<head>
		<title>New Ticket</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	</head>
	<body>
		<form action="#" method="post" id="newticketform">
			<a href="client.php">Home</a>
			<a href="index.php">Logout</a>
			<div class="modal-body justify-content-centre">
				<h2>New Ticket</h2>
				<div class="form-group">
					<input name="subject" type="text" class="form-control" placeholder="Subject">
				</div>
				<div class="form-group">
					<label>Department</label>
					<div class="custom-control custom-radio">
					  <input type="radio" class="custom-control-input" id="shipping" name="shipping">
					  <label class="custom-control-label" for="shipping">Shipping</label>
					</div>		

					<div class="custom-control custom-radio">
					  <input type="radio" class="custom-control-input" id="returns" name="returns">
					  <label class="custom-control-label" for="returns">Returns</label>
					</div>		
					
					<div class="custom-control custom-radio">
					  <input type="radio" class="custom-control-input" id="billing" name="billing">
					  <label class="custom-control-label" for="billing">Billing</label>
					</div>		
					
					<div class="custom-control custom-radio">
					  <input type="radio" class="custom-control-input" id="technicalissues" name="technicalissues">
					  <label class="custom-control-label" for="technicalissues">Technical-Issues</label>
					</div>		
				</div>
				
				
				<div class="form-group">
					<textarea name="message" class="form-control" placeholder="Please detail your issue or question" style="height: 120px;"></textarea>
				</div>
				<div class="form-group">
					<input type="file" name="attachment">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="cancelbtn" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				<button type="submit" id="createbtn" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Create</button>
			</div>
		</form>
	</body>
</html>