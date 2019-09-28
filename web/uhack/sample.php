

<?php
$homepage = file_get_contents('http://ec2-18-140-54-91.ap-southeast-1.compute.amazonaws.com/multichain-web-demo/?chain=default');
echo $homepage;
?>

<style>
 #navbar {
         background-color:#E43527 !important;
 }

 .navbar-default .navbar-collapse, .navbar-default .navbar-form {
         border: 0 none !important;
 }

 .navbar-default {
         background-color:#E43527 !important; 
         border-color: #E43527 !important;
 }

 h1 {
         font-size: 14px;
 }

 .content-inner {
         background-color: red;
 }

</style>