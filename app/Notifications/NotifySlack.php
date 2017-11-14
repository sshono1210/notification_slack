<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class NotifySlack extends Notification
{
    use Queueable;

    public $animal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($animal)
    {
        $this->animal = $animal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $animal = $this->getAnimal($this->animal);
        return (new SlackMessage)
            ->from($animal["name"], ":{$animal["en_name"]}:")
            ->to('#notify')
            ->content($animal["cry"]);
    }

    protected function getAnimal($animal)
    {
        $mammals = [];
        $mammals[] = [
            "name" => "いぬ",
            "en_name" => "dog",
            "cry" => "ワンワン！",
        ];
        $mammals[] = [
            "name" => "ねこ",
            "en_name" => "cat",
            "cry" => "ニャ〜ニャ〜",
        ];
        $mammals[] = [
            "name" => "ねずみ",
            "en_name" => "mouse",
            "cry" => "チュウチュウ♪",
        ];
        $mammals[] = [
            "name" => "さる",
            "en_name" => "monkey",
            "cry" => "キキー！",
        ];
        foreach ($mammals as $mammal){
            if($animal == $mammal["en_name"]) {
                $animal = $mammal;
            }
        }

        return $animal;
    }
}
