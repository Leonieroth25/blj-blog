<?php
$name    = $_POST['name']    ?? '';
$contribution   = $_POST['contribution']   ?? '';

if ($name === '') {
    $errors[] = 'Bitte geben Sie einen Namen ein.';
}
if ($contribution === '') {
    $errors[] = 'Bitte geben Sie einen Text ein.';
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leonie's Blog</title>
    <link rel="stylesheet" href="blog.css">
</head>


<body>
    <h1>Leonie's Blog</h1>
   
    <?php include("nav.php");?>


    <p>Dies ist mein erster Blog Beitrag. Ich hoffe er gefällt euch.
        <br>Unten könnt ihr eure eigenen Beiträge schrieben oder die anderen kommentieren/bewerten.
        <br>Ich freue mich auf eure Beiträge. 
        <br>Liebe Grüsse Leonie
    </p>


        <?php if(count($errors) > 0) : ?>
            <div class="error-box">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            </div>
        <?php endif; ?>
        <form action="blog.php" method="post">
        <legend class="form-legend">Ihr eigener Beitrag:<br><br></legend>
                <div class="form-group">
                    <label class="form-label" for="name">Ihr Name<br></label>
                    <input class="form-control" type="text" id="name" name="name" value="<?= $name ?? '' ?>">
                </div>

                <div class="form-group">
                    <label for="note" class="form-label">Was möchten Sie uns Mitteilen?<br></label>
                    <textarea name="note" id="contribution" rows="3" class="contribution"><?= $contribution?></textarea>
                </div>

            <div class="form-actions">
                <input class="btn btn-primary" type="submit" value="Beitrag posten">
                <a href="blog.php" class="btn">Beitrag abbrechen</a>
            </div>

</body>
</html>