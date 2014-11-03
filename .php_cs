<?php

return Symfony\CS\Config\Config::create()
    ->fixers(array('-yoda_conditions', 'multiline_spaces_before_semicolon', 'ordered_use', 'short_array_syntax'))
    ->finder(Symfony\CS\Finder\DefaultFinder::create()->notName('*.blade.php')->exclude('storage')->in(__DIR__));
