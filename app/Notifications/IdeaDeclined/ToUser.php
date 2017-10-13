<?php

namespace App\Notifications\IdeaDeclined;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\{
    Idea,
    Note
};

class ToUser extends Notification
{
    use Queueable;

    /**
     * @var Idea
     */
    protected $idea;

    /**
     * @var Note
     */
    protected $reason;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Idea $idea, Note $reason)
    {
        $this->idea = $idea;
        $this->reason = $reason;
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
            ->subject('Идея отклонена.')
            ->view('emails.idea-declined.to-user', [
                'idea' => $this->idea,
                'reason' => $this->reason,
            ]);
    }
}
