<?php

$stack = (new Stack\Builder())
    ->push('Dflydev\Stack\Hawk', [
        'firewall' => [
            ['path' => '/api/customers'],
        ],
        'credentials_provider' => $credentialsProvider,
        'sign_response' => false
    ])
;
$app = $stack->resolve($app);

return $app;
