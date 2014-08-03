<?php

// Error handler
$app->error(function (\Exception $e, $code) use ($app) {
    if (405 === $code) {
        return new Response($e->getMessage(), 405, array_merge(
            $e->getHeaders(),
            [ 'Content-Type' => 'text/plain' ]
        ));
    }
});

return $app;
