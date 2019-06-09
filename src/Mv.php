<?php


namespace MV\Notification;


use App\Admin;

class Mv {
    /**
     * create system notifications
     * here
     * @param null $admin_id
     * @param null $user_id
     * @param string $subject
     * @param string $description
     * @return object
     */
    public static function createSystemNotification($admin_id = null, $user_id = null, string $subject, string $description) {
        if (!empty($admin_id)) {
            foreach (Admin::all() as $admin) {
                if ($admin_id === $admin->id) {
                    $saveNotif = new Notification([
                        'admin_id' => $admin->id,
                        'user_id' => $user_id,
                        'subject' => $subject,
                        'description' => $description,
                    ]);
                    $saveNotif->save();

                    return (Object)[
                        'success' => true,
                        'message' => 'Notification Saved...',
                    ];

                }

                $saveNotif = new Notification([
                    'admin_id' => $admin->id,
                    'user_id' => $user_id,
                    'subject' => $subject,
                    'description' => $description,
                ]);
                $saveNotif->save();


                return (Object)[
                    'success' => true,
                    'message' => 'Notification Saved...',
                ];

            }
        } else {
            $saveNotif = new Notification([
                'admin_id' => $admin_id,
                'user_id' => $user_id,
                'subject' => $subject,
                'description' => $description,
            ]);
            $saveNotif->save();
        }

        if ($saveNotif) {
            return (Object)[
                'success' => true,
                'message' => 'Notification Saved...',
            ];

        }

        return (Object)[
            'success' => false,
            'message' => 'Notification Failed...',
        ];
    }
}
