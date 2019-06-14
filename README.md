# S3_Replace
## Steps for setting up the application in local machine or servers
* clone the repository 
* Add the AWS CLI access key and secret key in uploadaction.php
```
$s3Client = new Aws\S3\S3Client([
     'credentials' => [
        'key'    => 'Key ID',
        'secret' => 'Secret Key'
        ],
    #'profile' => 'default',
    'region' => $region,
    'version' => '2006-03-01'

]);
```
* Access the URL : http://localhost/S3_Replace/fileupload.php
* Upload the files and enter the URLs
