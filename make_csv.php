<?php
$dsn="mysql:host;charset=utf8;dbname=file_uploaded";
$pdo=new PDO($dsn,'root','');

if(isset($_GET['do'])){
    switch($_GET['do']){
        case 1:
            $rows=$pdo->query("select * from users where status='2'")->fetchAll();
        break;

        case 2:
            $rows=$pdo->query("select * from users where status='1'")->fetchAll();
        break;

        case 3:
            $rows=$pdo->query("select * from users where status='0'")->fetchAll();
        break;
    }
    //w+適合用於完全沒東西的資料上要新增東西
    $file=fopen('result.csv','w+');

}else{
    $file=fopen('result.csv','w+');
    $rows=$pdo->query("select * from users")->fetchAll();
}



echo "<ul>";
foreach($rows as $key => $row){
    echo "<li>";
    echo $row[0].",".$row[1].",".$row[2].",".$row[3];
    echo "</li>";
    fwrite($file,$row[0].",".$row[1].",".$row[2].",".$row[3]."\r\n");
}
echo "</ul>";

fclose($file);
?>

<a href="?do=1">下載已施打兩劑的名單</a>&nbsp;&nbsp;
<a href="?do=2">下載已施打一劑的名單</a>&nbsp;&nbsp;
<a href="?do=3">下載未施打的名單</a>

<?php
// 有被建立才出現
if(file_exists('result.csv')){
    echo "<a href='result.csv' download>下載檔案</a>";
}

?>