<?php

if (isset($_GET['l']) and (!empty($_GET['l']))){
    $glicense = $_GET['l'];
    $license = "5715e6e8-0650-4015-82b6-711bf2a3127b";
    if ($glicense == $license){
        echo 1;
    } else {
        echo -1;
    }
} else {
    echo 0;
}

?>