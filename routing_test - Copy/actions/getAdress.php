<?php 
$data = file_get_contents("php://input");
$user = json_decode($data, true);

function getAddressFromCoordinates($latitude, $longitude, $apiKey) {
    $url = "https://api.opencagedata.com/geocode/v1/json?q=$latitude+$longitude&key=$apiKey";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data['status']['code'] === 200) {
        $addressComponents = $data['results'][0]['components'];
        $address = $data['results'][0]['formatted'];
        return [$address, $addressComponents];
    } else {
        return false;
    }
}
?>