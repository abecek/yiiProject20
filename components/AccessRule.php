<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-12-30
 * Time: 03:14
 */

namespace app\components;

use app\models\User;

class AccessRule extends \yii\filters\AccessRule
{

    protected function matchRole($user){
        if(empty($this->roles)){
            return true;
        }

        foreach ($this->roles as $rank) {
            if ($rank == '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            }
            elseif ($rank == User::ROLE_USER) {
                if (!$user->getIsGuest()) {
                    return true;
                }
                // Check if the user is logged in, and the roles match
            }
            /*
            elseif (!$user->getIsGuest() && $rank === '@') {
                return true;
            }
            */
            elseif (!$user->getIsGuest() && $rank == $user->identity->rank) {
                return true;
            }
        }

        return false;
    }
}

