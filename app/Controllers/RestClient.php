<?php

namespace App\Controllers;

class RestClient extends BaseController
{
    public function index()
    {
        // $client = \Config\Services::curlrequest();
        // $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InRlc3RAZ21haWwuY29tIiwiaWF0IjoxNjYyNDY1MjM4LCJleHAiOjE2NjI0Njg4Mzh9.6HNNL_6HpMNA8AkXN5bc4P9uPu5pNB1oVx6CTe5Ib4s";

        // $headers = [
        //     'Authorization' => 'Bearer ' . $token
        // ];
        // READ
        // $url = "http://localhost/company-restapi/public/employees/1";
        // $response = $client->request('GET', $url, ['headers' => $headers, 'http_errors' => false]);

        // CREATE
        // $url = "http://localhost/company-restapi/public/employees";
        // $data = [
        //     'name' => 'Hawking',
        //     'email' => 'hawking@gmail.com'
        // ];
        // $response = $client->request('POST', $url, [
        //     'form_params' => $data,
        //     'headers' => $headers,
        //     'http_errors' => false
        // ]);


        // UPDATE
        // $url = "http://localhost/company-restapi/public/employees/3";
        // $data = [
        //     'name' => 'Hawking2',
        //     'email' => 'hawking2@gmail.com'
        // ];
        // $response = $client->request('PUT', $url, [
        //     'form_params' => $data,
        //     'headers' => $headers,
        //     'http_errors' => false
        // ]);

        // UPDATE
        // $url = "http://localhost/company-restapi/public/employees/3";
        // $response = $client->request('DELETE', $url, [
        //     'headers' => $headers,
        //     'http_errors' => false
        // ]);
        // echo $response->getBody();

        helper(['restclient']);
        $url = "http://localhost/company-restapi/public/employees";
        $data = [
            // 'name' => 'Justin2',
            // 'email' => 'justin@gmail.com'
        ];
        $response = restAPIAccess('GET', $url, $data);
        // echo $response;
        // $data_array = json_decode($response, true);
        // foreach ($data_array as $values) {
        //     echo 'NAMA: ' . $values['name'] . '<br/>';
        //     echo 'EMAIL: ' . $values['email'] . '<br/><br>';
        // }
    }
}
