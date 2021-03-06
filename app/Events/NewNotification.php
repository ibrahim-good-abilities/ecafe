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
        env('PUSHER_APP_KEY'),// Pusher App Key
        env('PUSHER_APP_SECRET'), //Pusher App Secret
        env('PUSHER_APP_ID'), //Pusher APP ID
        $options
      );
      if($event=='new-order'){
        $this->store('parista',false,'New order #'.$data['order_id'].' has been placed',"",$data['order_id']);

      }
      elseif($event=='order-status')
      {
          $this->store('customer',false,'We have successfully received your order.',"",'');
      }


      $pusher->trigger($channel,$event, $data);
  }
  public function store(string $type ,bool $status ,string $title,string $body ,string $object_id = ''){
    $newNotification = new Notification();

    $newNotification->type   =  $type;
    $newNotification->status =  $status;
    $newNotification->title  =  $title;
    $newNotification->body   = $body;
    $newNotification->save();
    if($object_id=='')
    {
        $newNotification->target='javascript:void(0)';
    }
    elseif($newNotification->type=='parista'){
        $newNotification->target  = route('parista',$newNotification->id);
    }
    $newNotification->save();

}


}
