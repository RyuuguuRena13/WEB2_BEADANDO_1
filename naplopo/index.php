<?php
    require_once "app/init.php";
    $bootstrap = new Bootstrap();
    $pc = new PermissionChecker();
    $pc->CheckPagePermission();
    UserHandler::Logout();
?>

<!DOCTYPE html>
<html lang="hu">
    <?php
        $bootstrap->LoadHead();
    ?>
<body>
    <?php
        $bootstrap->LoadHeader();
        $bootstrap->LoadPage();
    ?>
</body>
</html>