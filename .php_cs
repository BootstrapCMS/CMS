<?php

return Symfony\CS\Config\Config::create()
    ->fixers(array('-return', '-yoda_conditions', 'multiline_spaces_before_semicolon', 'ordered_use'))
    ->finder(Symfony\CS\Finder\DefaultFinder::create()->notName('*.blade.php')->exclude('bootstrap')->in(__DIR__));
