<?php

class Home extends TinyController
{
    public function get($request, $response)
    {
        $response->render('home');
    }
}
