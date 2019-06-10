<?php

namespace MV\Notification\Models;

use App\Admin;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model {
    //set attributes
    protected $guarded = [];

    /**
     * get admin who belong to
     * the notifications
     * @return BelongsTo
     */
    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    /**
     * get user who belong to
     * the notifications
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
