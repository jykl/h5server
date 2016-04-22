<?php
/**
 * Created by IntelliJ IDEA.
 * User: work
 * Date: 16/4/19
 * Time: 上午11:41
 */

namespace App\Repositories;


use App\Element;
use App\User;

class ElementRepository
{
    public function forUser(User $user)
    {
        return Element::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
    
    public function forParentId($id){
        return Element::where('parent_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

}