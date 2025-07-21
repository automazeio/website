<?php
tiny::components()->register('TinyJS', function (...$props) {
    $html = '<script> window.tiny = window.tiny || {};';
    $html .= 'window.tiny.router = ' . json_encode(tiny::router()) . ';';
    $html .= "tiny.getHomeURL = (path='/') => path.indexOf('http') === 0 ? path : tiny.router.homepage.split('/').slice(0, -1).join('/') +'/'+ path.replace(/^(\/?)/, '');";
    // $html .= 'tiny.getHomeURL = (path="/") => path.indexOf("http") === 0 ? path : "'. tiny::router()->homepage .'"+ path.replace(/^(\/?)/, "")';
    if (@$_SERVER['S3_CDN']) {
        $html .= 'tiny.getSpacesURL = (path) => `' . $_SERVER['S3_CDN'] . '${path.slice(0, 1) === "/" ? "" : "/"}${path}`';
    } else {
        $html .= 'tiny.getSpacesURL = (path) => `https://' . @$_SERVER['S3_BUCKET'] . '.' . explode('://', @$_SERVER['S3_ENDPOINT'] ?? '://')[1] . '${path.slice(0, 1) === "/" ? "" : "/"}${path}`;';
    }
    $html .= '</script>';
    return $html;
});
