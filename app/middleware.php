<?php

use Dflydev\Hawk\Credentials\Credentials;
use Stack\Builder;

// TODO: prod implementation
$credentialsProvider = function ($id) {
    $validCredentials = new Credentials('test-key', 'sha256');
    if ($validCredentials === $id) {

        return $validCredentials;
    }
};

$stack = (new Builder())
    ->push('Dflydev\Stack\Hawk', [
        'firewall' => [
            ['path' => '/api/customers'],
        ],
        'credentials_provider' => $credentialsProvider
    ])
;
$app = $stack->resolve($app);

return $app;