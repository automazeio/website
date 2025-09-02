<?php

class Legal extends TinyController
{
    public function get($request, $response)
    {
        match(tiny::router()->section) {
            'privacy', 'privacy-policy' => $response->render('legal/privacy'),
            'terms', 'terms-of-service' => $response->render('legal/terms'),
            default => $response->redirect('legal/terms'),
        };
    }
}
