<?php

return [
    "sandbox"         => env("BKASH_SANDBOX", true),

    "bkash_app_key"     => '4f6o0cjiki2rfm34kfdadl1eqq',
    "bkash_app_secret" => '2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b',
    "bkash_username"      => 'sandboxTokenizedUser02',
    "bkash_password"     => 'sandboxTokenizedUser02@12345',

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

    "callbackURL"     => env("BKASH_CALLBACK_URL", "http://127.0.0.1:8000/bkash/callback"),
    'timezone'        => 'Asia/Dhaka',
];
