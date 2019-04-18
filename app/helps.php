<?php

function gravatar_path($email)
{
    return "https://www.gravatar.com/avatar/" . $email . "?" . http_build_query([
        's' => 50,
        'd' => 'https://s3.amazonaws.com/laracasts/images/default-square-avatar.jpg',
    ]);
}
