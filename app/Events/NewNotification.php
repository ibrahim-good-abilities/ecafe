<?php
namespace App\Events;
use App\Notification;
require base_path() . '/pusher-vendor/autoload.php';

class NewNotification
{

  public function __construct($channel,$event,$data)
  {
      $options = array(
        'cluster' => 'eu',
        'useTLS' => true
      );
      $pusher = new \Pusher\Pusher(
        'c015a0a925da1961bddf',
        'f1b6529a0adbd019f86b',
        '873745',
        $options
      );

      $pusher->trigger($channel,$event, $data);
  }

  public function storeNotification(Request $request)
  {

  }
}
