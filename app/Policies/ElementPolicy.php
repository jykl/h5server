<?php

namespace App\Policies;

use App\Element;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ElementPolicy
{
    use HandlesAuthorization;


    public function show(User $user, Element $element)
    {
        switch ($user->authority) {
            case 0:
                return false;
            case 1:
            case 2:
            case 3:
            case 4:
                return true;

        }
    }

    /**
     * 切片发布权限控制,仅仅4~5级权限能够不经过审核就发布
     *
     *
     * @param User $user
     * @return bool
     */
    public function publish(User $user,Element $element)
    {

        switch ($user->authority) {
            case 0:
            case 1:
            case 2:
                return false;
            case 3:
            case 4:
                return true;
        }
    }
    public function addElement(User $user,Element $element){
        switch ($user->authority) {
            case 0:
            case 1:
            case 2:
                return false;
            case 3:
            case 4:
                return true;
        }
    }

    public function destroy(User $user, Element $element)
    {
        if ($user->authority >= 1) {
            return true;
        }
        return false;

//        return $user->id === $element->user_id;
    }

    public function update(User $user, Element $element)
    {
        if ($user->authority >= 1) {
            return true;
        }
        return false;

//        return $user->id === $element->user_id;
    }
}
