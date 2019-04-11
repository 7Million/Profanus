# Profanus
A simple to configure PHP Profanity filter, best for chats 

### Configuration:
You must start by populating the **bad words** array either direct in the code  **OR** make a simple list inside the **blacklist.txt**
When populating the text file, the most important rule is:
- each bad word must be on a new line
- bad words be listed in small caps

The text file has some sample bad words, just follow along with the structure.
To use the class in your code, simply follow the steps below (you can clone or download the package):
```php
require "Profanus.php";

$sentence = "The sexy ass bitch";
$clean = new Profanus();
$censored = $clean->censor($sentence);

echo $censored;
```
#### Simple example with form:
```php
<?php

require "Profanus.php";

if (isset($_POST['btnSubmit'])) {

  $sentence = $_POST['string_pass'];
  $clean = new Profanus();
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
        <input type="submit" name="btnSubmit" value="Profanity Filter">
    </form>
  </body>
</html>
```
#### Censor First word only (if neccessary)
```php
$sentence = "Bitch you hot";
$clean = new Profanus();
$censored = $clean->censor_first_word($sentence);
echo $censored;
```
##### Output:
`***** you hot`

:v:
