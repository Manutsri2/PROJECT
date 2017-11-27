<?php

$access_token = '7E/Ub3PcomIMFVemjLJKZJqTjiPo0LgEmKL3gybU+2i4JTe/rIDpOM21XcvHVfUCnfWS/nCsoaEdSbVpGL8J2yDmpXMmk4708xxB49wY/h2G6nMEQpPJHuMz5luKXg+g/p1LnRGQFoKX+mimkVLrsgdB04t89/1O/w1cDnyilFU=';

$doc = new DomDocument;
$doc->validateOnParse = true;
$doc->Load('graduate.xml');
$announce = $doc->getElementsByTagName('graduate');

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			if($text == "1")
			{
			$k = 0;
			$obj1 = $announce->item($k)->getElementsByTagName('title')->item(0)->nodeValue.'<br>';
			$obj2 = $announce->item($k)->getElementsByTagName('intro')->item(0)->nodeValue;
			$obj1_1 = $announce->item($k)->getElementsByTagName('pic1')->item(0)->nodeValue;
			$obj1_2 = $announce->item($k)->getElementsByTagName('pic2')->item(0)->nodeValue;
			// Build message to reply back
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => $obj1.$obj2
				
				];
			$messages2 = 
				[
				
				'type' => 'image',
    				'originalContentUrl' => $obj1_1,
    				'previewImageUrl' => $obj1_2
				
				];
				
			}
			else if($text == "2")
			{
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => '2.สถานที่ฝึกซ้อมย่อยและถ่ายรูปหมู่'
				
				];
			$messages2 =
				[
				
				'type' => 'image',
    				'originalContentUrl' => 'https://www.picz.in.th/images/2017/11/27/space1.jpg',
    				'previewImageUrl' => 'https://www.picz.in.th/images/2017/11/27/space2.jpg'
				
				];
			}
			else if($text == "3")
			{
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => '3.การแต่งกายของบัณฑิต'
				
				];
			$messages2 =
				[
				
				'type' => 'image',
    				'originalContentUrl' => 'https://www.picz.in.th/images/2017/11/27/jayjung1.jpg',
    				'previewImageUrl' => 'https://www.picz.in.th/images/2017/11/27/jayjung2.jpg'
				
				];
			}
			else if($text == "4")
			{
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => '4.ระบบภาวะการมีงานทำ'
				
				];
			$messages2 =
				[
				
				'type' => 'text',
    				'text' => 'http://graduate.rmutsv.ac.th/2560/?q=th/studentwork'
				
				];
			}
			else if($text == "000")
			{
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => 'ติดต่อเจ้าหน้าที่'
				
				];
			$messages2 =
				[
				
				'type' => 'text',
    				'text' => 'โทร. 090-000-0000'
				
				];
			}
			else if($text == "?")
			{
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => 'กรุณาพิมพ์ตัวเลขต่างๆ ที่ปรากฏด้านล่าง เพื่อสอบถามข้อมูลที่ท่านต้องการทราบ'
				
				];
			$messages2 =
				[
				
				'type' => 'text',
    				'text' => '1=กำหนดการและสถานที่รายงานตัวฝึกซ้อมและวันรับปริญญาบัตร 2=สถานที่ฝึกซ้อมย่อยและถ่ายรูปหมู่ 3=การแต่งกายของบัณฑิต 4=ระบบภาวะการมีงานทำ 000=ติดต่อเจ้าหน้าที่'
				
				];
			}
			else
			{
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => 'ไม่มีข้อมูลที่ท่านสอบถาม'
				
				];
			$messages2 =
				[
				
				'type' => 'text',
    				'text' => 'หากต้องการสอบถามข้อมูลอีกครั้งท่านสามารถพิมพ์ ?'
				
				];
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages,$messages2],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
