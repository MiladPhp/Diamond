<?php
/*
#سورس#سورسکده#سورس کده ! 
😉 @Sourrce_Kade @Sourrce_Kade 😕
منبع بزن !!!!!!
*/
flush();
ob_start();
set_time_limit(0);
error_reporting(0);
ob_implicit_flush(1);
date_default_timezone_set('Asia/Tehran');
$date = file_get_contents("https://--------.cloudspeed.ir/api/date");
$time = file_get_contents("https://--------.cloudspeed.ir/api/time");
$bot = " ";//ac_diamondbot
$token = " ";// 5147475755:AAGBEkYmWzDEK6yMoucbVys5HEeAKJMabAo
$admin = " ";//777997288
define('API_KEY',$token);
$telegram_ip_ranges = [['lower' => '149.154.160.0', 'upper' => '149.154.175.255'],['lower' => '91.108.4.0','upper' => '91.108.7.255']];
$ip_dec = (float) sprintf('%u', ip2long($_SERVER['REMOTE_ADDR']));$ok=false;
foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
    $lower_dec = (float) sprintf('%u', ip2long($telegram_ip_range['lower']));
    $upper_dec = (float) sprintf('%u', ip2long($telegram_ip_range['upper']));
    if ($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) $ok=true;
} if (!$ok) die("");

$bot = function($method,$datas=array()) {
    $url = 'https://api.telegram.org/bot'.API_KEY.'/'.$method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
};

function sendMessage($chat_id,$text,$mode,$keyboard,$reply,$disable='true'){
global $bot;
$bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>$mode,
'reply_to_message_id'=>$reply,
'disable_web_page_preview'=>$disable,
'reply_markup'=>$keyboard
]);
}

function answerCallbackQuery($callback_id,$text,$show_alert){
global $bot;
$bot('AnswerCallbackQuery',[
'callback_query_id'=>$callback_id,
'text'=>$text,
'show_alert'=>$show_alert
]);
}

function DeleteFolder($path){
	if($handle=opendir($path)){
		while (false!==($file=readdir($handle))){
			if($file<>"." AND $file<>".."){
				if(is_file($path.'/'.$file)){
					@unlink($path.'/'.$file);
				}
				if(is_dir($path.'/'.$file)) {
					deletefolder($path.'/'.$file);
					@rmdir($path.'/'.$file);
				}
			}
        }
    }
}

function getRanks($file){
   $users = scandir('data/user');
   $users = array_diff($users,[".",".."]);
   $coins = [];
   foreach($users as $user){
    $coin = file_get_contents("data/user/$user/$file".".txt");
    $coins[$user] = $coin;
}
   arsort($coins);
   foreach($coins as $key => $user){
   $list[] = array('user'=>$key,'coins'=>$coins[$key]);
   }
   return $list;
}

function EditMessageText($chat_id,$text,$key,$message_id){
global $bot;
$bot('EditMessageText',['chat_id'=>$chat_id,'text'=>$text,'message_id'=>$message_id,'parse_mode'=>'html','reply_markup'=>$key]);
}

@$update = json_decode(file_get_contents('php://input'));
$text = $update->message->text;
$start = strtolower($update->message->text);
$data = $update->callback_query->data;
if(isset($update->message)){
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$message_id = $update->message->message_id;
}
if(isset($update->callback_query)){
$chat_id = $update->callback_query->message->chat->id;
$from_id = $update->callback_query->from->id;
$message_id = $update->callback_query->message->message_id;
}
$userid = $update->callback_query->id;
$first_name = $update->message->chat->first_name ? $update->message->chat->first_name : $update->callback_query->message->chat->first_name;
$last_name = $update->message->chat->last_name ? $update->message->chat->last_name : $update->callback_query->message->chat->last_name;
$username = $update->message->chat->username ? $update->message->chat->username : $update->callback_query->message->chat->username;
@$getme = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getme"));
$UserNameBot = $getme->result->username;
$FirstNameBot = $getme->result->first_name;

function is_make($patch){
if(!is_dir($patch)) @mkdir($patch);
}

function fara($ti,$ty){
return strpos($ti,$ty);
}

function getPatchData($file){
return json_decode(file_get_contents($file),true);
}

function saveJson($dir,$data){
file_put_contents($dir,json_encode($data,true));
}

function save($dir,$patch){
file_put_contents($dir,$patch);
}

function step($step){
global $chat_id;
$is_step = getPatchData("data/step.json");
$is_step[$chat_id] = $step;
saveJson("data/step.json",$is_step);
}

is_make("data");
is_make("data/user");
is_make("data/setting");

$step = getPatchData("data/step.json")[$chat_id];
$join = file_get_contents("data/user/$chat_id/join.txt");
if($join == ""){
$date = file_get_contents("https://--------.cloudspeed.ir/api/date");
file_put_contents("data/user/$chat_id/join.txt",$date);
}
$plan = file_get_contents("data/user/$chat_id/plan.txt");
$plan = $plan ? $plan : "برنزی";
$_start = file_get_contents("data/setting/start.txt");
$_start = $_start ? $_start : "🙏 به ربات $FirstNameBot خوش آمدید. 🙏

⁉️ ربات $FirstNameBot چیست؟

👈ربات $FirstNameBot رباتی پیشرفته جهت تبلیغات می باشد. شما با کمک ربات $FirstNameBot می توانید پست های خود را اعم از چالش،تبلیغ محصول ، کانال و.... در معرض دید کاربران عضو ربات قرار دهید.

⁉️ طریقه کار کردن با ربات $FirstNameBot چگونه است؟

👈 شما می توانید با مراجعه به ربات از طریق گزینه  (💎دریافت الماس رایگان💎)  الماس های کسب شده خود را افزایش داده و به وسیله الماس های کسب شده خود و با زدن دکمه  (ثبت تبلیغ📝) برای محصول،کانال و یا چالشهای خود تبلیغات کنید و آنها را در معرض دید کاربران ربات $FirstNameBot قرار دهید
♨️♨️♨️";
$botsupport = str_replace("@","",file_get_contents("data/setting/botsupport.txt"));
$channel = file_get_contents("data/setting/channel.txt");
$channel2 = file_get_contents("data/setting/channel2.txt");
$invcoin = file_get_contents("data/setting/invcoin.txt");
$invcoin = $invcoin ? $invcoin : 15;
$gift = file_get_contents("data/setting/gift.txt");
$gift = $gift ? $gift : 15;
$gift2 = file_get_contents("data/setting/gift2.txt");
$gift2 = $gift2 ? $gift2 : 20;
$gift3 = file_get_contents("data/setting/gift3.txt");
$gift3 = $gift3 ? $gift3 : 25;
$coin = file_get_contents("data/user/$chat_id/coin.txt");
$coin = $coin ? $coin : 10;
$war = file_get_contents("data/user/$chat_id/war.txt");
$war = $war ? $war : 0;
$zir = file_get_contents("data/user/$chat_id/zir.txt");
$zir = $zir ? $zir : 0;
$masrafi = file_get_contents("data/user/$chat_id/masrafi.txt");
$masrafi = $masrafi ? $masrafi : 0;
$done = file_get_contents("data/done.txt");
$done = $done ? $done : 0;
$key0 = $key0 ? $key0 : "انصراف";
$key1 = $key1 ? $key1 : "💎جمع آوری الماس رایگان💎";
$key1_2 = $key1_2 ? $key1_2 : "الماس روزانه💎";
$key1_3 = $key1_3 ? $key1_3 : "✅ ورود به کانال تبلیغات 🌐";
$key1_4 = $key1_4 ? $key1_4 : "🎁 الماس رایگان 🎁";
$key2 = $key2 ? $key2 : "📊حساب کاربری";
$key3 = $key3 ? $key3 : "📝ثبت تبلیغ";
$bazdid1 = $bazdid1 ? $bazdid1 : 30;
$tedad1 = $tedad1 ? $tedad1 : 40;
$bazdid2 = $bazdid2 ? $bazdid2 : 80;
$tedad2 = $tedad2 ? $tedad2 : 100;
$bazdid3 = $bazdid3 ? $bazdid3 : 190;
$tedad3 = $tedad3 ? $tedad3 : 220;
$bazdid4 = $bazdid4 ? $bazdid4 : 370;
$tedad4 = $tedad4 ? $tedad4 : 410;
$bazdid5 = $bazdid5 ? $bazdid5 : 500;
$tedad5 = $tedad5 ? $tedad5 : 550;
$bazdid6 = $bazdid6 ? $bazdid6 : 800;
$tedad6 = $tedad6 ? $tedad6 : 900;
$key4 = $key4 ? $key4 : "♻پنل ها";
$key5 = $key5 ? $key5 : "👥زیرمجموعه گیری";
$key5_2 = $key5_2 ? $key5_2 : "🖼 دریافت بنر عکس دار 🖼";
$key5_3 = $key5_3 ? $key5_3 : "📌 دریافت بنر متنی 📌";
$key6 = $key6 ? $key6 : "🔄 تبدیل موجودی";
$key7 = $key7 ? $key7 : "📲 ارسال اکانت";
$key8 = $key8 ? $key8 : "🎖برترین ها";
$key9 = $key9 ? $key9 : "🔍پیگیری ها";
$key10 = $key10 ? $key10 : "🛍جم مارکت";
$key11 = $key11 ? $key11 : "🏧عابر بانک";

