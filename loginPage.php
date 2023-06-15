<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Log in </title>
    <link rel="stylesheet" href="login.css">

	<header>


</header>
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}
</script>
<footer>
</footer>
   </head>
<body>
    
<div class="logo img">
    <img src="MITSI.PNG" alt="logo">
</div>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>





  <div class="wrapper">
    <form action="actions/login.php" method="POST">
      <div class="input-box">
        <input type="text" placeholder="Email" name="email" id="email" required=""/>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" name="password" id="password" required=""/>
      </div>
      <div class="policy">
        <input type="checkbox">
        <h3>Remember me </h3>
        <h3>Forgot password</h3>
       
      </div>
      <div class="input-box button">
        <input type="Submit" name="login" id="login" value="Login"/>
      </div>
      <div class="text">
	<h3> <a href="signupPage.php">Sign up</a></h3>
        <h3> or <a href="#"> </a></h3>
        <h3>Log in with</h3>
      </div>
      
    </form>
	<div class="img">
	<img src="facebook.png" alt="icon">
	<img src="instagram.png" alt="icon">
	<img src="twitter.png" alt="icon">
	<img src="gmail.png" alt="icon">
	<img src="skype.png" alt="icon">
	</div>
  </div>

</body>
</html>
