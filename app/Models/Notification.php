<?php

namespace App\Models;


use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{

    protected $connection = 'mysql';
}
