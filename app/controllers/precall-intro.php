<?php

class PrecallIntro extends TinyController
{
    public function get($request, $response)
    {
        $response->render('precall-intro');
    }
}
