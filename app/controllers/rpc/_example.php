<?php

class RpcExample extends TinyController
{
    public function post($request, $response)
    {
        $response->sendJSON([
            // ...
        ]);
    }
}
