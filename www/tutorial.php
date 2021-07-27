<?php
require '../include/init.inc.php';
require '../include/Parsedown.php';

$parsedown = new Parsedown();
$chapter = isset($_GET['chapter']) ? $_GET['chapter'] : 'intro';
$chapter = preg_replace("/[^a-z0-9-]/", "", $chapter);
$path = '../tutorial/' . $chapter . '.md';

if (file_exists($path)) {
    $content = file_get_contents($path);
}
else {
    header('HTTP/1.1 404 Not Found');
    $_SERVER["REDIRECT_STATUS"] = '404';
    $uri = '/tutorial/'.$chapter.'.php';
    require 'error.php';
    die;
}

site_header();

echo $parsedown->text($content);

site_footer();
