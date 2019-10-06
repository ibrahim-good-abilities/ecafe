<?php
namespace App\Events;

use phpDocumentor\Reflection\Types\Boolean;
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
      if($event=='new-order'){
        $this->store('parista',false,'New order #'.$data['order_id'].' has been placed',"");

      }
      elseif($event=='order-status')
      {
          $this->store('customer',false,'We have successfully received your order.',"");
      }


      $pusher->trigger($channel,$event, $data);
  }
  public function store(string $type ,bool $status ,string $title,string $body){
    $newNotification = new Notification();

    $newNotification->type   =  $type;
    $newNotification->status =  $status;
    $newNotification->title  =  $title;
    $newNotification->body   = $body;

    $newNotification->save();
}


}
