
<?php

define('API_KEY','7105626178:AAHkjZR6GCwpm4zzQFNOv0b_Hs1P2rCZDBA');
define('API_TELEGRAM','https://api.telegram.org/bot'.API_KEY.'/');

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = "https://api.telegram.org/bot".API_KEY."/".$method.'?'.http_build_query($parameters);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  return exec_curl_request($handle);
}


function SendMessage($chat_id, $text , $reply_id){
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>$text,
        'reply_to_message_id'=>$message_id,
        'parse_mode'=>"MarkDown"
    ]);
}
function save($filename, $data)
{
$file = fopen($filename, 'w');
fwrite($file, $data);
fclose($file);
}
	function EditMessageText($chat_id,$message_id,$text,$parse_mode,$disable_web_page_preview,$keyboard){
  bot('editMessagetext',[
    'chat_id'=>$chat_id,
 'message_id'=>$message_id,
    'text'=>$text,
    'parse_mode'=>$parse_mode,
 'disable_web_page_preview'=>$disable_web_page_preview,
    'reply_markup'=>$keyboard
 ]);
 }
 function sendAction($chat_id, $action){
bot('sendChataction',[
'chat_id'=>$chat_id,
'action'=>$action]);
}
function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }
    	function sendphoto($ChatId, $photo_id,$caption){
    bot('sendphoto',[
        'chat_id'=>$ChatId,
        'photo'=>$photo_id,
        'caption'=>$caption
    ]);
}
function sendvideo($chat_id,$video_id,$caption){
    bot('sendvideo',[
        'chat_id'=>$ChatId,
        'video'=>$video_id,
        'caption'=>$caption
    ]);
}
function sendaudio($chat_id,$audio_id,$caption){
    bot('sendaudio',[
        'chat_id'=>$ChatId,
        'audio'=>$audio_id,
        'caption'=>$caption
    ]);
}
function sendvoice($chat_id,$voice_id,$caption){
    bot('sendvoice',[
        'chat_id'=>$ChatId,
        'voice'=>$audio_id,
        'caption'=>$caption
    ]);
}
function senddocument($chat_id,$document_id,$caption){
    bot('senddocument',[
        'chat_id'=>$ChatId,
        'document'=>$document_id,
        'caption'=>$caption
    ]);
}
function sendsticker($chat_id,$sticker_id,$caption){
    bot('sendsticker',[
        'chat_id'=>$ChatId,
        'sticker'=>$sticker_id,
        'caption'=>$caption
    ]);
}
function ForwardMessage($chatid,$from_chat,$message_id){
	bot('ForwardMessage',[
	'chat_id'=>$chatid,
	'from_chat_id'=>$from_chat,
	'message_id'=>$message_id
	]);
	}

	$update = json_decode(file_get_contents('php://input'));
	var_dump($update);
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$text = $update->message->text;
$message_id = $update->message->message_id;
$truechannel = json_decode(file_get_contents("https://api.telegram.org/bot521974040:AAH9QawLwqgEXjLoh8bJ2_MLBf1VHDpaEqo/getChatMember?chat_id=@abbodalfrahi&user_id=".$from_id));
$tch = $truechannel->result->status;
@mkdir("user");
@mkdir("user/$from_id");
$amirm = file_get_contents("user/$chat_id/amirm.txt");
$number = file_get_contents("user/$chat_id/number.txt");
$hash = file_get_contents("user/$chat_id/hash.txt");
$code = file_get_contents("user/$chat_id/code.txt");

if($tch != 'member' && $tch != 'creator' && $tch != 'administrator'){
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "
▫️ يجب عليك الاشتراك في قناة البوت اولا ⚜️
◼️ اشترك في القناة ثم ارسل /start 
 - قناة البوت @abbodalfrahi",
            'parse_mode' => "html",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "- @abbodalfrahi -", 'url' => "https://telegram.me/abbodalfrahi"]
                    ],
                    
                ]
            ])
        ]);
	}
	
	if(preg_match('/^\/([Ss]tart)/',$text)){
		file_put_contents("user/$chat_id/amirm.txt","name");
        bot('sendMessage',[
        'parse_mode' => "MarkDown",
 'chat_id'=>$chat_id,
 'text'=>"- اهلا بك عزيزي ؛
- في بوت حذف حسابات التليجرام -
• وضيفة البوت مساعدتك في حذف حسابك 💌 •
- دون الذهاب الى موقع الحذف ☑️ •
- لحذف حسابك اضغط على زر حذف الحساب ؛",
'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'- حذف الحساب ⚠️ •']],
	  [['text'=>"- قناة البوت ⚡️ •"],['text'=>"- للاستفسار ☑️ •"]],
      ],'resize_keyboard'=>true])
  ]);
	}
	
	elseif($text == "- رجوع ✨؛"){
unlink("user/$from_id/amirm.txt");
unlink("user/$from_id/code.txt");
unlink("user/$from_id/number.txt");
unlink("user/$from_id/hash.txt");
bot('sendMessage',[
        'parse_mode' => "MarkDown",
 'chat_id'=>$chat_id,
 'text'=>"- تم الرجوع الى القائمةه الرئيسيةه ✅؛",
'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'- حذف الحساب ⚠️ •']],
	  [['text'=>"- قناة البوت ⚡️ •"],['text'=>"- للاستفسار ☑️ •"]],
      ],'resize_keyboard'=>true])
  ]);
}
	
  elseif($text == "- حذف الحساب ⚠️ •"){
  file_put_contents("user/$chat_id/amirm.txt","dell1");
      if(preg_match('([+]|[0]|[1]|[2]|[3]|[4]|[5]|[6]|[7]|[8]|[9])',$text)){
	  bot('sendMessage',[
        'parse_mode' => "MarkDown",
 'chat_id'=>$chat_id,
 'text'=>"- الان ارسل رقمك مع مفتاح الدولة مثل ؛ 👇🏻
`+9647735334728`",
  ]); 
}else{
	  bot('sendMessage',[
        'parse_mode' => "MarkDown",
 'chat_id'=>$chat_id,
 'text'=>"- الان ارسل رقمك مع مفتاح الدولة مثل ؛ 👇🏻
 `+9647735334728`",
  ]);
} 
}

