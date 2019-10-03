<?php
namespace App\Events;
require base_path() . '/pusher-vendor/autoload.php';

class NewOrder 
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

}