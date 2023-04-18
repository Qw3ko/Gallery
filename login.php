<?php

require_once __DIR__.'/boot.php';
require_once 'gal_functions/function.php';

if (check_auth()) {
    header('Location: /');
    die;
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

      <h1 class="mb-5">Авторизация</h1>

        <?php flash() ?>

      <form method="post" action="reg & auth/do_login.php">
        <div class="mb-3">
          <label for="username" class="form-label">Логин</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Пароль</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Авторизоваться</button>
          <a class="btn btn-outline-primary" href="index.php">Зарегестрироваться</a>
        </div>
      </form>
      <br>
      <br>
      <?php
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
              <?php
              }
              ?>

    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>