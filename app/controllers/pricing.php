<?php

class Pricing extends TinyController
{
    public function get($request, $response)
    {
        $response->render('pricing');
    }
}
