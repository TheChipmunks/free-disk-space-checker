<?php

include __DIR__ . './config.php';
include __DIR__ . '/functions.php';

if (defined('STDIN') && isset($argv[1]) && $argv != '' && in_array($argv[1], MODES)) {
    $mode = $argv[1];
} else {
    $mode = 2;
}

$total_space = disk_total_space(checkOS());
$free_space = disk_free_space(checkOS());

$space = round(($free_space * 100) / $total_space, 2);

if ($mode == 1) {
    slack('Free space on disk: ' . $space . '%');
} else {
    if (floor($space) < MIN_SPACE) {
        slack('Warning! Free space on disk: ' . $space . '%');
    }
}
