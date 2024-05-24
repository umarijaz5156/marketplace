<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class UserVerification extends Component
{
    protected string $appToken;
    protected string $secretKey;
    protected GuzzleHttp\Client $guzzleClient;
    protected const BASE_URL = 'https://api.sumsub.com';

    public $data = [];
    public $accessToken;
    public function render()
    {

        return view('livewire.user-verification');
    }

    public function mount(){
        $this->guzzleClient = new GuzzleHttp\Client(['base_uri' => self::BASE_URL]);
        $this->appToken = config('app.samsub_app_token');
        $this->secretKey = config('app.samsub_secret_key');

        $seller = auth()->user()->seller;
        $email = auth()->user()->email;
        $phoneNumber = $seller->sellerProfile->phone;
        $this->data = [
            'email' => $email,
            'number' => $phoneNumber
        ];
        $accessToken = $this->getAccessToken('seller-'.$seller->id,'basic-kyc-level');
        $this->accessToken = $accessToken['token'];
    }

    public function getAccessToken(string $externalUserId, string $levelName): array
    {
        $url = '/resources/accessTokens?' . http_build_query(['userId' => $externalUserId, 'levelName' => $levelName]);
        $request = new GuzzleHttp\Psr7\Request('POST', $url);

        $response = $this->sendRequest($request);

        return $this->parseBody($response);
    }

    public function sendRequest(RequestInterface $request){

        $timestamp = time();
        $signature = hash_hmac('sha256', $timestamp . strtoupper($request->getMethod()) . $request->getRequestTarget() . (string) $request->getBody(), $this->secretKey);

        $request = $request->withHeader('X-App-Token', $this->appToken)
            ->withHeader('X-App-Access-Sig', $signature)
            ->withHeader('X-App-Access-Ts', $timestamp);

        return $this->guzzleClient->send($request);
    }

    protected function parseBody(ResponseInterface $response): array
    {
        $data = (string)$response->getBody();
        $json = json_decode($data, true, JSON_THROW_ON_ERROR);
        if (!is_array($json)) {
            throw new RuntimeException('Invalid response received: ' . $data);
        }

        return $json;
    }
}
