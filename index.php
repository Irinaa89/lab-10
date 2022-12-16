<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>LR-10</title>
  </head>
  <body>
    <div class="wrapper">
        <form method="POST" action="./analysis.php">
        <div class="text-input">
            <h1>Введите текст для анализа</h1>
            <textarea
            name="text"
            id="text"
            cols="30"
            rows="10"
            placeholder="Введите текст..."
            ></textarea>
        </div>
            <button class="analysis">Анализировать</button>
        </form>
    </div>
  </body>
</html>
