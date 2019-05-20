<?php

namespace App\Notifications;

use App\Models\Projects;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyAboutProject extends Notification implements ShouldQueue
{
    use Queueable;

    protected $project;

    protected $link;

    protected $author;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($link, Projects $project, User $author)
    {
        $this->link = $link;
        $this->project = $project;
        $this->author = $author;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'icon' => 'list',
            'color_icon' => 'green-text',
            'link' => $this->link,
            'project' => $this->project,
            'author' => $this->author,
        ];
    }
}
