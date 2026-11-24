<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about:demo', function () {
    $this->info('Portfolio API demo. See README.md for setup and endpoints.');
});
