<?php

  namespace App\Services;

  use GuzzleHttp\Client;

  use Kreait\Firebase\Factory;
  use Kreait\Firebase\Auth;

  class LineService
  {
      //config 接不到值
      public function getLineToken($code)
      {
        $client = new Client();
        $response = $client->request('POST', config('line.get_token_url'), [   
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                // 'redirect_uri' => 'http://sightseeing.nctu.me/api/line_3', 
                'redirect_uri' => 'http://sightseeing.nctu.me:8080',
                'client_id' => config('line.channel_id'),
                'client_secret' => config('line.secret')
            ]
        ]);
        return json_decode($response->getBody()->getContents(), true);
      }

      public function getUserContent($token)
      { // 得到id_token的內容
          $client = new Client();
          $response = $client->request('POST', config('line.get_user_verify_url'), [
              'form_params' => [
                  'id_token'   => $token,
                  'client_id'  => config('line.channel_id')
              ]
          ]);
          return json_decode($response->getBody()->getContents(), true);
      }

      public function linefirebasecreate($auth, $uid)
      { // 用 customtoken 登入
          $additionalClaims = [
              'provider' => "LINE"
          ];
          $customToken = $auth->createCustomToken($uid, $additionalClaims);
          $customTokenString = (string) $customToken;

          return $customTokenString;
      }
  }