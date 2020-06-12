<?php  
  include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
  // include 'inc/checklogin.php';
  debugger($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

   <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet"> 
    <!-- Animate.css -->
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>

  </head>
 
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="process/login.php" method="POST">
              <h1>Login Form</h1>
              <div>
                <?php flashmessage() ?>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Email" required="" name="email"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
              </div>
              <div>
                <input type="checkbox" name="rememberme" /> Remember me 
              </div>
              <div>
                <button class="btn btn-default submit" type="submit">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>&copy; <?php echo Date("Y") ?>All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action='process/signup.php' method="POST">
              <h1>Create Account</h1>
              <div>
                <?php flashmessage(); ?>
              </div>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" name="email" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" />
              </div>
              <div>
                <input type="password" id="newpassword" class="form-control" name="newpassword" placeholder="Re-Type Password" required="" />
              </div>
              <div>
                <span id="passwError" class="hidden" style="color: #FF0000"></span>
              </div>
              <div>
                <button class="btn btn-default submit" type="submit" id="submit">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>&copy; <?php echo Date("Y") ?> All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

<script type="text/javascript">
  $('#newpassword').keyup(function(){
    let password = $('#password').val();
    let newpassword = $('#newpassword').val();
    if(password == newpassword){
      $('#passwError').addClass('hidden').removeClass('alert').html('');
      $('#submit').removeAttr('disabled','disabled');
    }else{
      $('#passwError').removeClass('hidden').addClass('alert').html("Password doesn't match");
      $('#submit').attr('disabled','disabled');
    }
  });

</script>
<?php
  
?>
