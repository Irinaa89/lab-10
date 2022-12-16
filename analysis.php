<?php

$text = $_POST['text'];
$text = iconv("utf-8", "cp1251", $text);

$letters_count = 0;
$lowercases_count = 0;
$capitals_count = 0;
$punctuation_marks_count = 0; 
$digits_count = 0;
$words_count = 0;


function test_symbs( $text ) { 
    $symbs=array(); // массив символов текста
    $l_text=strtolower( $text ); // переводим текст в нижний регистр
    // последовательно перебираем все символы текста
    for($i=0; $i<strlen($l_text); $i++) 
    { 
    if( isset($symbs[$l_text[$i]]) ) // если символ есть в массиве 
    $symbs[$l_text[$i]]++; // увеличиваем счетчик повторов
    else // иначе
    $symbs[$l_text[$i]]=1; // добавляем символ в массив
    } 
    return $symbs; // возвращаем массив с числом вхождений символов в тексте
} 

function test_it( $text ) { 
    // количество символов в тексте определяется функцией размера текста
    // echo 'Количество символов: '.strlen($text).'<br>'; 
    // определяем ассоциированный массив с цифрами
    $cifra=array( '0'=>true, '1'=>true, '2'=>true, '3'=>true, '4'=>true, 
    '5'=>true, '6'=>true, '7'=>true, '8'=>true, '9'=>true ); 
    // вводим переменные для хранения информации о: 
    $cifra_amount=0; // количество цифр в тексте
    $word_amount=0; // количество слов в тексте
    $word=''; // текущее слово
    $words=array(); // список всех слов
    for($i=0; $i<strlen($text); $i++) // перебираем все символы текста
    { 
    if( array_key_exists($text[$i], $cifra) ) // если встретилась цифра
    $cifra_amount++; // увеличиваем счетчик цифр
    // если в тексте встретился пробел или текст закончился
    if( $text[$i]==' ' || $i==strlen($text)-1 ) 
    { 
    if( $word ) // если есть текущее слово
    { 
    // если текущее слово сохранено в списке слов
    if( isset($words[$word]) ) 
    $words[ $word ]++; // увеличиваем число его повторов
    else 
    $words[ $word ]=1; // первый повтор слова
    } 
    $word=''; // сбрасываем текущее слово
    } 
    else // если слово продолжается
    $word.=$text[$i]; //добавляем в текущее слово новый символ
    } 
    // выводим количество цифр в тексте
    // echo 'Количество цифр: '.$cifra_amount.'<br>'; 
    // выводим количество слов в тексте
    // echo 'Количество слов: '.count($words).'<br>'; 

    return count($words);
} 



test_it($_POST['text']);
$symbsArray = test_symbs($text);



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Analysis</title>
  </head>
  <body>
    <div class="wrapper">
      <div class="text-input">
        <h1>Исходный текст</h1>
        <textarea cols="30" rows="10" disabled><?=strlen($text) == 0 ? "Нет исходного текста" : iconv("cp1251", "utf-8", $text);?></textarea>
      </div>
      <div class="text-info">
        <h2>Информация о тексте</h2>
        <p>Кол-во символов: <span><?= strlen($text) ?></span></p>
        <p>Кол-во букв: <span><?= preg_match_all("/[a-z]|[а-я]/i", $text) ?></span></p>
        <p>Кол-во строчных букв: <span><?= preg_match_all("/[a-z]|[а-я]/", $text) ?></span></p>
        <p>Кол-во заглавных букв: <span><?= preg_match_all("/[A-Z]|[А-Я]/", $text) ?></span></p>
        <p>Кол-во знаков препинания: <span><?= preg_match_all("/[.,?!;:`']/", $text) ?></span></p>
        <p>Кол-во цифр: <span><?= preg_match_all("/\d/", $text) ?></span></p>
        <ul>Кол-во букв:
            <?php 

            foreach ($symbsArray as $key => $value) {
                echo "<li>".iconv("cp1251", "utf-8", $key).": ".iconv("cp1251", "utf-8", $value)."</li>";
            }
           
            
            ?>
        </ul>
        <p>Кол-во слов: <span><?= test_it($text) ?></span></p>
      </div>
      <form method="POST" action="./index.php">
        <button type="">Другой анализ</button>
      </form>
    </div>
  </body>
</html>
