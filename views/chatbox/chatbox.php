<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Chatbox';

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
            <div class="chatbox" style="background-color: rgb(220, 247, 255); border-radius: 7px; padding: 10px;">
                <div class="chatbox-container" style="max-width: 100%; max-height: 500px; overflow: auto;">
                    <div class="chatbox-message chatbox-message-left" style="background-color: rgb(255, 250, 215); border-radius: 7px; padding: 10px;">
                        <div class="chatbox-user-avatar" style="float: left; margin: 5px; width: 75px; height: 75px; border: 1px black solid;">
                            img
                        </div>
                        <p class="chatbox-user-data" style="font-size: smaller;">
                            Date: 28/12/2017 02:19:34
                            <br>
                            <b>Abecek</b>
                        </p>
                        <p class="chatbox-user-message" style="">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                    </div>

                    <div class="chatbox-message chatbox-message-right" style="background-color: rgb(255, 253, 227); border-radius: 7px; padding: 10px;">
                        <div class="chatbox-user-avatar" style="float: right; margin: 5px; width: 75px; height: 75px; border: 1px black solid;">
                            img
                        </div>
                        <p class="chatbox-user-data" style="font-size: smaller;">
                            Date: 28/12/2017 02:20:01
                            <br>
                            <b>Abecek2</b>
                        </p>
                        <p class="chatbox-user-message" style="">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                    </div>
                </div>

                <div class="chatbox-message-new" style="padding: 10px;">
                    <form name="message-form" class="form" >
                        <div class="form-group">
                            <label for="text-message">
                                New message:
                            </label>
                            <textarea id="text-message" name="text" class="form-control" style="min-width: 100%; min-height: 70px; max-width: 100%; max-height: 150px; overflow: auto;"></textarea>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block">
                            Send!
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>
