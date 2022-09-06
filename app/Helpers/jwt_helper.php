<?php

use App\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($headerAuthentication)
{
  if (is_null($headerAuthentication)) {
    throw new Exception("JWT Authentication Failed");
  }
  $token = explode(" ", $headerAuthentication);
  return $token[1];
}

function validateJWT($encodedToken)
{
  $key = getenv('JWT_SECRET_KEY');
  $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
  $userModel = new UserModel();
  $userModel->getEmail($decodedToken->email);
}

function createJWT($email)
{
  $timeRequest = time();
  $timeToken = getenv('JWT_TIME_TO_LIVE');
  $timeExpired = $timeRequest + $timeToken;
  $payload = [
    'email' => $email,
    'iat' => $timeRequest,
    'exp' => $timeExpired
  ];
  $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');
  return $jwt;
}
