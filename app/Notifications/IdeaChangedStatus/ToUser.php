<?php

namespace App\Notifications\IdeaChangedStatus;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Idea;

class ToUser extends Notification
{
    use Queueable;

    /**
     * @var Idea
     */
    protected $idea;

    /**
     * @var \App\Models\Categories\Status
     */
    protected $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Idea $idea)
    {
        $this->idea = $idea;
        $this->status = $idea->status()->first();
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
        return (new MailMessage)
            ->subject('Изменен статус идеи.')
            ->view('emails.idea-changed-status.to-user', [
                'idea' => $this->idea,
                'status' => $this->status,
            ]);
    }
}
