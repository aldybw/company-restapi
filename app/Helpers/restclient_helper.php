<?php

use App\Models\TokenModel;

function restAPIAccess($method, $url, $data)
{
  $client = \Config\Services::curlrequest();
  // $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InRlc3RAZ21haWwuY29tIiwiaWF0IjoxNjYyNDY3OTU1LCJleHAiOjE2NjI0NzE1NTV9.MVJBRXRI9tKD2-nCCaQ8x9Wu9C2arXyltiUSLHqkAg0";
  $model = new TokenModel();
  $idToken = "1";
  $token = $model->getToken($idToken);
  $tokenPart = explode('.', $token);
  $payload = $tokenPart[1];
  $decode = base64_decode($payload);
  $json = json_decode($decode, true);
  $exp = $json['exp'];
  $currentTime = time();
  if ($exp <= $currentTime) {
    $url = "http://localhost/company-restapi/public/users";
    $form_params = [
      'email' => 'test@gmail.com',
      'password' => 'test'
    ];
    echo $form_params;
    $response = $client->request('POST', $url, [
      'form_params' => $form_params,
      'http_errors' => false
    ]);
    $response = json_decode($response->getBody(), true);
    $token = $response['access_token'];
    $dataToken = [
      'id' => $idToken,
      'token' => $token
    ];
    $model->save($dataToken);
  }

  $headers = [
    'Authorization' => 'Bearer ' . $token
  ];

  $response = $client->request($method, $url, [
    'headers' => $headers,
    'http_errors' => false,
    'form_params' => $data
  ]);
  return $response->getBody();
}
