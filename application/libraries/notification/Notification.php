<?php
class Notification{
	private $CI;
	private $pusher;
	public function __construct() {
		$this->CI = get_instance();
		$this->CI->load->library('pusher/pusher');
		$this->CI->load->model("notification/notification_model");

		$this->pusher = new Pusher(PUSHER_APP_ID, PUSHER_APP_KEY, PUSHER_APP_SECRET);
	}
	/**
	 * Notify when there is a new restaurant review 
	 *
	 */
	public function notify_new_attention($attention_box_id, $creator_id, $received_user_id){
		$this->CI->notification_model->save_notification($creator_id, $received_user_id, $attention_box_id);
		
		//notification at right hand
		$messagePanel = '<p>User_ID ' . $creator_id. ' sent a new attention';
		
 		//notification at top
		$notificationArr = $this->CI->notification_model->get_notification($creator_id, $received_user_id, $attention_box_id);
		$messageTop = array();
		$messageTop['id'] 		= $notificationArr['id'];
		$messageTop['title'] 	= 'User_ID ' . $creator_id. ' sends you an attention ';
		$messageTop['created_date']		= $notificationArr['created_date'];
		$messageTopJson = json_encode($messageTop);
		
		//add data
		$data = array(
				'message_panel' => $messagePanel,
				'message_top' => $messageTopJson,
				'dest' =>base_url("index.php/" . $attention_box_id)
		);
		
		//push data
		$this->pusher->trigger(NEW_ATTENTION_NOTIFCATION_CHANNEL . $received_user_id,
				NEW_ATTENTION_NOTIFCATION_EVENT,
				$data);
	}
	/**
	 * Get all notification for a user
	 * 
	 */
	public function get_all_notification($user_id) {
		$notificationArr =  $this->CI->notification_model->get_all_notification($user_id);
		
		if ($notificationArr) {
			$messageTop = array();
			$messageTop['unseen_notification'] = 0;
			$messageTop['results'] = array();
				
			foreach ($notificationArr as $n) {
				$data = array();
				$data['id'] 			= $n['id'];
				$data['title'] 			= 'User_ID ' . $n['user_id']. ' send you an attention ';
				$data['created_date']	= $n['created_date'];
				$data['status']			= $n['status'];
				$data['url']			= base_url("index.php/notify/click_notification/notification_id") . '/' . $n['id'];
	
				array_push($messageTop['results'], $data);
	
				if($data['status'] == 'unseen') {
					$messageTop['unseen_notification'] += 1;
				}
			}
			$messageTopJson = json_encode($messageTop);
			echo($messageTopJson);
		} else {
			echo('');
		}
	}
	/**
	 * 
	 * @param unknown $notification_id
	 */
	public function mark_notification_seen($notification_id) {
		$this->CI->notification_model->mark_notification_seen($notification_id);
	}
}