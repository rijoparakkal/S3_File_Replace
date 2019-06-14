<?php
#exit;
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\ObjectUploader;

$s3Client = new Aws\S3\S3Client([
     'credentials' => [
        'key'    => 'Key ID',
        'secret' => 'Secret Key'
        ],
    #'profile' => 'default',
    'region' => $region,
    'version' => '2006-03-01'

]);


if(isset($_POST['submit'])){
#echo $_POST['tname'];
    if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){

                //save the filename
                $shortname = $_FILES['upload']['name'][$i];

                //save the url and the file
                $filePath = "uploaded/" .$_FILES['upload']['name'][$i];

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    //insert into db
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file

                }
              }
        }}



    $file = 'urls.txt';
    if(file_exists($file))
    {
      file_put_contents($file,$_POST['comment1']);
    }
#echo $_POST['comment1'];
    //show success message
    echo "<h1>Uploaded:</h1>";
    if(is_array($files)){
        echo "<ul>";
        foreach($files as $file){
            echo "<li>$file</li>";
        }
        echo "</ul>";
    }




$bucket = $_POST['bucket'];
$region = $_POST['region'];

    
}




foreach(file('urls.txt') as $line) 
{
#$echo $line;
$line=trim($line);
$parts = parse_url($line);
#echo '<pre>';
#$str = file_get_contents($line);
$name = basename($line);
#echo '<pre>';
#echo $name;
$name=trim($name);
#$name = str_replace(' ','',$name);
#$name = str_replace('_','',$name);
$path=parse_url($line,PHP_URL_PATH);
#var_dump(parse_url($line, PHP_URL_PATH));
#echo $path;
$scondpath=str_ireplace("/".$bucket."/","",$path);
$scondpath=trim($scondpath);
#echo $scondpath;
#$scondpath = str_replace(' ','',$scondpath);
#$scondpath = str_replace('_','',$scondpath);




$key = $scondpath;
#echo $key;
// Using stream instead of file path

$source = fopen('uploaded/'.trim($name), 'rb');


$acl='public-read';

$uploader = new ObjectUploader(
    $s3Client,
    $bucket,
    $key,
    $source,
    $acl
);

do {
    try {
        $result = $uploader->upload();
        if ($result["@metadata"]["statusCode"] == '200') {
            print('<p>File successfully uploaded to ' . $result["ObjectURL"] . '.</p>');
        }
        #print($result);
    } catch (MultipartUploadException $e) {
        rewind($source);
        $uploader = new MultipartUploader($s3Client, $source, [

            'state' => $e->getState(),
        ]);
    }
} while (!isset($result));


}
$files = glob('uploaded/*'); //get all file names
foreach($files as $file){
    if(is_file($file))
    unlink($file); //delete file
}

?>

