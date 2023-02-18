<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swipe Login App</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
	<script src="https://kit.fontawesome.com/49c40c9042.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<link href="assets/css/slideToUnlock.css" rel="stylesheet">  
    <link href="assets/css/iphone.theme.css" rel="stylesheet"> 
    <link href="assets/css/style.css" rel="stylesheet" crossorigin="anonymous">
    
</head>
<body class="black-bg">

	<div id="myNav" class="overlay">
		<div class="bt-spinner"></div>
	</div>
	<div class="login-wrapper d-flex flex-column justify-content-center align-items-center w-100 h-full min-vw-100 min-vh-100">
		<img class="img-logo d-block " src="assets/images/logo.png" alt="logo" />
		<div class="container mx-auto mt-5">
			<div class="row mx-auto d-flex justify-content-center input-row">
				<div id="loginSlide" class=""></div>
				<input name="access_code" type="text" class="access_code" value="" placeholder="Enter code"/>
			</div>
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- SCRIPTS -->
	<script src="assets/js/jquery.slideToUnlock.js"></script> 
	<script src="assets/js/app.js" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			$(".overlay").fadeOut("slow");
			$("#loginSlide").slideToUnlock({
				lockText:'Swipe to login',
				status:false,
				lockfn  :function(){

				},
				unlockfn:function(){
					$("#loginSlide").fadeOut("slow");
					$(".access_code").css('z-index', 1);
				},
			});

			$("input[name='access_code']").on("keyup", function(e) {
				if (e.key === 'Enter' || e.keyCode === 13) {
					$.ajax({
						url: "/verify-access-code",
						type: "POST",
						data: {code: $(this).val()},
						success: function(result) {
							console.log(result);
							result = JSON.parse(result);
							if (result.status) {
								location.href = result.redirect_url;
							} else {
								alert("Invalid code");
							}
						},
						error: function(error) {
							console.log(error);
						},
					});
				}
			});
			if ($('.locked_handle').length > 0) {
				$('.locked_handle').html('<i class="fa-solid fa-angle-right"></i>');
			}
		})
	</script>
<script>

</script>

<!-- SCRIPTS -->
</body>
</html>
