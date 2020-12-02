<?php
$errors = [];
$name = '';
$contribution = '';
$date = '';
$title ='';
$picture ='';
//$comment = '';

$pdo = new PDO('mysql:host=mysql2.webland.ch;dbname=d041e_leroth', 'd041e_leroth', '12345_Db!!!', [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = $_POST['name']    ?? '';
    $contribution   = $_POST['contribution']   ?? '';
    $date    = date('y.m.d H:i:s');
    $title    = $_POST['title']    ?? '';
    $picture = $_POST ['picture'] ??'';
    //$comment    = $_POST['comment']    ?? '';

    if (empty($name)) {
        $errors[] = 'Bitte geben Sie einen Namen ein.';
    }
    if (empty($contribution)) {
        $errors[] = 'Bitte geben Sie einen Text ein.';
    }
    if (empty($title)) {
        $errors[] = 'Bitte geben Sie einen Titel ein.';
    }
    
    if (count($errors) == 0) {
        
        $stmt = $pdo->prepare("INSERT INTO posts (created_at, created_by, post_title, post_text, picture) VALUES(:post_date, :creator, :title, :post, :picture)");
        $stmt->execute([':post_date' => $date ,':creator' => $name,':title' => $title, ':post' => $contribution, ':picture'=> $picture]);
       
        
    }
}

//if (($_GET['action']?? '') === 'all') {
$query= 'select * from posts order by created_at desc';

//}
//$query = 'select * from posts';



$stmt = $pdo -> query($query);
$rows = $stmt -> fetchAll();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leonie's Blog</title>
    <link rel="stylesheet" href="blog.css">
</head>


<body class="body">

    <h1>Leonie's Blog</h1>
   
    <?php include("nav.php");?>

    <p class="text">Herzlich Willkommen auf meinem Blog.
        <br>Unten könnt ihr eure eigenen Beiträge schreiben.
        <br>Ich freue mich auf eure Beiträge. 
    </p>
        

    <p>Drücke auf das Wort </p>
    <a href="#beitragformular">BEITRAG</a>
    <p> um einen Post zu verfassen.</p>
    <br>

    <?php foreach($rows as $rows) {
            echo '<div class="frame">';
            echo 'Name: ' . htmlspecialchars($rows ["created_by"]) 
            .' / ' . htmlspecialchars($rows ["created_at"]) .'<br>' 
            . 'Titel: ' . htmlspecialchars($rows["post_title"]) . '<br>' 
            . 'Post: ' . htmlspecialchars($rows["post_text"]) .'<br>' 
            //. 'Kommentar: ' . htmlspecialchars($rows ["comment"]) 
            . '<img id="picture" src="' . htmlspecialchars($rows["picture"]) . '" alt="">';

 
            
            
            //echo '<div><a href="blog.php" class="btn">gut</a>/<a href="blog.php" class="btn">schlecht</a></div>';



            echo '</div><br>';
            
        }
        ?>
        
        <?php
        if(count($errors) > 0) : 
        ?>
    
            <div class="error-box"> 
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            
            </div>
        <?php endif; ?>
        
        <form action="blog.php" method="post" id="beitragformular">
            <legend class="form-legend"><br>Ihr eigener Beitrag:<br>
            </legend>
            <div class="form-group">
                <label class="form-label" for="name">Ihr Name<br></label>
                <input class="form-control" type="text" id="name" name="name" value="<?= $name ?>">
            </div>

            <div class="form-group">
                <label class="form-label" for="title">Ihr Titel<br></label>
                <input class="form-control" type="text" id="title" name="title" value="<?= $title ?>">
            </div>



            <div class="form-group">
                <label for="contribution" class="contribution">Was möchten Sie uns Mitteilen?<br></label>
                <textarea name="contribution" id="contribution" rows="5" class="contribution"><?= $contribution ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="picture">Link für ein Bild (optional)<br></label>
                <input class="form-control" type="text" id="picture" name="picture" value="<?= $picture ?>">
                
            </div>
        
            <div class="form-actions">
            <br>
                <input class="btn btn-primary" type="submit" value="Beitrag posten" name="post-btn">
                <a href="blog.php" class="btn">Beitrag abbrechen</a>
            </div>


        </form>
</body>
</html>