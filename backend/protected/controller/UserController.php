<?php

namespace controller;

use classes\AnswerHandler;
use classes\Authentication;
use classes\User;

class UserController
{
    /**
     * Display a listing of the resource.
     * Only for admins
     */
    public static function index()
    {
        if (!Authentication::is_logged_in())
            AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
        if (!User::getUser(Authentication::$user_email)->isAdmin())
            AnswerHandler::create_response_and_kill_page(false, "admin privileges required", 403);

        $count = isset($_GET["count"]) ? $_GET["count"] : 10;
        $offset = isset($_GET["offset"]) ? $_GET["offset"] : 0;

        AnswerHandler::create_response_and_kill_page(true, User::get_users($count, $offset));
    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public static function show()
    {
        $user = User::class;
        $return = [];

        if (isset($_GET["email"])) {
            $user = User::getUser($_GET["email"]);
            if (!$user) AnswerHandler::create_response_and_kill_page(false, "user not found", 404);
            AnswerHandler::create_response_and_kill_page(true, $user);
            $return['self'] = false;
        } else {
            if (!Authentication::is_logged_in())
                AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
            $user = User::getUser(Authentication::$user_email);
            $return['self'] = true;
        }

        $return['profile'] = $user;
        AnswerHandler::create_response_and_kill_page(true, $return);
    }


    /**
     * Update the specified resource in storage.
     */
    public static function update()
    {
        if (!Authentication::is_logged_in())
            AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
        $user = User::getUser(Authentication::$user_email);

        if (isset($_GET['locked'])) {
            if (!$user->isAdmin())
                AnswerHandler::create_response_and_kill_page(false, "admin privileges required", 403);

            if (isset($_GET['email'])) {
                $user_locked = User::getUser($_GET['email']);
                $locked = ($_GET['locked'] === 'true') ? 1 : 0;
                $user_locked->setLocked($locked);
                if ($user_locked->getLocked() === $locked) {
                    AnswerHandler::create_response_and_kill_page(true, "User successfully locked/unlocked");
                } else {
                    AnswerHandler::create_response_and_kill_page(false, "Change unsuccessful");
                }
            } else {
                AnswerHandler::create_response_and_kill_page(false, 'User missing', 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }

    /**
     * Übergangsläsung, gibt alle Tutoren zurück
     */
    public static function filter()
    {
        AnswerHandler::create_response_and_kill_page(true, User::filterUser());
    }

    /**
     * If the User is not a Tutor and hasn't set any properties yet
     */
    public static function ifUnsetTutor()
    {
        if (!Authentication::is_logged_in())
            AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);

        $user = User::getUser(Authentication::$user_email);
        if (!$user->isTutor()) {
            if ($user->getSubjects() == null) {
                if (empty($user->getAllCalendersFromUser())) {
                    if ($user->getGrade() == null) {
                        if ($user->getDepartment() == null) {
                            AnswerHandler::create_response_and_kill_page(true, ["unsettutor" => true]);
                        }
                    }
                } else {
                    AnswerHandler::create_response_and_kill_page(true, ["unsettutor" => false]);
                }
            }
        }
    }
}