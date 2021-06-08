<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Knight Movements</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>

  
<table>
<?php

// rows(satırlar) ve cols(sutunlar) adında iki dizi oluşturalım..
$rows = [8,7,6,5,4,3,2,1];
$cols = ["a","b","c","d","e","f","g","h"];

//Bu dizilerden rand metoduyla rastgele atın bir kare seçelim // activeSquare
$activeSquare = $cols[rand(0,7)].$rows[rand(0,7)];

// aktif kareyi parametrelerine ayıralım. Daha sonra diziler üzerinde kaydırma yapabilmek için.
// örneğin aktif kare e4 ise "e" ve "4" olarak ayır.
$first_parameter = chunk_split($activeSquare)[0];   // e
$second_parameter = chunk_split($activeSquare)[1];  // 4

//diziler üzerinde kaydırma yapabilmek için indexlerine erişelim.
$col = array_search($first_parameter, $cols);
$row = array_search($second_parameter, $rows);

// burada atın hareketlerini taklit edelim
// bunun için iki yöntem var: 
// 1.yöntem 2 git 1 dön ; 2.yöntem ise 1 git 2 gün
// bunun için atın bulunduğu kareye index bazında ekleme ve çıkarma yaparak 
// atın gidebileceği yerleri belirleyelim
$col_plus_2 = $col + 2 ; // cols
$row_plus_1 = $row + 1;  // rows

$col_minus_2 = $col - 2;
$row_minus_1 = $row - 1; 

$row_plus_2 = $row + 2;
$col_plus_1 = $col + 1;

$row_minus_2 = $row - 2;
$col_minus_1 = $col - 1;

// şimdi kontrolleri yapalım.
// ekleme ve çıkarma yaptığımız indexlerin 7 den büyük ve -1 den küçük olmaması gerekiyor.
// atın max gideceği 8 kare var. bu karelere step_1, step_2 ... şeklinde isimlendirelim.
// "square_to_go" adında atın gideceği kareleri tutacak bir boş dizi olusturalım.
// eğer indexler 7 den küçük ve -1 den büyükse step değerinlerini "square_to_go" dizisine atayalım. 

// ilk adım: cols dizisinde 2 indis sağa kaydırıp ve rows dizisinde 1 sağa/yukarı kaydıralım.
// örneğin: active kare e4 olsun. "e"yi cols dizisinde 2 sağa kaydırırsak "g" olur.
// "4"ü rows dizisinde 1 sağa/tahtaya göre yukarı kaydırırsak "5" olur.
// sonra bu indexleri step_1 birleştirip atalım. sonuç: step_1="g5" . atın gidegceği ilk kare.
// diğer adımlarda benzer şekilde..

$square_to_go = [];

if(($col_plus_2 < 8) && ($row_plus_1 < 8)){
  $step_1 = $cols[$col_plus_2].$rows[$row_plus_1];
  array_push($square_to_go, $step_1);
}
if (($col_plus_2 < 8) && ($row_minus_1 > -1)){
  $step_2 = $cols[$col_plus_2].$rows[$row_minus_1];
  array_push($square_to_go, $step_2);
}
if(($col_minus_2 > -1) && ($row_plus_1 < 8)){
  $step_3 = $cols[$col_minus_2].$rows[$row_plus_1];
  array_push($square_to_go, $step_3);
}
if(($col_minus_2 > -1) && ($row_minus_1 > -1)){
  $step_4 = $cols[$col_minus_2].$rows[$row_minus_1];
  array_push($square_to_go, $step_4);
}
if(($col_plus_1 < 8) && ($row_plus_2 < 8)){
  $step_5 = $cols[$col_plus_1].$rows[$row_plus_2];
  array_push($square_to_go, $step_5);
}
if (($col_plus_1 < 8) && ($row_minus_2 > -1)){
  $step_6 = $cols[$col_plus_1].$rows[$row_minus_2];
  array_push($square_to_go, $step_6);
}
if(($col_minus_1 > -1) && ($row_plus_2 < 8)){
  $step_7 = $cols[$col_minus_1].$rows[$row_plus_2];
  array_push($square_to_go, $step_7);
}
if(($col_minus_1 > -1) && ($row_minus_2 > -1)){
  $step_8 = $cols[$col_minus_1].$rows[$row_minus_2];
  array_push($square_to_go, $step_8);
}

echo "<caption> 
  Active Square : ". $activeSquare .
    "<a href='".$_SERVER['PHP_SELF'] ."'>
    Refresh
    </a>
  </captain>";

foreach ($rows as $row){
   echo "<tr>";
   	foreach ($cols as $col){
      $id = $col.$row;
         if($activeSquare===$id){
          echo "<td class='knight'>";
         }
         elseif(in_array($id, $square_to_go)){
          echo "<td class='bg-red'>";
         }else{
          echo "<td>";
         };
         echo "</td>";
    }
   echo "</tr>";
}
?>
</table>
</body>
</html>
