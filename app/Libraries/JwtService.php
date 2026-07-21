<?php

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    protected string $secret;

    public function __construct()
    {
        $this->secret = env('JWT_SECRET');
    }

    public function generate(array $payload): string
    {
        $time = time();

        $payload['iat'] = $time;
        $payload['exp'] = $time + 86400;

        return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function verify(string $token)
    {
        return JWT::decode(
            $token,
            new Key($this->secret, 'HS256')
        );
    }
}
