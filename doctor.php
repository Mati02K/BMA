
<?php
session_start();
if(isset($_POST["doctor"]))
{
if(isset($_SESSION["username"]))
{
require ("config.php");
require ("shaping.php");

$patientname = cryptfun("decrypt", $_SESSION["username"]);

$sql= "SELECT * FROM doctor_table WHERE availability = 1 ";

$result=mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

if($row>0)
{
$sno = $row["sno"];
                
$doctor_name= $row["doctor_name"];

$hospital_name= $row["hospital_name"];

$contact_no= $row["contact_no"];
            
echo "The Doctor Name assigned to you is ".$doctor_name ." from Hospital ". $hospital_name ." and his contact no is ". $contact_no ;

$fields = array(
    "message" => "Message From BMA. You have been assigned for consulting patient .$patientname. Pls Contact the Patient for further Details.",
    "language" => "english",
    "route" => "q",
    "numbers" => $contact_no,
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
    "authorization: 3aO84tliq1ycM5Hd2Nv9JUZwkXTGjxpPgfWYKLCuzFE7QInsboZrsB8NFW7lLHcfmhuXbGYM9pv13IQ0",
    "accept: */*",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }

$position = "UPDATE doctor_table SET availability = 0 WHERE sno='".$sno."'";
$change=mysqli_query($conn,$position);
}
else
{
    echo "No Doctor Free at the Moment. Contact after sometime..";
}
}
else
{
    echo "Pls Login First To Book Doctor Appoinment"; 
}
}
else
{
    echo "Invalid Request";
}


?>

