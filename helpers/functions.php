<?php
function debug_array ($arr) {
  echo "<pre>";
  print_r ($arr);
  echo "<pre>";
}

function clear_xss($var) {
    return trim(htmlspecialchars($var));
}

//function for clear array value
// function clear_xss_array(){
//   $assAr = [];
//   foreach ($arrs as $arr)
// }
