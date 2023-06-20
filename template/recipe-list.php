<?php

if (empty($text)) echo "no variable text";
if (empty($container)) echo "no variable container";

?>

<li class="textarea-wrapper">
    <div class="wrapper-grid">
        <textarea name="<?php echo $container ?>[]" rows="1"><?php echo $text ?></textarea>
        <img src="../img/trash.ico" width=32 height=32 class="delete button">
    </div>
</li>