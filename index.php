<?php
$mails = array(
'salon@etnabride.ru',
//'simirykova@mail.ru',
//'03rus@mail.ru',
'07klas07@mail.ru',
'1_jw@mail.ru',
'110684.84@mail.ru',
'15olga66@mail.ru',
'2031393@mail.ru',
);

?>

<form action="/validation.php" method="post">
    <?php foreach ($mails as $mail): ?>
        <input type="text" name="mails[]" value="<?php echo $mail; ?>" />
    <?php endforeach; ?>
    <input type="submit" name="submit"/>
</form>

