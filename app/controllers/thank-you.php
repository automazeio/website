<?php

class ThankYou extends TinyController
{
    public function get($request, $response)
    {
        $response->render('thank-you');
    }
}
