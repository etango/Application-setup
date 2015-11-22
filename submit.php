<?php

echo "Hi";
sesion_start();
var_dump($_POST);
if(!empty($_POST)){
  echo $_POST['useremail'];
  '
}

else
{
  echo "empty";
}

