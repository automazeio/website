<?php

class About extends TinyController
{
    public function get($request, $response)
    {
        $response->render('about');
    }
}
