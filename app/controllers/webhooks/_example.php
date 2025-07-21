<?php

class WebhooksExample extends TinyController
{
    // post /webhooks/example
    public function post($request, $response)
    {
        tiny::JSONResponse([]);
    }
}
