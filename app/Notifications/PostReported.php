<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostReported extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post, $subject_type)
    {
        $this->post = $post;
        $subjects = [
            'post' => "A post in the \"{$post->discussion->title}\" discussion was reported by a member of the staff.",
            'discussion' => "The discussion \"{$post->discussion->title}\" was reported by a member of the staff."
        ];

        $this->report_subject = $subjects[$subject_type];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // dd($this->post->user);
        $post_body = str_limit($this->post->body, 160);
        return (new MailMessage)
                    ->line($this->report_subject)
                    ->line("{$this->post->user->name} said : \n\n{$post_body}")
                    // ->action('Notification Action', 'https://laravel.com')
                    ->line(null);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
