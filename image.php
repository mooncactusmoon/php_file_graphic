<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳圖案機制
 * 3.取得圖檔資源
 * 4.進行圖形處理
 *   ->圖形縮放
 *   ->圖形加邊框
 *   ->圖形驗證碼
 * 5.輸出檔案
 */

 if(isset($_FILES['img']['tmp_name'])){
     move_uploaded_file($_FILES['img']['tmp_name'] , 'img/'.$_FILES['img']['name']);

     switch($_FILES['img']['type']){
         case "image/jpeg":
            $srcimg=imagecreatefromjpeg('img/'.$_FILES['img']['name']);
         break;
         case "image/png":
            $srcimg=imagecreatefrompng('img/'.$_FILES['img']['name']);
         break;
         case "image/gif":
            $srcimg=imagecreatefromgif('img/'.$_FILES['img']['name']);
         break;
         case "image/bmp":
            $srcimg=imagecreatefrombmp('img/'.$_FILES['img']['name']);
         break;
     }
     $dstimg=imagecreatetruecolor(240,180);
    //   imagecopyresampled($dstimg,$srcimg,0,0,0,0,240,180,573,956);
    //   $fileName='img/'.explode(".",$_FILES['img']['name'])[0]."_small.png";
    //   imagepng($dstimg,$fileName);

     //定義顏色，並且覆蓋上去(此效果讓邊界變白)
     $white=imagecolorallocate($dstimg,255,255,255);
     imagefill($dstimg,0,0,$white);

     //讓圖片縮小並多了黑色邊界
     imagecopyresampled($dstimg,$srcimg,20,23,0,0,95,57,956,573);
     $fileName='img/'.explode(".",$_FILES['img']['name'])[0]."_small.png";
     imagepng($dstimg,$fileName);

 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文字檔案匯入</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="header">圖形處理練習</h1>
<!---建立檔案上傳機制--->

<form action="?" method="post" enctype="multipart/form-data">
    <p><input type="file" name="img"></p>
    <p><input type="submit" value="上傳"></p>
</form>

<!----縮放圖形----->
<?php
if(isset($_FILES['img']['name'])){
?>

<div>你上傳的圖片為 : </div><br>
<img src='img/<?=$_FILES['img']['name'];?>'>
<div>縮放後 : </div><br>
<img src='<?=$fileName;?>'>
<?php
}
?>

<!----圖形加邊框----->


<!----產生圖形驗證碼----->



</body>
</html>