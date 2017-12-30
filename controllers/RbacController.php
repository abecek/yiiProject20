<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 2017-12-30
 * Time: 02:41
 */

namespace app\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $rule = new \app\rbac\UserGroupRule;
        $auth->add($rule);

        // add "viewThreads" permission
        $viewThreads = $auth->createPermission('viewThreads');
        $viewThreads->description = 'View threads';
        $auth->add($viewThreads);

// add "viewPosts" permission
        $viewPosts = $auth->createPermission('viewPosts');
        $viewPosts->description = 'View posts';
        $auth->add($viewPosts);

// User
        $user = $auth->createRole('user');
        $user->ruleName = $rule->name;
        $auth->add($user);
        $auth->addChild($user, $viewThreads);
        $auth->addChild($user, $viewPosts);


// add "createThread" permission
        $createThread = $auth->createPermission('createThread');
        $createThread->description = 'Create thread';
        $auth->add($createThread);

// add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create post';
        $auth->add($createPost);

// User Activated
        $userActivated = $auth->createRole('userActivated');
        $userActivated->ruleName = $rule->name;
        $auth->add($userActivated);
        $auth->addChild($userActivated, $createThread);
        $auth->addChild($userActivated, $createPost);


        /*
        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "deletePost" permission
        $updatePost = $auth->createPermission('deletePost');
        $updatePost->description = 'Delete post';
        $auth->add($updatePost);
        */

//AUTHOR todo: AUTHOR


// add "deleteThreads" permission
        $deleteThreads = $auth->createPermission('deleteThreads');
        $deleteThreads->description = 'Delete threads';
        $auth->add($deleteThreads);

// add "deletePosts" permission
        $deletePosts = $auth->createPermission('deletePosts');
        $deletePosts->description = 'Delete posts';
        $auth->add($deletePosts);

// add "closeThreads" permission
        $closeThreads = $auth->createPermission('closeThreads');
        $closeThreads->description = 'Close threads';
        $auth->add($closeThreads);

        $moderator = $auth->createRole('moderator');
        $moderator->ruleName = $rule->name;
        $auth->add($moderator);
        $auth->addChild($moderator, $deleteThreads);
        $auth->addChild($moderator, $deletePosts);
        $auth->addChild($moderator, $closeThreads);


    }
}