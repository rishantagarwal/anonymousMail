<?php
    session_start() or die("session start");
?>
<?php
    //session_unset() or die("session unset");
    session_destroy() or die("session destroy");
    //session_unset();
    session_start() or die("session start");
    session_regenerate_id();
    header('Location: index.php'); 
?>
