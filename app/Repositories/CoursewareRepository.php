<?php
/**
 * Created by IntelliJ IDEA.
 * User: work
 * Date: 16/4/19
 * Time: 下午2:12
 */

namespace App\Repositories;

use App\Courseware;
use App\User;

class CoursewareRepository
{
    public function forUser(User $user)
    {
        return Courseware::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}