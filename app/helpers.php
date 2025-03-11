<?php

if (!function_exists('match_status_color')) {
    function match_status_color(string $status): string
    {
        return match ($status) {
            'scheduled' => 'blue',
            'in_progress' => 'yellow',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray',
        };
    }
}