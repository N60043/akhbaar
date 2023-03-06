
<?php
$hostNameDb1="59.103.86.6";
$userNameDb1="news_local";
$passwordDb1="Killer@1122";
$dbNameDb1="newsportal";
$portDb1="302";
$hostNameDb2="127.0.0.1";
$userNameDb2="root";
$passwordDb2="";
$dbNameDb2="mobileakhbaar";
$portDb2="3306";
$connLiveDb =new mysqli($hostNameDb1,$userNameDb1, $passwordDb1,$dbNameDb1,$portDb1);
// Check connection
if ($connLiveDb->connect_error) {
  die("Connection failed: " . $connLiveDb->connect_error);
}
echo "Connected successfully";
$connLocalDb =new mysqli($hostNameDb2,$userNameDb2, $passwordDb2,$dbNameDb2,$portDb2);
if ($connLocalDb->connect_error) {
  die("Connection failed: " . $connLocalDb->connect_error);
}
echo "Connected successfully";
mysqli_query($connLiveDb,"SET NAMES utf8");
$sql ="SELECT news_id,title,date,description,summary,news_category_id,status,breaking_news,news_speciality_id,img_features,news_reporter_id,newspaper_id,guid
 FROM news order by news_id desc limit 5000";
if($result = mysqli_query($connLiveDb, $sql))
{
    if(mysqli_num_rows($result) > 0)
    {
        $i=0;
        while($row = mysqli_fetch_array($result))
        {
           if($row)
           {
            $title=$row['title'];
            $date=$row['date'];
            $description=$row['description'];
            $summary=$row['summary'];
            $news_category_id=$row['news_category_id'];
            $status=$row['status'];
            $breaking_news=$row['breaking_news'];
            $news_speciality_id=$row['news_speciality_id'];
            $img_features=$row['img_features'];
            $news_reporter_id=$row['news_reporter_id']; 
            $newspaper_id=$row['newspaper_id'];
            $guid=$row['guid'];
            $query=mysqli_query($connLocalDb,"INSERT INTO news(title,api_Date,description,summary,news_category_id,status,breaking_news,                news_speciality_id,img_features,news_reporter_id,newspaper_id,guid) 
                               VALUES ('$title','$date','$description','$summary','$news_category_id','$status','$breaking_news','$news_speciality_id','$img_features','$news_reporter_id',' $newspaper_id','$guid')");
              if($query)
              {
                echo "Data Inserted Successfully";
              }
              else
              {
                 echo "Error while Inserted Record";
              }
            $i++;
           }
           else
           {
            echo "No Data Selected";
           }
        }
      }
    mysqli_free_result($result);
}
else
{
  echo "ERROR: Could not able to execute";
}
?>