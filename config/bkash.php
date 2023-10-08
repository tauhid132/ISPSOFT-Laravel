<?php

return [
    "sandbox"         => env("BKASH_SANDBOX", false),

    "bkash_app_key"     => '4l4f3PpgdoVqWRdXho0ecd44tc',
    "bkash_app_secret" => 'qQrWYTuyRY2mx015cWkZ5j2SZI3Bw0BIsObyoXpJ895SpOnB6dJa',
    "bkash_username"      => '01304779899',
    "bkash_password"     => 'CQ<tqJ7HFcI',

    "bkash_app_key_2"     => env("BKASH_APP_KEY_2", ""),
    "bkash_app_secret_2" => env("BKASH_APP_SECRET_2", ""),
    "bkash_username_2"      => env("BKASH_USERNAME_2", ""),
    "bkash_password_2"     => env("BKASH_PASSWORD_2", ""),

    "bkash_app_key_3"     => env("BKASH_APP_KEY_3", ""),
    "bkash_app_secret_3" => env("BKASH_APP_SECRET_3", ""),
    "bkash_username_3"      => env("BKASH_USERNAME_3", ""),
    "bkash_password_3"     => env("BKASH_PASSWORD_3", ""),

    "bkash_app_key_4"     => env("BKASH_APP_KEY_4", ""),
    "bkash_app_secret_4" => env("BKASH_APP_SECRET_4", ""),
    "bkash_username_4"      => env("BKASH_USERNAME_4", ""),
    "bkash_password_4"     => env("BKASH_PASSWORD_4", ""),

    "callbackURL"     => env("BKASH_CALLBACK_URL", "http://selfcare.localhost:8000/bkash/callback"),
    'timezone'        => 'Asia/Dhaka',
];
