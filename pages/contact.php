<?php
include('header.php');
?>
<img src="images/bg.jpg" class="fixed-top" width="520" style="position: fixed; z-index:-1; right: 0;" />

<div class="contact-container" style="width: 60%; margin: 9rem auto;">
	<form action="contactServer.php" method="POST" class="text-center">
		<img src="images/burger.png" width="150" />
		<h1 style="font-weight: 700;">Have queries? <span style="color: green">پوچھ لو </span></h1>
		<input required name="name" type="text" class="form-control contact-input" placeholder="Full Name">
		<input required name="email" type="email" class="form-control contact-input" placeholder="@email.com">
		<textarea required name="message" class="form-control contact-input" cols="30" rows="8" placeholder="What's in your mind..."></textarea>
		<button type="submit" name="submit" class="btn btn grad-btn-4">SEND MESSAGE</button>
	</form>
	<?php if(isset($_GET['message'])){ ?>
	<div class="text-center alert-success" style=" padding: 1rem; border-radius: 12px; width: 80%; margin: 0 auto">
		<h3><?php echo $_GET['message']; ?></h3>
	</div>
	<?php } ?>
</div>

<?php include('footer.php'); ?>