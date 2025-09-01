<?php

class Schedule extends TinyController
{
    private const ACTION_URLS = [
        'followup'  => 'https://meetings-eu1.hubspot.com/meetings/automaze/call',
        'interview' => 'https://meetings-eu1.hubspot.com/meetings/automaze/interview',
        'kickoff'   => 'https://meetings-eu1.hubspot.com/meetings/automaze/workshop',
        'workshop'  => 'https://meetings-eu1.hubspot.com/meetings/automaze/workshop',
        'ran'       => 'https://meetings-eu1.hubspot.com/meetings/automaze/ran',
        'sync'      => 'https://meetings-eu1.hubspot.com/meetings/automaze/call',
        'team'      => 'https://meetings-eu1.hubspot.com/meetings/automaze/team',
    ];

    private const DEFAULT_URL = 'https://meetings-eu1.hubspot.com/meetings/automaze/call';

    public function get($request, $response)
    {
        $action = str_replace('-', '', tiny::router()->section);
        $url = self::ACTION_URLS[$action] ?? self::DEFAULT_URL;
        $response->redirect($url, 302);
    }
}
