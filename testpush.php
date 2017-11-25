<?php

curl -X POST \
-H 'Content-Type:application/json' \
-H 'Authorization: Bearer {ENTER_ACCESS_TOKEN}' \
-d '{
     "replyToken":"7E/Ub3PcomIMFVemjLJKZJqTjiPo0LgEmKL3gybU+2i4JTe/rIDpOM21XcvHVfUCnfWS/nCsoaEdSbVpGL8J2yDmpXMmk4708xxB49wY/h2G6nMEQpPJHuMz5luKXg+g/p1LnRGQFoKX+mimkVLrsgdB04t89/1O/w1cDnyilFU=",
     "messages":[
          {
               "type": "image",
               "originalContentUrl": "https://www.picz.in.th/images/2017/11/25/cara1017cdbd079dfe7e.jpg",
               "previewImageUrl": "https://www.picz.in.th/images/2017/11/25/cara2.jpg"
          }
      ]
}' https://api.line.me/v2/bot/message/reply

?>