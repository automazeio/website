<?php

declare(strict_types=1);


class VersionMiddleware
{
    public function handle(): void
    {
        if (!tiny::cookie('user')->exists) {
            return;
        }

        $cookie = tiny::cookie('version');
        $user_version = $cookie->read('user') ?: '0.1.0';
        if (version_compare($user_version, $_SERVER['APP_VERSION'], '<')) {
            $cookie->write('user', $_SERVER['APP_VERSION']);
            $cookie->save();

            tiny::flash('toast')->set([
                'level' => 'info',
                'title' => 'App version updated! 🎉',
                'message' => 'The account portal was updated to the latest version (' . $_SERVER['APP_VERSION'] . ').',
            ]);

            tiny::header('HX-Redirect: ' . tiny::router()->permalink);
            tiny::redirect(tiny::router()->permalink);
            tiny::exit();
        }
    }
}
