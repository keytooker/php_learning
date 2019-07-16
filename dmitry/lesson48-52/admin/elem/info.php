<?php
if ( isset($_SESSION['message']) )
{
    $status = $_SESSION['message']['status'];
    $text = $_SESSION['message']['text'];
    ?>

    <p class="<?php echo $status; ?>"> <?= $text ?> </p>

    <?php
    unset($_SESSION['message']);
}