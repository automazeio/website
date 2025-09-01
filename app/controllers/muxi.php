<?php

class Muxi extends TinyController
{
    public function get($request, $response)
    {
        $response->render('muxi');
    }
}
