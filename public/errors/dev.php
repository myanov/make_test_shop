<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ошибка</title>
</head>
<body>
    <p>Название ошибки: <?= $errno; ?></p>
    <p>Сообщение: <?= $errstr; ?></p>
    <p>Файл: <?= $errfile; ?></p>
    <p>Строка: <?= $errline; ?></p>
</body>
</html>