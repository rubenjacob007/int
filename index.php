<?php 
session_start();
require_once('database.php');
if(isset($_GET['q']) == 'logout') {
  $_SESSION = array(); 
  session_destroy();
  header("location:index.php");
  exit();
}
if (isset($_POST['submit'])) { 
		extract($_POST);   
	    $login = $database->check_login($emailusername, $password);
	    if ($login['status']) {
	       header("location:view.php");
	    } else {
	        echo $login['message'];
	    }
	}
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>OOP Login Module</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  </head>

  <body>
    <div id="container" class="container">
      <h1>Login Here</h1>
      <form action="" method="post" name="login">
        <table class="table " width="400">
          <tr>
            <th>UserName :</th>
            <td>
              <input type="text" name="emailusername" required>
            </td>
          </tr>
          <tr>
            <th>Password:</th>
            <td>
              <input type="password" name="password" required>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
              <input class="btn" type="submit" name="submit" value="Login" onclick="return(submitlogin());">
            </td>
          </tr>

        </table>
      </form>
    </div>
    <script>
      function submitlogin() {
        var form = document.login;
        if (form.emailusername.value == "") {
          alert("Enter username.");
          return false;
        } else if (form.password.value == "") {
          alert("Enter password.");
          return false;
        }
      }
    </script>


  </body>
</html>