<?php

class Schedule extends TinyController
{
    private const ACTION_URLS = [
        'followup'  => 'https://cal.com/automaze/sync?duration=30',
        'interview' => 'https://cal.com/automaze/interview',
        'kickoff'   => 'https://cal.com/automaze/sync?duration=45',
        'workshop'  => 'https://cal.com/automaze/sync?duration=45',
        'ran'       => 'https://cal.com/automaze/consultation',
        'sync'      => 'https://cal.com/automaze/sync',
        'team'      => 'https://cal.com/automaze/sync',
    ];

    private const DEFAULT_URL = 'https://cal.com/automaze/intro';

    public function get($request, $response)
    {
        $action = str_replace('-', '', tiny::router()->section);
        $url = self::ACTION_URLS[$action] ?? self::DEFAULT_URL;
        $response->redirect($url, 302);
    }
}
