<?php

if (!function_exists('redirect_dashboard')) {
    function redirect_dashboard()
    {
        return auth()->user() && auth()->user()->is_admin
            ? redirect()->intended(route('dashboard'))
            : redirect()->intended(route('home'));
    }
}
