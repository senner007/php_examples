<?php
  session_start();
  require_once('php/inc/functions.php');
  require_once('php/inc/config.php');

  if(isset($_GET['logout'])) {
    $getVal = $_GET['logout'];
    if ($getVal == true) {
      $status = "User has been logged out";
    }
  }


  if(is_user_authenticated()) {
    redirect('php/admin.php');
    die();
  }

  //get post submit in same file
  if (isset($_POST['login'])) {
      output($_POST);
      echo 'Current PHP version: ' . phpversion();
      // filter email
      $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
      $password = $_POST['password']; // TODO : validate this!

      // compare with data store

      if (authenticate_user($email, $password)) {
        $_SESSION['email'] = $email;
        redirect('php/admin.php');
        die();
      } else {
        $status = "The provided credentials didn't work";
      }

      if ($email == false) {
        $status = 'Please enter valid email adress';
      }
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>My PHP site</title>
  </head>
  <body>


  <h1>The Get Method</h1>
    <!-- the get method -->
    <form action="/php/action_get.php" method="get">
      First name:<br>
      <input type="text" name="firstname" value="Mickey"><br>
      Last name:<br>
      <input type="text" name="lastname" value="Mouse"><br><br>
      <input type="submit" value="Submit">
    </form>


  <h1>The Post Method to external php file</h1>
  <!-- the post method to file  -->
    <form action="/php/action_post.php" method="post">
      First name:<br>
      <input type="text" name="firstname" value="Donald"><br>
      Last name:<br>
      <input type="text" name="lastname" value="Duck"><br><br>
      <input type="submit" value="Submit">
    </form>

  <h1>The Post Method to same file</h1>
  <!-- the post method  -->
    <form action="" method="POST">
      <label for="email">Email:</label>
      <input type="text" name="email" id="email" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');"/>
      <!-- autocomplete="off" readonly onfocus="this.removeAttribute('readonly');"/> ensures that form is cleared after logout -->
      <label for="password">Password:</label>
      <input  type="password" name="password" id="password" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');"/>
      <input type="submit" name="login" value="login"/>
      <!-- post name is login -->
    </form>

     <!-- message to be displayed in case of invalid email adress -->
   <div class="validate">
     <?php
      if(isset($status)){
        echo $status;
      }
      ?>
   </div>

  </body>
</html>