elseif($amirm == "dell1"){
	  file_put_contents("user/$chat_id/number.txt",$text);
	    $url2 = "http://Api.Mahdi-Elvis.tk/tg/deleteacc?phone=$text";
   $jsurl=json_decode(file_get_contents($url2),true);
   $jdel=$jsurl['result']['access_hash']; 
   $jer=$jsurl['description']; 
   file_put_contents("user/$chat_id/hash.txt",$jdel);
   if($jer == "too Many Request, Please Try Later !!"){
   file_put_contents("user/$chat_id/amirm.txt","none");
    bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"- محاولات كثيرة ؛ 
• حاول مجددا في وقتا لاحق هذا التحذير من الشركة 💌 •",
 'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'- رجوع ✨؛']],
      ],'resize_keyboard'=>False])
 ]);
   }else{
   	  file_put_contents("user/$chat_id/amirm.txt","dell111");
	  bot('sendMessage',[
        'parse_mode' => "MarkDown",
 'chat_id'=>$chat_id,
 'text'=>"- الان ارسل كود الحذف مكون من 8 احرف ✨؛",
  ]);
}
}
   
elseif($amirm == "dell111"){
	  file_put_contents("user/$chat_id/code.txt",$text);
	  $url2 = "http://Api.Mahdi-Elvis.tk/tg/deleteacc?phone=$number&access_hash=$hash&password=$text";
   $jsurl=json_decode(file_get_contents($url2),true);
   $jdelsa=$jsurl['description']; 
   if($jdelsa == "Access Hash / Password Not True !!"){
   file_put_contents("user/$chat_id/amirm.txt","none");
    bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"- الكود خاطئ ياعزيزي 🅾؛",
 'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'- رجوع ✨؛']],
      ],'resize_keyboard'=>False])
 ]);
   }else{
   file_put_contents("user/$chat_id/amirm.txt","dell1111111");
	  bot('sendMessage',[
        'parse_mode' => "MarkDown",
 'chat_id'=>$chat_id,
 'text'=>"- حسنا عزيزي اذا كنت حقا تريد الحذف اضغط على زر التاكيد ؛
- وان كنت لا ترغب في الحذف اضغط على زر الالغاء ؛
- $jdels •",
 'reply_markup'=>json_encode([
      'keyboard'=>[
              [
              ['text'=>"- تأكيد الحذف ✅ •"],['text'=>"- الغاء حذف 💌 •"]
              ],
            ],
            'resize_keyboard'=>true
        ])
  ]);
}
}

elseif($text == "- تأكيد الحذف ✅ •" && $amirm == "dell1111111"){
  $url2 = "http://Api.Mahdi-Elvis.tk/tg/deleteacc?phone=".$number."&access_hash=".$hash."&password=".$code."&do_delete=true";
   $jsurl=json_decode(file_get_contents($url2),true);
   $jdelss=$jsurl['description'];
	  bot('sendMessage',[
        'parse_mode' => "MarkDown",
 'chat_id'=>$chat_id,
 'text'=>"- حسنا سوف يتم حذف الحساب خلال ٣ ثواني .  ⚠️؛
 - $jdelss -",
  'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'- رجوع ✨؛']],
      ],'resize_keyboard'=>False])
  ]);
}

elseif($text == "- الغاء حذف 💌 •" && $amirm == "dell1111111"){
  $url2 = "http://Api.Mahdi-Elvis.tk/tg/deleteacc?phone=".$number."&access_hash=".$hash."&password=".$code."&do_delete=flase";
   $jsurl=json_decode(file_get_contents($url2),true);
   $jdelss=$jsurl['description'];
	  bot('sendMessage',[
        'parse_mode' => "MarkDown",
 'chat_id'=>$chat_id,
 'text'=>"- لالغاء حذف حسابك اضغط على زر الرجوع 👇🏻؛",
 'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'- رجوع ✨؛']],
      ],'resize_keyboard'=>False])
  ]);
}
elseif($text == '- للاستفسار ☑️ •'){
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "- للاستفسار راسل المطور ⬇️ :

[Saad Mohammed](https://t.me/abbwd2)",
            'parse_mode' => "markdown",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "@fourteam", 'url' => "https://telegram.me/fourteam"]
                    ],
                    
                ]
            ])
        ]);
}
elseif($text == '- قناة البوت ⚡️ •'){
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "#اضغط_هنا_وتابع_جديدنا_👇🏻",
            'parse_mode' => "markdown",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "@abbodalfrahi", 'url' => "https://telegram.me/abbodalfrahi"]
                    ],
                    
                ]
            ])
        ]);
}

//unlink("error_log");
$user = file_get_contents('user/Member.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('user/Member.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('user/Member.txt',$add_user);
    }