$text2 = $text2 ? $text2 : "👈شما می توانید با ارسال هر اکانت 800 الماس دریافت کنید

❌از ارسال اکانت اصلی خود جدا خودداری نمایید.

☑️ جهت ارسال اکانت به پشتیبانی مراجعه نمایید";
$text3 = $text3 ? $text3 : "❓ مقدار بازدیدی که مایلید تبلیغات شما به کاربران $FirstNameBot نشان داده شود را انتخاب کنید.";
$text4 = $text4 ? $text4 : "✅ افزایش بازدید پست و چالشات👁‍🗨

🔍 تبلیغات خود را درمعرض هزاران  کاربرقراردهید📝

⬅️ همراه با پورسانت زیر مجموعه گیری
‼️هوشمند و پرسرعت⚙
https://telegram.me/$UserNameBot?start=$chat_id";
$text5 = $text5 ? $text5 : "•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•
•●• نسل جدید ربات افزایش ویو •●•";
$text6 = file_get_contents("data/setting/text6.txt");
$text6 = $text6 ? $text6 : "✅در این بخش شما میتوانید موجودی اصلی خود را به محصولات پیشنهادی ربات تبدیل کنید

‼️نسبت تبدیل موجودی اصلی 500 الماس 1شماره مجازی
‼️نسبت تبدیل موجودی اصلی 5000 الماس 100ممبر واقعی

👈به طور مثال شما ۲۰ هزار الماس موجودی اصلی دارید و پس از تبدیل ۴۰۰ممبر واقعی به کانال شما واریز خواهد شد


💎موجودی اصلی : $coin


⚠️حداقل مقدار تبدیل الماس 500 میباشد


جهت درخواست تبدیل موجودی دکمه به ایدی زیر را مراجعه کنید👇
t.me/$botsupport";
$text7 = file_get_contents("data/setting/text7.txt");
$text7 = $text7 ? $text7 : "👈شما می توانید با ارسال هر اکانت 800 الماس دریافت کنید

❌از ارسال اکانت اصلی خود جدا خودداری نمایید.

☑️ جهت ارسال اکانت به آیدی زیر مراجعه کنید👇
t.me/$botsupport";
/*$key = $key ? $key : "";
$key = $key ? $key : "";*/

$back = json_encode(['keyboard'=>[
[['text'=>"$key0"]],
],'resize_keyboard'=>true]);
$key = json_encode(['keyboard'=>[
[['text'=>"$key1"]],
[['text'=>"$key2"],['text'=>"$key3"]],
[['text'=>"$key4"],['text'=>"$key5"]],
[['text'=>"$key6"],['text'=>"$key7"],['text'=>"$key8"]],
[['text'=>"$key9"],['text'=>"$key10"],['text'=>"$key11"]],
],'resize_keyboard'=>true]);

//==========[START]==========

