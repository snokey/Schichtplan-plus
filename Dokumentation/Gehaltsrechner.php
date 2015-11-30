<?php
  $hours = $_POST["Stunden"];
  $rate = $_POST["Stundenlohn"];
  $name = $_POST["Name"];
  $gross = $hours * $rate;  
  echo $name.', du hast '.$hours.' stunden gearbeitet. Bei einem Lohn von $'.$rate.' pro Stunde. <br />';
