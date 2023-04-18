<?php
require_once __DIR__.'/boot.php';
require_once 'gal_functions/function.php';

$user = null;

if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Галлерея</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>

<div class="container">
  <div class="row py-5">
    <div class="col-lg-6">

        <?php if ($user) { ?>

          <h1>Добро пожаловать, <?=htmlspecialchars($user['username'])?>!</h1>

          <form class="mt-5" method="post" action="reg & auth/do_logout.php">
            <button type="submit" class="btn btn-primary">Выйти</button>
          </form>
          <br>
          <h2>Загрузить фотографию</h2>
            <form action="gal_functions/upload.php" method="post" enctype="multipart/form-data">
                <br>
                <p><input type="file" name="file"></p>
                <br>
                <p>Комментарий: <input type="text" name="comment"></p>
                <br>
                <p><input type="submit" name="load" value="Загрузить файл"></p>
                
                <br>
            </form>
            <?php
            //вывод картинок
            $dir = "img_small"; // Путь к директории, в которой лежат малые изображения
            $files = scandir($dir); // Получаем список файлов из этой директории
            $files = excess($files); // Удаляем лишние файлы c '.' ...
            
            /* Дальше происходит вывод картинок на страницу сайта */
            for ($i = 0; $i < count($files); $i++)
            {
              ?>
              <!-- Делаем ссылку на страницу с большой картинкой, вывод малых картинок -->

              <a href="img_big/<?=$files[$i]?>"><img src="<?=$dir . "/" . $files[$i]?>" alt="Фото галереи" /></a>
              <p>Комментарий: <?php getComment($files[$i]); ?><br>
                 Автор: <?php getUser($files[$i]); ?><br>
                 Дата: <?php getDateNow($files[$i]); ?>
              </p>
              <?php echo "<a href='gal_functions/delete.php?file=".$files[$i]."'>".'Удалить'."</a>";?>
              <br>
              <br>
              <?php
              }
              ?>

        <?php } else { ?>

          <h1 class="mb-5">Регистрация</h1>

            <?php flash(); ?>

          <form method="post" action="reg & auth/do_register.php">
            <div class="mb-3">
              <label for="username" class="form-label">Логин</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Пароль</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">Зарегестрироваться</button>
              <a class="btn btn-outline-primary" href="login.php">Авторизоваться</a>
            </div>
          </form>
          <br>
          <br>
          <?php
        //вывод картинок
        $dir = "img_small"; // Путь к директории, в которой лежат малые изображения
        $files = scandir($dir); // Получаем список файлов из этой директории
        $files = excess($files); // Удаляем лишние файлы c '.' ...
        /* Дальше происходит вывод картинок на страницу сайта */
        for ($i = 0; $i < count($files); $i++)
        {
          ?>
          <!-- Делаем ссылку на страницу с большой картинкой, вывод малых картинок -->

          <a href="img_big/<?=$files[$i]?>"><img src="<?=$dir . "/" . $files[$i]?>" alt="Фото галереи" /></a>
              <p>Комментарий: <?php getComment($files[$i]); ?><br>
                 Автор: <?php getUser($files[$i]); ?><br>
                 Дата: <?php getDateNow($files[$i]); ?><br>
              </p>
          <?php
        }
        ?>
        <?php } ?>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>