<?php
date_default_timezone_set("Asia/Baghdad");

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
define('MADELINE_BRANCH', 'deprecated');
include 'madeline.php';
function bot($method, $datas = []) {
	$token = file_get_contents("_token.txt");
	$url = "https://api.telegram.org/bot$token/" . $method;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$res = curl_exec($ch);
	curl_close($ch);
	return json_decode($res, true);
}
function Channel(){
    
$settings['app_info']['api_id'] = 579315;
$settings['app_info']['api_hash'] = '4ace69ed2f78cec268dc7483fd3d3424';
$MadelineProto = new \danog\MadelineProto\API('mdddd.madeline', $settings);
$MadelineProto->start();

bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => "checker start run | type - channel",]);


$updates = $MadelineProto->channels->createChannel(['broadcast' => true,'megagroup' => false,'title' => file_get_contents("_name.txt"), ]);
$chat_mack = $updates['updates'][1];

while(1){
    $users = explode("\n",file_get_contents("_users.txt"));
    foreach($users as $user){
        if($user != ""){
            try{
            	$MadelineProto->messages->getPeerDialogs(['peers' => [$user]]);
            } catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
                    try{
                        $MadelineProto->channels->updateUsername(['channel' => $chat_mack, 'username' => $user]);
                        
                        $ch = file_get_contents("_ch.txt");
				        $Text = "- NewUsername: @$user";
                        bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => $Text]);
                        $MadelineProto->messages->sendMessage(['peer' => $chat_mack, 'message' => $Text]);
                        $data = str_replace("\n".$user,"", file_get_contents("_users.txt"));
                        file_put_contents("_users.txt", $data);
                        $updates = $MadelineProto->channels->createChannel(['broadcast' => true,'megagroup' => false,'title' => file_get_contents("_name.txt"), ]);
                        $chat_mack = $updates['updates'][1];
                    }catch(Exception $e){
                        echo $e->getMessage();
                        if($e->getMessage() == "The provided username is not valid"){
                            $data = str_replace("\n".$user,"", file_get_contents("_users.txt"));
                            file_put_contents("_users.txt", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => 'This username is (banned/smaller than 5) i delete it from users list : @$user ',]);
                        }elseif(preg_match('/FLOOD_WAIT_(.*)/i', $e->getMessage())){
                            $seconds = str_replace('FLOOD_WAIT_', '', $e->getMessage());
                            bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => ' I m sleeping : $seconds ',]);
                            sleep($seconds);
                        }elseif($e->getMessage() == "USERNAME_OCCUPIED"){
                            $data = str_replace("\n".$user,"", file_get_contents("_users.txt"));
                            file_put_contents("_users.txt", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => " could not save it : @$user",]);
                        }elseif($e->getMessage() == "CHANNELS_ADMIN_PUBLIC_TOO_MUCH"){
                             $data = str_replace("\n".$user,"", file_get_contents("_users.txt"));
                            file_put_contents("_users.txt", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => "CHANNELS_ADMIN_PUBLIC_TOO_MUCH : @$user",]);
                          
                        }else{
                            bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' =>  "ERROR - ".$e->getMessage()
]);
                        }

  
                    }
	        }
        }
    }
}
}

function Account(){
    $settings['app_info']['api_id'] = 579315;
$settings['app_info']['api_hash'] = '4ace69ed2f78cec268dc7483fd3d3424';
$MadelineProto = new \danog\MadelineProto\API('mdddd.madeline', $settings);
$MadelineProto->start();

bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => " checker start run | type - account",]);

while(1){
    $users = explode("\n",file_get_contents("_users.txt"));
    foreach($users as $user){
        if($user != ""){
            try{
            	$MadelineProto->messages->getPeerDialogs(['peers' => [$user], ]);
            } catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
                    try{
                        $MadelineProto->account->updateUsername(['username'=>$user]);
                        $ch = file_get_contents("_ch.txt");
				        $Text = "- NewUsername: @$user";
                        bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' =>$Text]);
                        $data = str_replace("\n".$user,"", file_get_contents("_users.txt"));
                        file_put_contents("_users.txt", $data);
                            }catch(Exception $e){
                        echo $e->getMessage();
                        if($e->getMessage() == "The provided username is not valid"){
                            $data = str_replace("\n".$user,"", file_get_contents("_users.txt"));
                            file_put_contents("_users.txt", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => 'This username is (banned/smaller than 5) i delete it from users list : @$user ',]);
                        }elseif(preg_match('/FLOOD_WAIT_(.*)/i', $e->getMessage())){
                            $seconds = str_replace('FLOOD_WAIT_', '', $e->getMessage());
                            bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => ' I m sleeping : $seconds ',]);
                            sleep($seconds);
                        }elseif($e->getMessage() == "USERNAME_OCCUPIED"){
                            $data = str_replace("\n".$user,"", file_get_contents("_users.txt"));
                            file_put_contents("_users.txt", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => " could not save it : @$user",]);
                        }elseif($e->getMessage() == "CHANNELS_ADMIN_PUBLIC_TOO_MUCH"){
                             $data = str_replace("\n".$user,"", file_get_contents("_users.txt"));
                            file_put_contents("_users.txt", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' => "CHANNELS_ADMIN_PUBLIC_TOO_MUCH : @$user",]);
                          
                        }else{
                            bot('sendMessage', ['chat_id' => file_get_contents("_group.txt"), 'text' =>  "ERROR - ".$e->getMessage()
]);
                        }

  
                    }
	        }
        }
    }
}
}

$type = file_get_contents("_type.txt");

if($type == "c"){
    Channel();
}
if($type == "a"){
    Account();
}
