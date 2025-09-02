<?php

class Services extends TinyController
{
    public function get($request, $response)
    {
        match(tiny::router()->section) {
            'cto-as-a-service' => $response->render('services/cto-as-a-service'),
            'mvp-launch' => $response->render('services/mvp-launch'),
            'managed-developers' => $response->render('services/managed-developers'),
            'ai-agents' => $response->render('services/ai-agents'),
            'design-subscription' => $response->render('services/design-subscription'),
            'devops-optimization' => $response->render('services/devops-optimization'),
            default => $response->render('services/index'),
        };
    }
}
