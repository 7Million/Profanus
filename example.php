<?php
require "Profanus.php";
$clean = new Profanus();

if (isset($_POST['btnSubmit'])) {

  $sentence = $_POST['string_pass'];
  // $censored = $clean->censor_first_word($sentence);
  $censored = $clean->censor($sentence);
  echo $censored;

}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="#" method="post">
        <input type="text" name="string_pass">
        <input type="submit" name="btnSubmit" value="Check">
    </form>
  </body>
</html>
