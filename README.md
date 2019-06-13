# <p align="center"><a href="#" target="_blank"><img src="https://mvtechzone.com/img/codelets.png"></a></p>

<p align="center">
  <b>Makes Laravel Notification a Breeze...</b><br>
  <a href="https://github.com/MvTechZone/mv-notification/issues">
  <img src="https://img.shields.io/github/issues/MvTechZone/mv-notification.svg">
  </a>
  <a href="https://github.com/MvTechZone/mv-notification/network/members">
  <img src="https://img.shields.io/github/forks/MvTechZone/mv-notification.svg">
  </a>
  <a href="https://github.com/MvTechZone/mv-notification/stargazers">
  <img src="https://img.shields.io/github/stars/MvTechZone/mv-notification.svg">
  </a>
  <br><br>
</p>

This package is custom notify for both admins and users, so instead of using laravel notification. Build for my projects if you want to try it out read through the documentation. 

## Installing

The recommended way to install tpay-api is through
[Composer](http://getcomposer.org).

```bash
# Install package via composer
composer require codelets-mv/notification
```

Next, run the Composer command to install the latest stable version of *codelets-mv/notification*:

```bash
# Update package via composer
 composer require codelets-mv/notification --lock
```

After installing, the package will be auto discovered, But if need you may run:

```php
# run for auto discovery <-- If the package is not detected automatically -->
composer dump-autoload
```

Then run this, to get the *config/mv-notification.php* for configurations:

```php
# run this to get the configuartion file at config/mv-notification.php <-- read through it -->
php artisan vendor:publish --provider="MV\Notification\MvNotificationService"
```

You will have to provide this in the *.env* for the api configurations:

```php
# This is the pagination number you want to paginate with <-- default(10) -->
MV_NOTIFICATION_PAGINATE=
```
## Usage
Follow the steps below on how to use the package:

```php
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //The instance should be either this
        $this->middleware('auth:admin');//for your admin controller
        //or
        $this->middleware('auth');//for your user Controller
    }

    /**
     * ---------------------------------
     * Fetch Latest Notification Here
     * --------------------------------
     * Passing bool - true - to the function will query admin notification only
     * @return void
     */
    public function latestNotifications() {
        Mv::latestNotifications();//Fetching latest notification for user
        Mv::latestNotifications(true);//Fetching latest notification for admin
    }

    /**
     * --------------------------------
     * Fetching all notifications
     * -------------------------------
     * Passing bool - true - to the function will query admin notification only
     * @return void
     */
    public function allNotifications() {
        Mv::allNotifications();//Fetching all notifications for user
        Mv::allNotifications(true);//Fetching all notifications for admin
    }

    /**
     * =-------------------------------
     * Deleting a single notification
     * --------------------------------
     * Passing bool - true - to the function will query admin notification only
     * ------------------------------------------------------------------------------
     * To achieve single notification create a route that receives a (string) notification_id
     * Note that this package uses uuids so the notification_id has to be a string
     * ----------------------------------------------------------------------------------------
     * Passing bool - true - to the function will query admin notification only
     * -----------------------------------------------------------------------------------------------
     * @param string $notification_id
     * @return void
     */
    public function deleteSingleNotification(string $notification_id) {
        Mv::deleteSingleNotification($notification_id);//For user
        Mv::deleteSingleNotification($notification_id, true);//For admin
    }

    /**
     * =-------------------------------
     * Deleting a all notification
     * --------------------------------
     * Passing bool - true - to the function will query admin notification only
     * ------------------------------------------------------------------------------
     * Passing bool - true - to the function will query admin notification only
     * ----------------------------------------------------------------------------------
     * @return void
     */
    public function deleteAllNotifications() {
        Mv::deleteAllNotifications();//For user
        Mv::deleteAllNotifications(true);//For admin
    }

    /**
     * --------------------------------
     * Creating new notification here
     * --------------------------------
     * In creating notification we need 4 parameters of which 2 are optional that is for user_id and admin_id
     * -------------------------------------------------------------------------------------------------------
     * Also you can have your function that receives the parameters and passes them to Mv::createSystemNotification
     * --------------------------------------------------------------------------------------------------------------
     * @return void
     */
    public function createSystemNotification() {
        //This is for creating user notifications
        Mv::createSystemNotification(null, auth()->id(), 'My Notification Subject', 'My Notification Message');

        //This is for creating admin notifications
        Mv::createSystemNotification(auth('admin')->id(), null, 'My Notification Subject', 'My Notification Message');
    }


    /**
     * ---------------------------
     * TODO SIMPLE PACKAGE NOTES
     * -----------------------------------------------------------------------------------------
     * For the functions used above can be changed to your own names to call the package names
     * -----------------------------------------------------------------------------------------
     */


```

## Version Guidance

| Version | Status     | Packagist           | Namespace    | Repo                |
|---------|------------|---------------------|--------------|---------------------|
| 1.x     | Latest     | `codelets-mv/notification` | `MV\Notification` | [v1.0.0](https://github.com/MvTechZone/mv-notification/tree/1.0)|

[mv-notification-1-repo]: https://github.com/MvTechZone/mv-notification.git

## Security Vulnerabilities
 For any security vulnerabilities, please email to [MvTechZone](info@mvtechzone.com).
