<?php
if (isset($_SESSION['user'])) {
    header("Location: views/archivosView.php");
    exit;
}else {
    header("Location: views/archivosView.php");
    exit;
}

?>
<html>
    <body>

    </body>
</html>