<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('marriage-chat', function ($customer) {
    return Auth::guard('customer')->check();
});
