<?php
    use App\Service\Page\Page;
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once APP_PATH . "/views/components/header.php"?>
<body>
<main class="main__block">
    <?php require_once APP_PATH . "/views/components/alert.php"?>

    <?php require_once APP_PATH . "/views/components/endGame.php"?>

    <div class="main__block_colored">
        <div class="grid-3-row">

            <?php require_once APP_PATH . "/views/components/field.php"?>
        </div>
    </div>
</main>
<script src="../../assets/js/script.js"></script>
</body>
</html>
