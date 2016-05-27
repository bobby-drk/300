<?php
namespace App\Helpers;

/**
 * Alert
 *    Simple class to handle flash message in a why that allow
 *  for mutliple message to be used at one time.
 *
 *  @param $msg - the message to display [required]
 *  @param $alert_object - message settings
 *
 *  Example of use:
 *
 *  Alert::add("No option message!");
 *  Alert::add("First warning Message", ["alert_type" => "warning"]);
 *  Alert::add("Closeable Success", ["alert_type" => "success", "dismissible" => TRUE]);
 *
 *
 * Example Display:
 *
 * @foreach (Alert::get() as $i => $alert)
 *   <p class="alert alert-{{ isset($alert['alert_type']) ? $alert['alert_type'] : 'success' }}">
 *
 *        @if(isset($alert['dismissible']) && $alert['dismissible'] == TRUE)
 *            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 *        @endif
 *
 *        {{ $alert['alert'] }}
 *
 *    </p>
 * @endforeach
 *
 */

class Alert
{
    static function add($msg, $alert_object = [])
    {

        $alert_object["alert"] = $msg;

        session()->push('alerts', $alert_object);
    }

    static function check()
    {
        return session()->has('alerts');
    }

    static function get()
    {
        return session()->pull('alerts'); //gets and deletes
    }
}