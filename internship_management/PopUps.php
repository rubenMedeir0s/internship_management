<?php

function popUp($message)
{
    $m = $message;
    echo '<script type="text/javascript">
       window.onload = function () { alert("'.$m.'"); } 
    </script>';
}

?>