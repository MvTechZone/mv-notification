<?php


namespace MV\Notification;


use App\Admin;
use MV\Notification\Models\Notification;

class Mv {
    /**
     * --------------------------
     * Read a notification here
     * --------------------------
     * @param $notification_id
     * @param bool $admin
     */
    public static function readNotification($notification_id, bool $admin = false) {
        if ($admin) {
            $fetchMail = auth('admin')->user()->load('notification')
                ->notification()
                ->findOrFail($notification_id);

            //change status
            $fetchMail->update([
                'status' => true,
            ]);
        }

        $fetchMail = auth()->user()->load('notification')
            ->notification()
            ->findOrFail($notification_id);

        //change status
        $fetchMail->update([
            'status' => true,
        ]);
    }

    /**
     * --------------------------------
     * delete single notification here
     * --------------------------------
     * @param $notification_id
     * @param bool $admin
     * @return bool
     */
    public static function deleteSingleNotification($notification_id, bool $admin = false) {
        if ($admin) {
            $fetchMail = auth('admin')->user()->load('notification')
                ->notification()
                ->findOrFail($notification_id);
        } else {
            $fetchMail = auth()->user()->load('notification')
                ->notification()
                ->findOrFail($notification_id);
        }

        //delete
        if ($fetchMail->delete())
            return true;
        return false;
    }

    /**
     * -------------------------------
     * delete all notifications here
     * --------------------------------
     * @param bool $admin
     * @return bool
     */
    public static function deleteAllNotifications(bool $admin = false) {
        if ($admin) {
            $mails = auth('admin')->user()->load('notification')
                ->notification();
        } else {
            $mails = auth()->user()->load('notification')
                ->notification();
        }

        if ($mails->delete())
            return true;
        return false;
    }

    /**
     * --------------------------
     * fete latest notifications
     * --------------------------
     * @param bool $admin
     * @return
     */
    public static function latestNotifications(bool $admin = false) {
        if ($admin)
            return auth('admin')->user()->load('notification')
                ->notification()
                ->whereDate('created_at', today())
                ->where('status', false)
                ->orderByDesc('created_at')
                ->paginate(config('mv.paginate'));

        return auth()->user()->load('notification')
            ->notification()
            ->whereDate('created_at', today())
            ->where('status', false)
            ->orderByDesc('created_at')
            ->paginate(config('mv.paginate'));
    }

    /**
     * --------------------------------
     * Fetch all notifications here
     * --------------------------------
     * @param bool $admin
     * @return
     */
    public static function allNotifications(bool $admin = false) {
        if ($admin)
            return auth('admin')->user()->load('notification')
                ->notification()
                ->orderByDesc('created_at')
                ->paginate(config('mv.paginate'));

        return auth()->user()->load('notification')
            ->notification()
            ->orderByDesc('created_at')
            ->paginate(config('mv.paginate'));
    }

    /**
     * -------------------------------
     * create system notifications
     * here
     * -------------------------------
     * @param null $admin_id
     * @param null $user_id
     * @param string $subject
     * @param string $description
     * @return bool
     */
    public static function createSystemNotification($admin_id = null, $user_id = null, string $subject, string $description) {
        $status = false;
        $saveNotif = null;
        if (!empty($admin_id)) {
            foreach (Admin::all() as $admin) {
                if ($admin_id === $admin->id) {
                    Notification::query()->create([
                        'admin_id' => $admin->id,
                        'user_id' => $user_id,
                        'subject' => $subject,
                        'description' => $description,
                    ]);

                    return true;
                }

                Notification::query()->create([
                    'admin_id' => $admin->id,
                    'user_id' => $user_id,
                    'subject' => $subject,
                    'description' => $description,
                ]);

                $status = true;
            }
        } else {
            Notification::query()->create([
                'admin_id' => $admin_id,
                'user_id' => $user_id,
                'subject' => $subject,
                'description' => $description,
            ]);
        }

        if ($saveNotif) {
            $status = true;
        }

        return $status;
    }
}
