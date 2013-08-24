<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

use Mail;

class MailHandler extends BaseHandler {

    /**
     * Run the task (called by BaseHandler).
     *
     * @return void
     */
    protected function run() {
        $data = $this->data;
        Mail::send($data['view'], $data, function($mail) use($data) {
            $mail->to($data['email'])->subject($data['subject']);
        });
    }
}
