<!-- 驗證碼 -->
<h3>第一種，自定義字串取隨機碼</h3>
<?php
$str="abcdefghijk";
$len=rand(4,7); //隨機長度
//取得字串其中之一值
// echo mb_substr($str,rand(0,(strlen($str)-1)),1);
echo "取得長度:".$len."<br>";
//取得隨機數目的隨機字元
for($i=0;$i<$len;$i++){
    echo mb_substr($str,rand(0,(strlen($str)-1)),1);
}
?>
<h3>第二種，用ASCII取值-隨機碼</h3>
<?php
//  $c=rand(65,90); 
//  echo chr($c)."<br>";
//  echo "A=>".ord('A');

/**
 * 1.英文大小寫級數字的組合
 * 2.每次產生的字串在4~8字元之間
 * 3.每次產生的排列順序不固定
 * 由於自己取字串太累了，故使用ASCII表去取值
 */

$str="";
$length=rand(4,8);
 for($i=0;$i<$length;$i++){
 $type=rand(1,3);
 //echo "type=>".$type."<br>";
 switch($type){
    case 1:
    //大寫英文 ASCII
    $str.=chr(rand(65,90));
    break;
    case 2:
    //小寫寫英文 ASCII
    $str.=chr(rand(97,122));
    break;
    case 3:
    //數字 ASCII
    $str.=chr(rand(48,57));
    break;
 }
}
 echo $str;
    //開始製作圖檔
    $dstimg=imagecreatetruecolor(200,50);
    $color=imagecolorallocate($dstimg,100,200,100);
    $black=imagecolorallocate($dstimg,0,0,0);
    imagefill($dstimg,0,0,$color);

    //imagestring($dstimg,5,10,10,$str,$black);讓圖片的字整齊排列

    for($i=0;$i<$length;$i++){
        //此迴圈讓圖片內的字呈現不對齊排列
        $c=mb_substr($str,$i,1);
        imagestring($dstimg,5,(10+$i*rand(15,20)),(10+rand(0,10)),$c,$black);

    }

    imagepng($dstimg,'captcha.png');
?>
<img src="captcha.png" alt="">