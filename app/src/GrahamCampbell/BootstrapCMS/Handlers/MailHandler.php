<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

class MailHandler extends BaseHandler {

    /**
     * Run the task.
     * Called by BaseHandler.
     */
    protected function run() {
        $data = $this->data;
        Mail::send($data['view'], $data, function($mail) use($data) {
            $mail->to($data['email'])->subject($data['subject']);
        });
    }
}
