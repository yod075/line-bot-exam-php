<?php
    $accessToken = "8Fp1Y/TQbjewZkj8sl/vNdO8T+GKaIcSirXZObC/T4rPufUpjbEsy4AoU9jtDhd4Vnmjm/kRdKIumpMaz7dgN2etj3c+PZWFmzYCGl1SFLYZfi4getoPREgqBHyjo9mIQK4cKSR+ssL6OnNFs8LhBQdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
{
  "type": "bubble",
  "header": {
    "type": "box",
    "layout": "horizontal",
    "contents": [
      {
        "type": "text",
        "text": "NEWS DIGEST",
        "weight": "bold",
        "color": "#aaaaaa",
        "size": "sm"
      }
    ]
  },
  "hero": {
    "type": "image",
    "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_4_news.png",
    "size": "full",
    "aspectRatio": "20:13",
    "aspectMode": "cover",
    "action": {
      "type": "uri",
      "uri": "http://linecorp.com/"
    }
  },
  "body": {
    "type": "box",
    "layout": "horizontal",
    "spacing": "md",
    "contents": [
      {
        "type": "box",
        "layout": "vertical",
        "flex": 1,
        "contents": [
          {
            "type": "image",
            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/02_1_news_thumbnail_1.png",
            "aspectMode": "cover",
            "aspectRatio": "4:3",
            "size": "sm",
            "gravity": "bottom"
          },
          {
            "type": "image",
            "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/02_1_news_thumbnail_2.png",
            "aspectMode": "cover",
            "aspectRatio": "4:3",
            "margin": "md",
            "size": "sm"
          }
        ]
      },
      {
        "type": "box",
        "layout": "vertical",
        "flex": 2,
        "contents": [
          {
            "type": "text",
            "text": "7 Things to Know for Today",
            "gravity": "top",
            "size": "xs",
            "flex": 1
          },
          {
            "type": "separator"
          },
          {
            "type": "text",
            "text": "Hay fever goes wild",
            "gravity": "center",
            "size": "xs",
            "flex": 2
          },
          {
            "type": "separator"
          },
          {
            "type": "text",
            "text": "LINE Pay Begins Barcode Payment Service",
            "gravity": "center",
            "size": "xs",
            "flex": 2
          },
          {
            "type": "separator"
          },
          {
            "type": "text",
            "text": "LINE Adds LINE Wallet",
            "gravity": "bottom",
            "size": "xs",
            "flex": 1
          }
        ]
      }
    ]
  },
  "footer": {
    "type": "box",
    "layout": "horizontal",
    "contents": [
      {
        "type": "button",
        "action": {
          "type": "uri",
          "label": "More",
          "uri": "https://linecorp.com"
        }
      }
    ]
  }
}
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Text"
    if($message == "สวัสดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Sticker"
    else if($message == "ฝันดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "46";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Image"
    else if($message == "รูปน้องแมว"){
        $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Location"
    else if($message == "พิกัดสยามพารากอน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "52114131";
        $arrayPostData['messages'][1]['stickerId'] = "131";
        replyMsg($arrayHeader,$arrayPostData);
    }
#ตัวอย่าง Message Type "Video"
   else if($message == "video"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "video";
        $arrayPostData['messages'][0]['originalContentUrl'] = "https://www.youtube.com/watch?v=wftjwZa8xyg";//ใส่ url ของ video ที่ต้องการส่ง
        $arrayPostData['messages'][0]['previewImageUrl'] = "https://wallpaperbrowse.com/media/images/303836.jpg";//ใส่รูป preview ของ video
        replyMsg($arrayHeader,$arrayPostData);
    }
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>
