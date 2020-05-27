<?php
use Firebase\JWT\JWT;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

function private_key(){
    $private_key = <<<EOD
    -----BEGIN RSA PRIVATE KEY-----
    MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
    vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
    5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
    AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
    bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
    Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
    cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
    5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
    ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
    k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
    qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
    eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
    B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
    -----END RSA PRIVATE KEY-----
    EOD;

    return $private_key;
}

function public_key(){
    $public_key = <<<EOD
    -----BEGIN PUBLIC KEY-----
    MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC8kGa1pSjbSYZVebtTRBLxBz5H
    4i2p/llLCrEeQhta5kaQu/RnvuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t
    0tyazyZ8JXw+KgXTxldMPEL95+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4
    ehde/zUxo6UvS7UrBQIDAQAB
    -----END PUBLIC KEY-----
    EOD;

    return $public_key;
}

function encode($request = null){   
    if($request == null){
        return json_encode(['token' => null]);
    }
    else{
        $private_key = private_key();
        $issuer_claim = "THE_CLAIM"; // bisa berupa servername. contoh: https://domain.com
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // iat (issued at)
        $notbefore_claim = $issuedat_claim + 10; // nbf (not before in seconds)
        $expire_claim = $issuedat_claim + 3600; // exp (expire time in seconds)
        $payload = [
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => $request
        ];

        $encoded = JWT::encode($payload, $private_key, 'RS256');
        return json_encode(['token' => $encoded, 'expired_at' => $expire_claim]);
    }    

}

function decode($token = null){ 
    if($token == null){
        return json_encode(['token' => null]);
    }
    else{
        $public_key = public_key();
        $decoded = JWT::decode($token, $public_key, array('RS256'));
        // return json_encode(['result' => $decoded]);
        return $decoded;
    }
}