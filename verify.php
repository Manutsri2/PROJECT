<?php
    $access_token = '7E/Ub3PcomIMFVemjLJKZJqTjiPo0LgEmKL3gybU+2i4JTe/rIDpOM21XcvHVfUCnfWS/nCsoaEdSbVpGL8J2yDmpXMmk4708xxB49wY/h2G6nMEQpPJHuMz5luKXg+g/p1LnRGQFoKX+mimkVLrsgdB04t89/1O/w1cDnyilFU=';

    $url = 'https://api.line.me/v1/oauth/verify';

    $headers = array('Authorization: Bearer ' . $access_token);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;
?>    
