<?php

class HomeController extends BaseController {

    public function showWelcome() {
        Log::notice('Hello World');
        return View::make('hello');
    }

    public function showLog($file) {
        $path = storage_path().'\\logs\\'.$file;
        if(!file_exists($path)) {
            App::abort(404, 'Log Not Found');
        }
        return View::make('log', array('file' => $file, 'path' => $path));
    }

    public function testQueue() {
        $data = array('view' => 'emails.welcome',
            'link' => URL::route('account.activate', array('id' => 1, 'code' => 1234)),
            'email' => 'graham@mineuk.com',
            'subject' => Config::get('cms.name').' - Welcome');

        Queue::push('MailHandler', $data);
        return 'done';
    }

    public function addValue($value) {
        Cache::put('cachetest', $value, 10);
    }

    public function getValue() {
        return Cache::get('cachetest');
    }
}
