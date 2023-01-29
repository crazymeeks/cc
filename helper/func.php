<?php

if (!function_exists('is_testing')) {

    /**
     * Check environment mode
     *
     * @return boolean
     */
    function is_testing() {
        return config('app.env') == 'testing';
    }
}