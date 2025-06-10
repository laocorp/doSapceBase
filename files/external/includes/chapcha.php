<?php

$secret = "6LdTDnsiAAAAAHMI-1NkG6IfPXV_7zDsifT-fimx";
 $response = null;
 // comprueba la clave secreta
 $reCaptcha = new ReCaptcha($secret);


 

 if ($response != null && $response->success) {
    // Si el código es correcto, seguimos procesando el formulario como siempre
  } else {
 echo "error";
  } 
  
  ?>