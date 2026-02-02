<?php

class Services extends TinyController
{
    public function get($request, $response)
    {
        $response->render('services');
    }
}
