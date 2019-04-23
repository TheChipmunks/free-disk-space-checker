<?php

function slack($message, $icon = ":minidisc:")
{
    $data = "payload=" . json_encode(array(
            "username" => "Disc-Space",
            "channel" => "#" . SLACK_CHANEL,
            "text" => $message,
            "icon_emoji" => $icon
        ));

    $ch = curl_init(SLACK_HOOK);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

function checkOS()
{
    $directory = "/";
    if (PHP_OS == 'WINNT') {
        $directory = "C:";
    }
    return $directory;
}

function notificationRead($flag = null)
{
    if (!is_null($flag)) {
        switch ($flag) {
            case true:
                file_put_contents('notification_read_free_space.txt', '');
                return;
            case false:
                unlink('notification_read_free_space.txt');
                return;
        }
    }

    return file_exists('notification_read_free_space.txt');
}