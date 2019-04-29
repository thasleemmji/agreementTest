<?php
use Illuminate\Support\Facades\Auth;

function isGuest() {
    if(Auth::guest()) {
        return TRUE;
    }
    return FALSE;
}

function isAdmin() {
    if(!isGuest() && Auth::user()->role) {
        return TRUE;
    }
    return FALSE;
}

function isAgent() {
    if(!isGuest() && !Auth::user()->role) {
        return TRUE;
    }
    return FALSE;
}

function get_account_route() {
    return (isAdmin()) ? 'agreements' : 'agent';
}

function get_role_name() {
    return (isAdmin()) ? 'admin' : 'agent';
}