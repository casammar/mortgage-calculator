<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;
     
    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $demo;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demo)
    {
        $this->demo = $demo;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('chris.sammarco@gmail.com', 'Chris')
                    ->view('emails.demo')
                    ->text('emails.demo_plain')
                    ->with(
                      [
                            'testVarOne' => '1',
                            'testVarTwo' => '2',
                      ])
                      ->attach(public_path('/images').'/demo.jpg', [
                              'as' => 'demo.jpg',
                              'mime' => 'image/jpeg',
                      ]);

                      $to_name = 'christopher';
                      $to_email = "chris.sammarco@gmail.com";
                      $data = array('name'=>'Ogbonna Vitalis(sender_name)', 'body' => 'A test mail');
                      
                      Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
                          $message->to($to_email, $to_name)->subject('Another Laravel Test Mail');
                          $message->from('chris.sammarco@gmail.com', 'Test Mail');
                      });
              





    }
}
