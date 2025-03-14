<?php
require 'vendor/autoload.php';

use ParagonIE\Paseto\Keys\SymmetricKey;
use ParagonIE\Paseto\Parser;
use ParagonIE\Paseto\Purpose;
use ParagonIE\Paseto\ProtocolCollection;
use ParagonIE\Paseto\Rules\ValidAt;
use ParagonIE\Paseto\Protocol\Version4;
use ParagonIE\Paseto\Builder;

class Auth {
    public static function generateToken($userId, $position = [], $accountStatus)
    {
        $encodedKey = file_get_contents('storage/keys/local.key');

        $rawKey = base64_decode($encodedKey);

        $key = new SymmetricKey($rawKey);

        $now = new DateTimeImmutable();

        $payload = [
            'sub' => $userId,
            'position' => $position,
            'accountStatus' => $accountStatus,
            'iat' => $now->format(DateTime::ATOM),
            'nbf' => $now->format(DateTime::ATOM),
            'exp' => (new DateTimeImmutable('+1 hour'))->format(DateTimeImmutable::RFC3339),
        ];

        return (new Builder())
            ->setKey($key)
            ->setVersion(new Version4())
            ->setPurpose(Purpose::local())
            ->setClaims($payload)
            ->toString();
    }

    public static function verifyToken($token)
    {

        $encodedKey = file_get_contents('storage/keys/local.key');

        
        $rawKey = base64_decode($encodedKey);

        
        $key = new SymmetricKey($rawKey);

        
        $parser = Parser::getLocal($key, ProtocolCollection::v4());

       
        $parser->addRule(new ValidAt(new \DateTime('NOW')));

        try {

            $parsed = $parser->parse($token);

            $payload = $parsed->getClaims();

            return $payload;
        } catch (Exception $e) {
            http_response_code(401);
            die(json_encode(['error' => 'Invalid or expired token']));
        }
    }
}