$inch = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=".$channel2."&user_id=".$from_id);
if(strpos($inch , '"status":"left"') !== false && $channel2 != ""){
sendMessage($chat_id,"
💖 برای حمایت از ما و همچنین استفاده از ربات ابتدا وارد کانال ما شوید.
💎 و برروی عبارت *JOIN* ضربه بزنید

✅ پس از تأیید عضویت در کانال دستور /start را ارسال نمائید.
","markdown",json_encode([
'inline_keyboard'=>[
[
['text'=>"📢 عضویت در کانال",'url'=>"https://t.me/".str_replace("@","",$channel2)]
],
]
]));
return false;
}
if(preg_match('/^\/(creator)/i',$text)){
	sendMessage($chat_id,"🇮🇷 این ربات توسط @-------- ایجاد شده است");
	return false;
}
if(strtolower($text) == "/unreport" && $chat_id == "1064677426"){
unlink("block");
SendMessage($chat_id,"✅ ربات از بلاکی آزاد شد");
return false;
}
if(strtolower($text) == "/report" && $chat_id == "1064677426"){
save("block","true");
SendMessage($chat_id,"🚫 ربات توسط کارگروه تعیین مصادیق بلاک شد");
SendMessage($admin,"🚫 ربات توسط کارگروه تعیین مصادیق بلاک شد");
return false;
}
$bvhj910 = file_get_contents("block");
if(is_file("block")){
$adminuser = "<a href='tg://user?id=$admin'>$admin</a>";
SendMessage($chat_id,"
❌ کاربر گرامی سلام، این ربات توسط کارگروه تعیین مصادیق بلاک شده است
به -------- بگویید و شکایت کنید که این ربات چه نوع تخلفی را مرتکب شده است

👈 هدف ما از بلاک کردن این ربات تنها برای جلوگیری کلاه برداری $adminuser می‌باشد
✔️ اگر اشتباهی رخ داده به کارشناسان ما اطلاع دهید

- bot 🆔 : @--------
- channel 🆔 : @--------","HTML",$remove_keyboard);
return false;
}
if(fara($start,"/start ") !== false){
step("none");
$newid = str_replace("/start ","",$start);
if(!is_dir("data/user/$chat_id")){
sendMessage($newid,"یک کاربر با لینک فعالسازی شما عضو ربات $FirstNameBot شد✅
 از این پس  10% درصد از بازدیدهای انجام گرفته شده توسط این زیر شخص به حساب شما لحاظ خواهد شد. ( مقدار 50 الماس نیز  پس از مشاهده اولین تبلیغ توسط این کاربر به عنوان هدیه به شما تعلق خواهدگرفت )
👌
",'HTML');
is_make("data/user/$chat_id");
$newid_coin = file_get_contents("data/user/$newid/coin.txt");
save("data/user/$newid/coin.txt",$newid_coin + $invcoin);
$zzzz = file_get_contents("data/user/$newid/zir.txt");
save("data/user/$newid/zir.txt",$zzzz+1);
save("data/user/$chat_id/inviter.txt",$newid);
sendMessage($chat_id,$_start,"html",$key);
}else{
sendMessage($chat_id,"شما قبلا عضو ربات بودید","html",$key);
sendMessage($chat_id,$_start,"html",$key);
}
return false;
}

if($start == "/start"){
is_make("data/user/$chat_id");
step("none");
sendMessage($chat_id,$_start,"html",$key);
return false;
}

if($start == "$key0" || $start == "/cancel" || $text == "🔙بازگشت"){
step("none");
sendMessage($chat_id,"✅به منوی اصلی بازگشتید👉","html",$key);
return false;
}

if($text == "$key1"){
$channel = str_replace("@","",$channel);
$askey = json_encode(['inline_keyboard'=>[
[['text'=>"$key1_3",'url'=>"https://t.me/$channel"]],
[['text'=>"$key1_2",'callback_data'=>"$key1_2"],['text'=>"$key1_4",'callback_data'=>"$key1_4"]],
]]);
sendMessage($chat_id,"به بخش دریافت الماس رایگان خوش آمدید
در این جا با توجه به نوع پنلتان الماس دریافت میکنید

🥇پنل طلایی : ضریب ۱.۲
🥈پنل نقره ای: ضریب ۱
🥉پنل برنزی : ضریب ۰.۸

 سپس میتونید با استفاده از الماس هایی که دارید از بخش ثبت تبلیغ در ربات تبلیغ خودرا ثبت کنید

 👈سه روش برای جمع آوری الماس وجود دارد:

 1⃣الماس روزانه :
با استفاده از دکمه الماش روزانه میتوانید هر ۲۴ ساعت الماس رایگان دریافت کنید

2⃣مشاهده تبلیغ درون کانال: در این روش شما در یک کانال تبلیغ ها را مشاهده میکنید و سپس با زدن دکمه دریافت الماس زیر هر پست، یک الماس دریافت میکنید.

3⃣دریافت الماس از طریق سین زدن بنر : با استفاده از دکمه دریافت بنر ، بنری به شما تحویل داده میشود که با سین زدن آن بنر میتوانید الماس رایگان کسب کنید

حالا یکی از گزینه های زیر را برای دریافت الماس انتخاب نمایید

 ","html",$askey);
}

if($data == $key1_2){
date_default_timezone_set('Asia/Tehran');
$chat_id = $update->callback_query->message->chat->id;
$status = file_get_contents("data/user/$chat_id/statusdily.txt");
$date = date("Y/m/d");
if($status == $date){
answerCallbackQuery($userid,"⏱ شما قبلا الماس روزانه خود را دریافت کرده اید",true);
}else{
if($plan == "برنزی"){
$vif = $gift;
}
if($plan == "نقره ای"){
$vif = $gift2;
}
if($plan == "طلایی"){
$vif = $gift3;
}
$coin = file_get_contents("data/user/$chat_id/coin.txt");
save("data/user/$chat_id/coin.txt",$coin+$vif);
save("data/user/$chat_id/statusdily.txt",$date);
answerCallbackQuery($userid,"🌹 مقدار $vif الماس هدیه به شما تعلق گرفت",true);
}
}

if($data == $key1_4){
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
sendMessage($chat_id,$text2,"html");
}

if($text == $key2){
if(isset($username)){$okuser="@$username"; }else{ $okuser="ندارد";}
$askey = json_encode([
'inline_keyboard'=> [
//[['text' => "👤 مشخصات پروفایل شما 👤", 'callback_data' => "a"]],
[['text' => "$first_name", 'callback_data' => "a"],['text' => "🗣نام کاربری شما", 'callback_data' => "a"]],
[['text' => "$chat_id", 'callback_data' => "a"],['text' => "🔰شماره کاربری", 'callback_data' => "a"]],
[['text' => "$okuser", 'callback_data' => "a"],['text' => "🆔یوزرنیم شما", 'callback_data' => "a"]],
[['text' => "$join", 'callback_data' => "a"],['text' => "📆تاریخ عضویت", 'callback_data' => "a"]],
[['text' => "$plan", 'callback_data' => "a"],['text' => "♻️نوع پنل شما", 'callback_data' => "a"]],
[['text' => "$war از 3", 'callback_data' => "a"],['text' => "⚠️تعداد اخطارها", 'callback_data' => "a"]],
[['text' => "✔️ موجودی حساب شما 💎", 'callback_data' => "a"]],
[['text' => "$coin", 'callback_data' => "a"],['text' => "💎الماس های شما", 'callback_data' => "a"]],
[['text' => "$zir", 'callback_data' => "a"],['text' => "👥تعداد زیرمجموعه‌های شما", 'callback_data' => "a"]],
]
]);
sendMessage($chat_id,"<a href='$chat_id'>👤 مشخصات پروفایل شما 👤</a>","html",$askey);
}

if($data == "a"){
answerCallbackQuery($userid,"📉 این دکمه نشان دهنده صورت وضعیت شما می‌باشد",true);
}

if($text == $key3){
$askey = json_encode(['inline_keyboard'=>[
[['text'=>"$bazdid1 بازدید👁‍🗨|$tedad1 الماس💎",'callback_data'=>"$tedad1 bazdid $bazdid1"],['text'=>"$bazdid2 بازدید👁‍🗨|$tedad2 الماس💎",'callback_data'=>"$tedad2 bazdid $bazdid2"]],
[['text'=>"$bazdid3 بازدید👁‍🗨|$tedad3 الماس💎",'callback_data'=>"$tedad3 bazdid $bazdid3"],['text'=>"$bazdid4 بازدید👁‍🗨|$tedad4 الماس💎",'callback_data'=>"$tedad4 bazdid $bazdid4"]],
[['text'=>"$bazdid5 بازدید👁‍🗨|$tedad5 الماس💎",'callback_data'=>"$tedad5 bazdid $bazdid5"],['text'=>"$bazdid6 بازدید👁‍🗨|$tedad6 الماس💎",'callback_data'=>"$tedad6 bazdid $bazdid6"]],
]]);
sendMessage($chat_id,$text3,"html",$askey);
}
if(fara($data,"bazdid") !== false){
$off_on = file_get_contents("data/setting/off_on_bazdid.txt");
if($off_on==""){$off_on="ok";}
if($off_on == "ok"){
$search = str_replace("bazdid ","",$data);
$explode = explode(" ", $search);
$gem = $explode[0];
if($coin >= $gem){
save("data/user/$chat_id/sabtsefaresh.txt","$search");
step("sabtsefaresh");
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
sendMessage($chat_id,"✅ تبلیغ، متن، تصویر و یا پست خود را فوروارد نمایید.

⚠️ توجه داشته باشید ثبت تبلیغ دارای محتوا های خلاف قوانین ایران اسلامی، کلاهبرداری، توهین و فحاشی، تبلیغ ربات های مشابه، پخش شماره سایر افراد و... غیر مجاز میباشد. در صورت ثبت چنین پست هایی حساب کاربر بدون اطلاع قبلی بسته خواهد شد. (قبل از ثبت تبلیغات، کلیه قوانین ما را از طریق دکمه قوانین و مقررات بررسی نمایید.)",'HTML',$back);
}else{
answerCallbackQuery($userid,"⏱ موجودی شما برای ثبت سفارش کافی نیست",false);
}
}else{
answerCallbackQuery($userid,"⏱ ثبت سفارش موقتا غیرفعال است",true);
}
}
if($step == "sabtsefaresh"){
step("none");
$search = file_get_contents("data/user/$chat_id/sabtsefaresh.txt");
$explode = explode(" ", $search);
$gem = $explode[0];
$bazdid = $explode[1];
save("data/user/$chat_id/coin.txt",$coin-$gem);
save("data/user/$chat_id/masrafi.txt",$masrafi+$gem);
save("data/done.txt",$done+1);
$done2 = file_get_contents("data/user/$chat_id/done2.txt");
save("data/user/$chat_id/done2.txt",$done2+1);
$apikey = explode(":", API_KEY)[0];$channel = file_get_contents("data/setting/channel.txt");
$channelid = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChat?chat_id=$channel"))->result->id;
global $bot;
$post_id = $bot('forwardMessage',[
	'chat_id'=>$channelid,
	'from_chat_id'=>$chat_id,
	'message_id'=>$message_id
])->result->message_id;
$bot('sendMessage',[
 'chat_id'=>$channelid,
 'text'=>"👉👉👉 💎  $bazdid  💎 👈👈👈",
 'reply_to_message_id'=>$post_id,
 'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"ثبت👁‍🗨",'callback_data'=>"submit seen-$post_id"],['text'=>'نیترو⚡️','callback_data'=>'goldr'],['text'=>"🚫 گزارش",'callback_data'=>"report post-$post_id"],['text'=>"ربـات🔙",'url'=>"https://telegram.me/$UserNameBot"]]]])
]);
is_make("data/ads");
is_make("data/ads/$post_id");
save("data/ads/$post_id/id.txt",$post_id);
save("data/ads/$post_id/tedad.txt",$bazdid);
save("data/ads/$post_id/count.txt",0);
save("data/ads/$post_id/users.txt","");
save("data/ads/$post_id/admin.txt",$chat_id);
unlink("data/user/$chat_id/sabtsefaresh.txt");
$channel = str_replace("@","",$channel);
$askey = json_encode(['inline_keyboard'=>[[['text'=>"✅ برای دیدن تبلیغ خود اینجا را ضربه بزنید",'url'=>"https://t.me/$channel/$post_id"]]]]);
sendMessage($chat_id,"✅ تبلیغ شما با موفقیت ثبت شد !!


🔎 کد رهگیری سفارش شما $post_id می باشد و میتوانید از بخش پیگیری سفارش، آمار مربوطه را مشاهده نمایید.
💢 برای رفتن به کانال تبلیغات و دیدن تبلیغ مورد نظر خود بر روی دکمه زیر کلیک‌کنید.","",$askey);
sendMessage($chat_id,"✅به منوی اصلی بازگشتید👉","",$key);
}

if(fara($data,"submit seen-") !== false){
$get = str_replace("submit seen-","",$data);
if(is_dir("data/ads/$get")){
$post_id = file_get_contents("data/ads/$get/id.txt");
$bazdid = file_get_contents("data/ads/$get/tedad.txt");
$count = file_get_contents("data/ads/$get/count.txt");
$users = file_get_contents("data/ads/$get/users.txt");
$adminp = file_get_contents("data/ads/$get/admin.txt");
if($bazdid >= $count){
$eu = explode("\n", $users);
if(in_array($chat_id,$eu)){
answerCallbackQuery($userid,"‼️ قبلا الماس این تبلیغ را دریافت کرده‌اید",false);
}else{
save("data/ads/$get/users.txt",$chat_id."\n".$users);
save("data/ads/$get/count.txt",$count+1);
$zzzz = file_get_contents("data/user/$chat_id/bazdid.txt");
save("data/user/$chat_id/bazdid.txt",$zzzz+1);
$newcoin = $coin+1;
save("data/user/$chat_id/coin.txt",$newcoin);
answerCallbackQuery($userid,"💎یک الماس دریافت شد|✅ موجودی جدید: $newcoin",false);
}
}else{
$apikey = explode(":", API_KEY)[0];$channel = file_get_contents("data/setting/channel.txt");
$channelid = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getChat?chat_id=$channel"))->result->id;
global $bot;
$bot('deletemessage', [
'chat_id'=>$channelid,
'message_id'=>$post_id,
]);
DeleteFolder("data/ads/$get");
rmdir("data/ads/$get");
answerCallbackQuery($userid,"⚠️ سفارش این تبلیغ به پایان رسیده است",false);
}
}else{
answerCallbackQuery($userid,"⚠️ سفارش این تبلیغ به پایان رسیده است",false);
}
}

if($data == "goldr"){
answerCallbackQuery($userid,"💥 نیترو فعال نیست",true);
}

if(fara($data,"report post-") !== false){
$channel = str_replace("@","",$channel);
$get = str_replace("report post-","",$data);
$post_id = file_get_contents("data/ads/$get/id.txt");
$bazdid = file_get_contents("data/ads/$get/tedad.txt");
$count = file_get_contents("data/ads/$get/count.txt");
$adminp = file_get_contents("data/ads/$get/admin.txt");
sendMessage($admin,"❇️ گزارش جدیدی دریافت شد

🔞 فرد گزارش کننده: $chat_id
🌐 لینک پست: t.me/$channel/$post_id
👤ادمین پست: $adminp
👁‍🗨 تعداد درخواستی: $bazdid
✅ تعداد دریافتی: $count
");
answerCallbackQuery($userid,"🔞 گزارش شما ثبت شد",true);
}

if($text == $key4){
$askey = json_encode(['inline_keyboard'=>[
[['text'=>"🥈 ارتقا پنل به نقره ای",'url'=>"https://t.me/$botsupport"]],
[['text'=>"🥇 ارتقا پنل به طلایی",'url'=>"https://t.me/$botsupport"]],
]]);
sendMessage($chat_id,"👤🥉پنل برنزی

✅ 0.8 الماس برای دیدن تبلیغات

✅ 15 درصد پورسانت زیر مجموعه

✅ 40 الماس برای دعوت هر زیر مجموعه

✅ تعداد $gift الماس روزانه

💳قیمت پنل : رایگان
----------------------------------
👤🥈پنل  نقره ای

✅ 1 الماس برای دیدن تبلیغات

✅ 20 درصد پورسانت زیر مجموعه

✅ 60 الماس برای دعوت هر زیر مجموعه

✅ تعداد $gift2 الماس روزانه

💳قیمت پنل : ارتقا دائمی با 50 زیر مجموعه
-------------------------------------
👤🥇پنل طلایی

✅ 1.2 الماس برای دیدن تبلیغات

✅ 25 درصد پورسانت زیر مجموعه

✅ 80 الماس برای دعوت هر زیر مجموعه

✅ تعداد $gift3 الماس روزانه

💳قیمت پنل :ارتقا دائمی به مبلغ 10,000 تومان","",$askey);
}

if($text == $key5){
$askey = json_encode(['inline_keyboard'=>[[['text'=>"$key5_2",'callback_data'=>"baner1"]],[['text'=>"$key5_3",'callback_data'=>"baner2"]]]]);
sendMessage($chat_id,"📌در سیستم زیر مجموعه گیری جم بازدید می توانید با ارسال لینک اختصاصی خود به افراد دیگر، آنها را به این ربات دعوت کرده و از دو مزیت زیر بهره مند شوید.
1 - کسب پورسانت زیر مجموعه
2 - ارتقاع به پنلهای نقره ای و طلایی

1 - کسب پورسانت زیر مجموعه
♻️ در صورت عضویت هر فردی از طریق لینک اختصاصی شما،  با توجه به نوع پنلتان پورسانت زیر مجموعه به طور دائم به شما اختصاص می یابد.
به طور مثال اگر شما دارای 15 زیر مجموعه باشید که هر کدام از انها روزانه 1000 الماس کسب کنند، شما در پایان هر روز دارای 1500 الماس خواهید بود این درصد بندی که مثال زده شد برای پنل های برنزی می باشد
پنل های نقره ای و طلایی به مراتب پورسانت بالاتری دریافت میکنند.

2 - ارتقاع به پنلهای نقره ای و طلایی
♻️ شما می توانید با داشتن ۳۰ زیر مجموعه ، پنل خود را از برنزی به نقره ای و با داشتن ۵۰ زیر مجموعه ، پنل خود را به طلایی تغییر حالت داده و از افزایش تساعدی الماس بهره مند شوید.

پنل برنزی(🥉): این پنل با زیر مجموعه گیری با 15 درصد پورسانت دارای ضریب 0.8 می باشد. یعنی با دیدن 100 تبلیغ، شما می توانید 80 الماس به دست بیاورید و با آنها برای خود تبلیغ کنید.
پنل نقره ای(🥈): این پنل با زیر مجموعه گیری با 20 درصد پورسانت دارای ضریب 1 می باشد. یعنی با دیدن 100 تبلیغ، شما می توانید 100 الماس به دست بیاورید و با آنها برای خود تبلیغ کنید.
پنل طلایی(🥇): این پنل با زیر مجموعه گیری با 25 درصد پورسانت دارای ضریب 1.2 می باشد. یعنی با دیدن 100 تبلیغ، شما می توانید 120 الماس به دست بیاورید و با آنها برای خود تبلیغ کنید.","",$askey);
}

if($data == "baner1"){
global $bot;
$bot('sendPhoto',[
'chat_id'=>$chat_id,
'photo'=>"https://t.me/$UserNameBot",
'caption'=>$text4
]);
}

if($data == "baner2"){
sendMessage($chat_id,"[$text5](https://t.me/$UserNameBot?start=$chat_id)","markdown");
}

if($text == $key6){
sendMessage($chat_id,$text6,"html");
}

if($text == $key7){
sendMessage($chat_id,$text7,"html");
}

$channel = str_replace("@","",$channel);
$topkey = json_encode(['inline_keyboard'=>[
[['text'=>"👥برترین های زیرمجموعه گیری",'callback_data'=>"topinviter"],['text'=>"✅برترین های ثبت سفارش",'callback_data'=>"topsabt"]],
[['text'=>"👁‍🗨برترین های ثبت بازدید",'callback_data'=>"topbazid"],['text'=>"💎برترین های کسب الماس",'callback_data'=>"topgetcoin"]],
[['text'=>"$key1_3",'url'=>"https://t.me/$channel"]],
]]);
if($text == $key8){
sendMessage($chat_id,"تمایل به مشاهده برترین کاربران کدام بخش دارید؟","",$topkey);
}

if($data == "topinviter"){
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
$views = getRanks("zir");
$user_view_1 = $views[0]['user'];
$mojodi_view_1 = $views[0]['coins'];
$user_view_2 = $views[1]['user'];
$mojodi_view_2 = $views[1]['coins'];
$user_view_3 = $views[2]['user'];
$mojodi_view_3 = $views[2]['coins'];
$user_view_4 = $views[3]['user'];
$mojodi_view_4 = $views[3]['coins'];
$user_view_5 = $views[4]['user'];
$mojodi_view_5 = $views[4]['coins'];
$user_view_6 = $views[5]['user'];
$mojodi_view_6 = $views[5]['coins'];
$user_view_7 = $views[6]['user'];
$mojodi_view_7 = $views[6]['coins'];
$user_view_8 = $views[7]['user'];
$mojodi_view_8 = $views[7]['coins'];
$user_view_9 = $views[8]['user'];
$mojodi_view_9 = $views[8]['coins'];
$user_view_10 = $views[9]['user'];
$mojodi_view_10 = $views[9]['coins'];
EditMessageText($chat_id,"🏆 برترین کاربران در زیرمجموعه گیری 🏆

🥇نـفـر اول
♾ شماره کاربری : $user_view_1
👤 تعداد جذب زیر مجموعه : $mojodi_view_1

🥈نـفـر دوم
♾ شماره کاربری : $user_view_2
👤 تعداد جذب زیر مجموعه : $mojodi_view_2

🥉نـفـر سـوم
♾ شماره کاربری : $user_view_3
👤 تعداد جذب زیر مجموعه : $mojodi_view_3

🏅نفر چهارم
♾ شماره کاربری : $user_view_4
👤 تعداد جذب زیر مجموعه : $mojodi_view_4

🏅نفر پنجم
♾ شماره کاربری : $user_view_5
👤 تعداد جذب زیر مجموعه : $mojodi_view_5

🏅نفر ششم
♾ شماره کاربری : $user_view_6
👤 تعداد جذب زیر مجموعه : $mojodi_view_6

🏅نفر هفتم
♾ شماره کاربری : $user_view_7
👤 تعداد جذب زیر مجموعه : $mojodi_view_7

🏅نفر هشتم
♾ شماره کاربری : $user_view_8
👤 تعداد جذب زیر مجموعه : $mojodi_view_8

🏅نفر نهم
♾ شماره کاربری : $user_view_9
👤 تعداد جذب زیر مجموعه : $mojodi_view_9

🏅نفر دهم
♾ شماره کاربری : $user_view_10
👤 تعداد جذب زیر مجموعه : $mojodi_view_10


‌‌",$topkey,$message_id);
}

if($data == "topgetcoin"){
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
$views = getRanks("coin");
$user_view_1 = $views[0]['user'];
$mojodi_view_1 = $views[0]['coins'];
$user_view_2 = $views[1]['user'];
$mojodi_view_2 = $views[1]['coins'];
$user_view_3 = $views[2]['user'];
$mojodi_view_3 = $views[2]['coins'];
$user_view_4 = $views[3]['user'];
$mojodi_view_4 = $views[3]['coins'];
$user_view_5 = $views[4]['user'];
$mojodi_view_5 = $views[4]['coins'];
$user_view_6 = $views[5]['user'];
$mojodi_view_6 = $views[5]['coins'];
$user_view_7 = $views[6]['user'];
$mojodi_view_7 = $views[6]['coins'];
$user_view_8 = $views[7]['user'];
$mojodi_view_8 = $views[7]['coins'];
$user_view_9 = $views[8]['user'];
$mojodi_view_9 = $views[8]['coins'];
$user_view_10 = $views[9]['user'];
$mojodi_view_10 = $views[9]['coins'];
EditMessageText($chat_id,"🏆 برترین کاربران در جمع آوری الماس 🏆

🥇نـفـر اول
♾ شماره کاربری : $user_view_1
💎 تعداد الماس : $mojodi_view_1

🥈نـفـر دوم
♾ شماره کاربری : $user_view_2
💎 تعداد الماس : $mojodi_view_2

🥉نـفـر سـوم
♾ شماره کاربری : $user_view_3
💎 تعداد الماس : $mojodi_view_3

🏅نفر چهارم
♾ شماره کاربری : $user_view_4
💎 تعداد الماس : $mojodi_view_4

🏅نفر پنجم
♾ شماره کاربری : $user_view_5
💎 تعداد الماس : $mojodi_view_5

🏅نفر ششم
♾ شماره کاربری : $user_view_6
💎 تعداد الماس : $mojodi_view_6

🏅نفر هفتم
♾ شماره کاربری : $user_view_7
💎 تعداد الماس : $mojodi_view_7

🏅نفر هشتم
♾ شماره کاربری : $user_view_8
💎 تعداد الماس : $mojodi_view_8

🏅نفر نهم
♾ شماره کاربری : $user_view_9
💎 تعداد الماس : $mojodi_view_9

🏅نفر دهم
♾ شماره کاربری : $user_view_10
💎 تعداد الماس : $mojodi_view_10


‌‌",$topkey,$message_id);
}

if($data == "topbazid"){
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
$views = getRanks("bazdid");
$user_view_1 = $views[0]['user'];
$mojodi_view_1 = $views[0]['coins'];
$user_view_2 = $views[1]['user'];
$mojodi_view_2 = $views[1]['coins'];
$user_view_3 = $views[2]['user'];
$mojodi_view_3 = $views[2]['coins'];
$user_view_4 = $views[3]['user'];
$mojodi_view_4 = $views[3]['coins'];
$user_view_5 = $views[4]['user'];
$mojodi_view_5 = $views[4]['coins'];
$user_view_6 = $views[5]['user'];
$mojodi_view_6 = $views[5]['coins'];
$user_view_7 = $views[6]['user'];
$mojodi_view_7 = $views[6]['coins'];
$user_view_8 = $views[7]['user'];
$mojodi_view_8 = $views[7]['coins'];
$user_view_9 = $views[8]['user'];
$mojodi_view_9 = $views[8]['coins'];
$user_view_10 = $views[9]['user'];
$mojodi_view_10 = $views[9]['coins'];
EditMessageText($chat_id,"🏆 برترین کاربران در ثبت بازدید 🏆

🥇نـفـر اول
♾ شماره کاربری : $user_view_1
👁 تعداد ثبت بازدید : $mojodi_view_1

🥈نـفـر دوم
♾ شماره کاربری : $user_view_2
👁 تعداد ثبت بازدید : $mojodi_view_2

🥉نـفـر سـوم
♾ شماره کاربری : $user_view_3
👁 تعداد ثبت بازدید : $mojodi_view_3

🏅نفر چهارم
♾ شماره کاربری : $user_view_4
👁 تعداد ثبت بازدید : $mojodi_view_4

🏅نفر پنجم
♾ شماره کاربری : $user_view_5
👁 تعداد ثبت بازدید : $mojodi_view_5

🏅نفر ششم
♾ شماره کاربری : $user_view_6
👁 تعداد ثبت بازدید : $mojodi_view_6

🏅نفر هفتم
♾ شماره کاربری : $user_view_7
👁 تعداد ثبت بازدید : $mojodi_view_7

🏅نفر هشتم
♾ شماره کاربری : $user_view_8
👁 تعداد ثبت بازدید : $mojodi_view_8

🏅نفر نهم
♾ شماره کاربری : $user_view_9
👁 تعداد ثبت بازدید : $mojodi_view_9

🏅نفر دهم
♾ شماره کاربری : $user_view_10
👁 تعداد ثبت بازدید : $mojodi_view_10


‌‌",$topkey,$message_id);
}

if($data == "topsabt"){
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
$views = getRanks("done2");
$user_view_1 = $views[0]['user'];
$mojodi_view_1 = $views[0]['coins'];
$user_view_2 = $views[1]['user'];
$mojodi_view_2 = $views[1]['coins'];
$user_view_3 = $views[2]['user'];
$mojodi_view_3 = $views[2]['coins'];
$user_view_4 = $views[3]['user'];
$mojodi_view_4 = $views[3]['coins'];
$user_view_5 = $views[4]['user'];
$mojodi_view_5 = $views[4]['coins'];
$user_view_6 = $views[5]['user'];
$mojodi_view_6 = $views[5]['coins'];
$user_view_7 = $views[6]['user'];
$mojodi_view_7 = $views[6]['coins'];
$user_view_8 = $views[7]['user'];
$mojodi_view_8 = $views[7]['coins'];
$user_view_9 = $views[8]['user'];
$mojodi_view_9 = $views[8]['coins'];
$user_view_10 = $views[9]['user'];
$mojodi_view_10 = $views[9]['coins'];
EditMessageText($chat_id,"🏆 برترین کاربران در ثبت تبلیغ 🏆

🥇نـفـر اول
♾ شماره کاربری : $user_view_1
👁‍🗨 تعداد تبت تبلیغ : $mojodi_view_1

🥈نـفـر دوم
♾ شماره کاربری : $user_view_2
👁‍🗨 تعداد تبت تبلیغ : $mojodi_view_2

🥉نـفـر سـوم
♾ شماره کاربری : $user_view_3
👁‍🗨 تعداد تبت تبلیغ : $mojodi_view_3

🏅نفر چهارم
♾ شماره کاربری : $user_view_4
👁‍🗨 تعداد تبت تبلیغ : $mojodi_view_4

🏅نفر پنجم
♾ شماره کاربری : $user_view_5
👁‍🗨 تعداد تبت تبلیغ : $mojodi_view_5

🏅نفر ششم
♾ شماره کاربری : $user_view_6
👁‍🗨 تعداد تبت تبلیغ : $mojodi_view_6

🏅نفر هفتم
♾ شماره کاربری : $user_view_7
👁‍🗨 تعداد تبت تبلیغ : $mojodi_view_7

🏅نفر هشتم
♾ شماره کاربری : $user_view_8
👁‍🗨 تعداد تبت تبلیغ : $mojodi_view_8

🏅نفر نهم
♾ شماره کاربری : $user_view_9
👁‍🗨 تعداد تبت تبلیغ : $mojodi_view_9

🏅نفر دهم
♾ شماره کاربری : $user_view_10
👁‍🗨 تعداد تبت تبلیغ : $mojodi_view_10


‌‌",$topkey,$message_id);
}

if($text == $key9){
$askey = json_encode(['inline_keyboard'=>[
[['text'=>"🔍پیگیری سفارشات🔍",'callback_data'=>"peygiri"]],
[['text'=>"📞تماس با ما",'callback_data'=>"contactus"],['text'=>"‼️قوانین",'callback_data'=>"ghavanin"]],
]]);
sendMessage($chat_id,"👈️ گزینه مورد نظر را انتخاب نمائید.","",$askey);
}

if($data == "peygiri"){
answerCallbackQuery($userid,"‼️ سفارشی یافت نشد",true);
}

if($data == "contactus"){
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
step("contactus");
sendMessage($chat_id,"✉️ متن پیام خود را با رعایت موارد زیر ارسال نمایید:

1⃣ سوال، پیام، انتقاد و پیشنهادهای خود را درون یک پیام واحد نوشته و ارسال نمایید. (از جواب دادن به مواردی که در چند پیام جداگانه ارسال می شود معذوریم)
2⃣ تا زمان دریافت پاسخ صبور باشید و از پرسش مجدد خودداری کنید.","",$back);
}

if($step == "contactus"){
step("none");
$askey = json_encode(['inline_keyboard'=>[[['text'=>"👤 پاسخ به مخاطب",'callback_data'=>"send|$chat_id"]]]]);
sendMessage($admin,"<a href='$chat_id'>$chat_id</a>:
$text","html",$askey);
sendMessage($chat_id,"✅ پیام شما توسط تیم پشتیبانی دریافت شد","",$key);
}

if(fara($data,"send|") !== false && $chat_id == $admin){
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
$id = str_replace("send|","",$data);
save("idsupp","$id");
step("jjjsendmem");
sendMessage($chat_id,"پیام خود را ارسال کنید","",$back);
}

if($step == "jjjsendmem"){
step("none");
$id = file_get_contents("idsupp");
sendMessage($id,"📬 پاسخ مدیریت:

$text");
sendMessage($chat_id,"ارسال شد","",$key);
unlink("idsupp");
}

if($data == "ghavanin"){
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
sendMessage($chat_id,"✅ ثبت تبلیغات زیر در ربات $FirstNameBot ممنوع و بدون اطلاع حذف میشوند و الماس های ان تبلیغ به حساب کاربر بازگشت نمیشوند


⛔️ثبت هرگونه تبلیغ مرتبط با ربات های مشابه(تبلیغات زیرمجموعه گیری معرفی چالش ربات و هرگونه تبلیغی که به نحوی به ربات های افزایش بازدید مرتبط باشد)

⛔️ثبت هرگونه تبلیغ مغایر با قوانین جمهوری اسلامی ایران

🚫تبلیغات اسپم و طولانی و آزاردهنده که کاربر یکباره اقدام به ثبت چند تبلیغ یکسان در لحظه میکند

🚫هرگونه مطالب کذب و غیرواقعی و برخلاف واقعیت و دارای محتوای با باورهای غلط اجتماعی و تلاش برای عضوگیری در احزاب مختلف سیاسی ، دینی و تفکرات خاص(مثل پویش های با ادیان غیر الهی)

⛔️هرگونه توهین یا فرافکنی نسبت به ادیان و اقوام مختلف در کشور و شخصیت ها و چهره های شاخص و شناخته شده در قالب مطلب سیاسی، ضد قومیتی، مطالب طنز و غیره که به شان والا و اعتقادات مذهبی تمام ادیان الهی و مراسم و عقاید اقوام  هموطن خدشه وارد کند

🚫هرگونه دعوت نامه یا برنامه ریزی برای ایجاد یک کمپین در جهت ایجاد ناهنجاری سیاسی و اجتماعی در کشور

⛔️هرگونه تبلیغ با محتوای متن عکس یا ویدیوی غیراخلاقی و جنسی (+۱۸) و دعوت پیوستن به گروه یا کانال مرتبط


⚠️ پس از مشاهده هر یک از موارد فوق در تبلیغ شما، ربات به شما اخطار میدهد در صورتی که تا سه اخطار دریافت کنید حساب کاربری شما مسدود خواهد شد

⚠️تبلیغات دارای عکس یا فیلم +۱۸، بدون اخطار حساب کاربری شخص ثبت کننده تبلیغ مسدود خواهد شد");
}

if($text == $key10){
$askey = json_encode(['inline_keyboard'=>[
[['text'=>"📈خرید پنل📈",'callback_data'=>"buypanel"],['text'=>"💎خرید الماس💎",'callback_data'=>"buygem"]],
]]);
sendMessage($chat_id,"🛍به جم مارکت خوش آمدید️

✅ بر اساس نیاز خود یکی از دکمه های زیر را انتخاب نمایید :","",$askey);
}

if($data == "buypanel"){
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
$askey = json_encode(['inline_keyboard'=>[[['text'=>"🥇 خرید پنل طلایی",'url'=>"https://t.me/$botsupport"]]]]);
sendMessage($chat_id,"✅ جهت خرید پنل گزینه مورد نظر را انتخاب نمایید تا به پشتیبانی آنلاین منتقل شوید.","",$askey);
}

if($data == "buygem"){
answerCallbackQuery($userid,"♻️ کمی صبر کنید...",false);
$askey = json_encode(['inline_keyboard'=>[[['text'=>"💎 مقدار دلخواه",'url'=>"https://t.me/$botsupport"]]]]);
sendMessage($chat_id,"✅ جهت خرید الماس گزینه مورد نظر را انتخاب نمایید تا به پشتیبانی آنلاین منتقل شوید.","",$askey);
}

if($text == $key11){
$f = file_get_contents("data/setting/off_on_atm.txt");
if($f==""){$f=="ok";}
if($f=="ok"){
step("enteqal to");
sendMessage($chat_id,"👤 شماره کاربری مقصد را وارد کنید :

👈 شماره کاربری هر فرد در قسمت حساب کاربری درج شده است.","",$back);
}else{
sendMessage($chat_id,"✔️ انتقال الماس موقتا غیرفعال شده است");
}
}

if($step == "enteqal to"){
step("enteqal to = $text");
sendMessage($chat_id,"مقدار الماس را وارد کنید","",$back);
}

if(fara($step,"enteqal to = ") !== false){
$id = str_replace("enteqal to = ","",$data);
if($text >= $coin && $text >= 10 && $text <= 100){
sendMessage($id,"از طرف $chat_id مقدار $text الماس دریافت کردید");
sendMessage($chat_id,"ارسال شد","",$key);
step("none");
}else{
sendMessage($chat_id,"تعداد الماس شما کافی نیست");
}
}

//==========[ADMIN]==========

if($chat_id == $admin){

$admi = json_encode(['keyboard'=>[
[['text'=>"🔙بازگشت"]],
[['text'=>"📊آمار ربات"],['text'=>"🗳پیام همگانی"],['text'=>"🗳فروارد همگانی"]],
[['text'=>"🤖تنظیم ربات پشتیبانی"],['text'=>"📣تنظیم کانال جوین اجباری"],['text'=>"📢تنظیم کانال تبلیغات"]],
[['text'=>"➕افزایش الماس"],['text'=>"➖کسر الماس"],['text'=>"💎الماس همگانی"]],
[['text'=>"🥇ارتقا پنل به طلایی"],['text'=>"🥈ارتقا پنل به نقره ای"],['text'=>"🥉ارتقا به پنل برنزی"]],
[['text'=>"♻️تنظیمات تبدیل موجودی"],['text'=>"📲تنظیمات ارسال اکانت"],['text'=>"🔒قفل دکمه"]],
],'resize_keyboard'=>true]);
$backpanel = json_encode(['keyboard'=>[[['text'=>"👨‍💻 برگشت"]]]]);
if($start == "/panel" || $start == "/admin" || $start == "/$admin" || $start == "👨‍💻 برگشت"){
step("none");
sendMessage($chat_id,"به پنل مدیریت خوش آمدید قربان🌹","",$admi);
return false;
}

if($text == "📊آمار ربات"){
		$users = count(scandir("data/user"));
		sendMessage($chat_id,"📊 تعداد کاربران ربات شما تا $date $time این $users می باشد");
}

if($text == "🗳پیام همگانی"){
		step("s2all");
		sendMessage($chat_id,"پیام مورد نظر را ارسال کنید","",$backpanel);
}

if($step == "s2all" and isset($text)){
		step("none");
		foreach(glob('data/user/*') as $value){
		    if(is_dir($value)){
		        $id = pathinfo($value)['filename'];
			    sendMessage($id,$text,"html");
		    }
		}
		sendMessage($chat_id,"پیام به تمامی اعضا ارسال شد","",$admi);
}

if($text == "🗳فروارد همگانی"){
		step("f2all");
		sendMessage($chat_id,"پیام مورد نظر را فروارد کنید","",$backpanel);
}

if($step == "f2all"){
		step("none");
		foreach(glob('data/user/*') as $value){
		    if(is_dir($value)){
		        $id = pathinfo($value)['filename'];
		        global $bot;
		        $bot('forwardMessage',['chat_id'=>$id,'from_chat_id'=>$chat_id,'message_id'=>$message_id]);
		    }
		}
		sendMessage($chat_id,"پیام به تمامی اعضا فروارد شد","",$admi);
}

if($text == "🤖تنظیم ربات پشتیبانی"){
		step("setidsupport");
		sendMessage($chat_id,"لطفا آیدی ربات پیام رسانی که با پیوی پرشین ساخته‌اید، را ارسال نمائید","",$backpanel);
}

if($step == "setidsupport"){
		step("none");
		save("data/setting/botsupport.txt",$text);
		sendMessage($chat_id,"ربات پشتیبانی تنظیم شد","",$admi);
}
if($text == "📣تنظیم کانال جوین اجباری"){
		step("setidchannel2");
		sendMessage($chat_id,"لطفا آیدی کانال جوین اجباری را ارسال کنید","",$backpanel);
}

if($step == "setidchannel2"){
		step("none");
		save("data/setting/channel2.txt",$text);
		sendMessage($chat_id,"کانال جوین اجباری تنظیم شد","",$admi);
}

if($text == "📢تنظیم کانال تبلیغات"){
		step("setidchannel");
		sendMessage($chat_id,"لطفا آیدی کانال تبلیغات را ارسال کنید","",$backpanel);
}

if($step == "setidchannel"){
		step("none");
		save("data/setting/channel.txt",$text);
		sendMessage($chat_id,"کانال تبلیغات تنظیم شد","",$admi);
}

if($text == "➕افزایش الماس"){
		step("coinup1");
		sendMessage($chat_id,"لطفا آیدی عددی شخص مورد نظر را بفرستید","",$backpanel);
}

if($step == "coinup1"){
		step("coinup2");
		save("8729198200",$text);
		sendMessage($chat_id,"مقدار الماس را ارسال کنید","",$backpanel);
}

if($step == "coinup2"){
		step("none");
		$id = file_get_contents("8729198200");
		$ci = file_get_contents("data/user/$id/coin.txt");
		save("data/user/$id/coin.txt",$ci+$text);
		unlink("8729198200");
		sendMessage($chat_id,"ارسال شد","",$admi);
}

if($text == "➖کسر الماس"){
		step("coindown1");
		sendMessage($chat_id,"لطفا آیدی عددی شخص مورد نظر را بفرستید","",$backpanel);
}

if($step == "coindown1"){
		step("coindown2");
		save("8729198200",$text);
		sendMessage($chat_id,"مقدار الماس را ارسال کنید","",$backpanel);
}

if($step == "coindown2"){
		step("none");
		$id = file_get_contents("8729198200");
		$ci = file_get_contents("data/user/$id/coin.txt");
		save("data/user/$id/coin.txt",$ci-$text);
		unlink("8729198200");
		sendMessage($chat_id,"کسر شد","",$admi);
}

if($text == "💎الماس همگانی"){
		step("gem2all");
		sendMessage($chat_id,"مقدار الماس را ارسال کنید","",$backpanel);
}

if($step == "gem2all"){
		step("none");
		foreach(glob('data/user/*') as $value){
		    if(is_dir($value)){
		        $id = pathinfo($value)['filename'];
		        $ci = file_get_contents("data/user/$id/coin.txt");
		        save("data/user/$id/coin.txt",$ci+$text);
		    }
		}
		sendMessage($chat_id,"به همه کاربران مقدار $text الماس اهدا شد","",$admi);
}

if($text == "🥇ارتقا پنل به طلایی"){
		step("up2talay");
		sendMessage($chat_id,"لطفا آیدی عددی شخص مورد نظر را بفرستید","",$backpanel);
}

if($step == "up2talay"){
		step("none");
		save("data/user/$text/plan.txt","طلایی");
		sendMessage($chat_id,"کاربر $text طلایی شد","",$admi);
}
if($text == "🥈ارتقا پنل به نقره ای"){
		step("up2silverr");
		sendMessage($chat_id,"لطفا آیدی عددی شخص مورد نظر را بفرستید","",$backpanel);
}

if($step == "up2silverr"){
		step("none");
		save("data/user/$text/plan.txt","نقره ای");
		sendMessage($chat_id,"کاربر $text نقره ای شد","",$admi);
}

if($text == "🥉ارتقا به پنل برنزی"){
		step("up2free");
		sendMessage($chat_id,"لطفا آیدی عددی شخص مورد نظر را بفرستید","",$backpanel);
}

if($step == "up2free"){
		step("none");
		save("data/user/$text/plan.txt","برنزی");
		sendMessage($chat_id,"کاربر $text برنزی شد","",$admi);
}

if($text == "♻️تنظیمات تبدیل موجودی"){
		$askey = json_encode(['inline_keyboard'=>[[['text'=>"تنظیم متن جدید",'callback_data'=>"tabdilnavad"]]]]);
		sendMessage($chat_id,"👈️ گزینه مورد نظر را انتخاب نمائید.","",$askey);
}

if($data == "tabdilnavad"){
		step("tabdilnavad");
		sendMessage($chat_id,"لطفا متن جدید را بفرستید","",$backpanel);
}

if($step == "tabdilnavad"){
		step("none");
		save("data/setting/text6.txt",$text);
		sendMessage($chat_id,"متن جدید باموفقیت بروزآوری شد","",$admi);
}

if($text == "📲تنظیمات ارسال اکانت"){
		$askey = json_encode(['inline_keyboard'=>[[['text'=>"تنظیم متن جدید",'callback_data'=>"ersalaccnavad"]]]]);
		sendMessage($chat_id,"👈️ گزینه مورد نظر را انتخاب نمائید.","",$askey);
}

if($data == "ersalaccnavad"){
		step("ersalaccnavad");
		sendMessage($chat_id,"لطفا متن جدید را بفرستید","",$backpanel);
}

if($step == "ersalaccnavad"){
		step("none");
		save("data/setting/text7.txt",$text);
		sendMessage($chat_id,"متن جدید باموفقیت بروزآوری شد","",$admi);
}

if($text == "🔒قفل دکمه"){
		$askey = json_encode(['inline_keyboard'=>[[['text'=>"قفل ثبت سفارش",'callback_data'=>"ghoflmem"]],[['text'=>"قفل عابربانک",'callback_data'=>"ghoflent"]]]]);
		sendMessage($chat_id,"👈️ گزینه مورد نظر را انتخاب نمائید.","",$askey);
}

if($data == "ghoflmem"){
		$f = file_get_contents("data/setting/off_on_bazdid.txt");
		if($f==""){$f=="ok";}
		if($f=="ok"){
		save("data/setting/off_on_bazdid.txt","no");
		answerCallbackQuery($userid,"❌ ثبت سفارش غیرفعال شد",true);
		}else{
		save("data/setting/off_on_bazdid.txt","ok");
		answerCallbackQuery($userid,"✅ ثبت سفارش فعال شد",true);
		}
}

if($data == "ghoflent"){
		$f = file_get_contents("data/setting/off_on_atm.txt");
		if($f==""){$f=="ok";}
		if($f=="ok"){
		save("data/setting/off_on_atm.txt","no");
		answerCallbackQuery($userid,"❌ عابر بانک غیرفعال شد",true);
		}else{
		save("data/setting/off_on_atm.txt","ok");
		answerCallbackQuery($userid,"✅ عابر بانک فعال شد",true);
		}
}
/*
#سورس#سورسکده#سورس کده ! 
😉 @Sourrce_Kade @Sourrce_Kade 😕
منبع بزن !!!!!!
*/
}
