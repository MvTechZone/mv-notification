<?php


namespace MV\Notification;


use Illuminate\Support\Facades\Facade;

class MvFacade extends Facade {
    /**
     * ------------------------------------------
     * Get the registered name of the component.
     * ------------------------------------------
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'MvNotification';
    }
}
