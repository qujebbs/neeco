<?php 

require 'vendor/autoload.php';

use ParagonIE\Paseto\Keys\SymmetricKey;
use ParagonIE\Paseto\Protocol\Version4;

$key = SymmetricKey::generate(new Version4());

file_put_contents('storage/keys/local.key', $key->encode());