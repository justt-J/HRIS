<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign up </title>
    <link rel="stylesheet" href="signdown.css">

<footer>
</footer>

   </head>
<body>


  <div class="wrapper">
    <h2>Sign up</h2>
    <form action="actions/actionsSign.php" method="POST">
      <div class="input-box">
        <input type="text" placeholder="Firstname" name="fname" id="fname" required=""/>
      </div>
      <div class="input-box">
        <input type="text" placeholder="Lastname" name="lname" id="lname" required=""/>
      </div>
      <div class="input-box">
        <input type="text" placeholder="Email" name="email" id="email" required=""/>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" name="password" id="password" required=""/>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Confirm password" required=""/>
      </div>
      <div class="input-box">
        <input type="text" placeholder="Phone No" name="phoneNo" id="phoneNo" required=""/>
      </div>
      <input type="hidden" placeholder="SSS" name="SSS" id="SSS" required=""/>
      <input type="hidden" placeholder="philHealth" name="philHealth" id="philHealth" required=""/>
      <input type="hidden" placeholder="healthInsurance" name="healthInsurance" id="healthInsurance" required=""/>
      <input type="hidden" placeholder="pagIbig" name="pagIbig" id="pagIbig" required=""/>
      <input type="hidden" placeholder="age" name="age" id="age" required=""/>
      <div class="policy">
        <input type="checkbox">
        <h3>I accept all terms & condition</h3>
      </div>
      <div class="input-box button">
        <input type="Submit" name="signup" id="signup" value="Signup"/>
      </div>
      <div class="text">
        <h3>Already have an account? <a href="loginPage.php">Login now</a></h3>
      </div>
    </form>
  </div>

</body>
</html>
