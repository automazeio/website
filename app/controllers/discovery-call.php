<?php

class DiscoveryCall extends TinyController
{
    public function get($request, $response)
    {
        $response->render('discovery-call');
    }
}
