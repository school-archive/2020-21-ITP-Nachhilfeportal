<?php

namespace controller;

use classes\AnswerHandler;
use classes\Authentication;
use classes\Calender;
use classes\Tutor;
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
     * Display the specified resource.
     */
    public static function show()
    {
        $return = [];

        if (!isset($_GET["email"]))
            AnswerHandler::create_response_and_kill_page(false, "email missing", 404);

        if (Authentication::is_logged_in() && ($_GET["email"] === '@me' || $_GET["email"] === Authentication::$user_email)) {
            $user = User::getUser(Authentication::$user_email);
            $return['self'] = true;
        } else {
            $user = User::getUser($_GET["email"]);
            $return['self'] = false;
        }

        if (!$user) AnswerHandler::create_response_and_kill_page(false, "user not found", 404);

        if ($user->isTutor()) {
            TutorController::show($return, $user->getEmail());
        } else {
            if ($_GET["email"] === '@me' || $_GET["email"] === Authentication::$user_email || User::getUser(Authentication::$user_email)->isAdmin()) {
                $return['isTutor'] = false;
                $return['profile'] = $user;
                AnswerHandler::create_response_and_kill_page(true, $return);
            } else {
                AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
            }
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public static function update()
    {
        parse_str(file_get_contents("php://input"), $vars);

        if (!Authentication::is_logged_in())
            AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
        $user = User::getUser(Authentication::$user_email);


        //Locked
       /* if (isset($_POST['locked'])) {
            if (!$user->isAdmin())
                AnswerHandler::create_response_and_kill_page(false, "admin privileges required", 403);

            if (isset($vars['email'])) {
                $user_locked = User::getUser($vars['email']);
                $locked = ($vars['locked'] === 'true') ? 1 : 0;
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
        //Admin
        if (isset($vars['admin'])) {
            if (isset($vars['email'])) {
                $user_admin = User::getUser($vars['email']);
                $admin = ($vars['admin'] === 'true') ? 1 : 0;
                $user_admin->setAdmin($admin);
                if ($user_admin->isAdmin() === true) {
                    AnswerHandler::create_response_and_kill_page(true, "Promotion successfull ");
                } else {
                    AnswerHandler::create_response_and_kill_page(false, "Change unsuccessful");
                }
            } else {
                AnswerHandler::create_response_and_kill_page(false, 'User missing', 400);
            }

        }*/
        //Grade
        if (isset($vars['grade'])) {
            $user->setGrade(($vars['grade']!=='null') ? $vars['grade'] : null);
        }

        //Department
        if (isset($vars['department'])) {
            $user->setDepartment($vars['department']);
        }

        //Calender
        /*
         * calender: {
         *  new: [
         *      {
         *          weekday: 'Mo',
         *          time_from : '10:00'
         *          time_to: '12:00'
         *       }
         *  ],
         *  deleted: ['id1', 'id2']
         * }
         */
        if (isset($vars['calender'])) {
            foreach ($vars['calender']->new as $new) {
                $user->addCalender(Calender::hhmm_to_time($new->time_from), Calender::hhmm_to_time($new->time_to), $new->weekday);
            }

            foreach ($vars['calender']->deleted as $id) {
                User::removeCalender($id);
            }

        }

        //SetTutor
        if (isset($vars['isTutor'])) {
            if ($vars['isTutor'] !== $user->isTutorString()) {
                if($vars['isTutor'] !== 'false') {
                    TutorController::store();
                } else {
                    TutorController::destroy();
                }
            }
        }

        //Tutor
        if ($user->isTutor()) {
            TutorController::update($vars);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public static function destroy()
    {

        if (!Authentication::is_logged_in())
            AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
        if (!User::getUser(Authentication::$user_email)->isAdmin()) {
            AnswerHandler::create_response_and_kill_page(false, "admin privileges required", 403);
        } else {
            $user = User::getUser(Authentication::$user_email);
            if ($user == false) {
                AnswerHandler::create_response_and_kill_page(false, "No Data", 400);
            } else if ($user->isTutor() == true) {
                $tutor = Tutor::get_Tutor($user->getEmail());
                $tutor->delete_tutor();
                $user->deleteUser();
                AnswerHandler::create_response_and_kill_page(true, "Sucessfully deleted");
            } else {
                $user->deleteUser();
                AnswerHandler::create_response_and_kill_page(true, "Sucessfully deleted");
            }
        }
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
                if (empty($user->getCalender())) {
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

    public static function picture()
    {
        header('content-type: image/png');
        $url_extension = 'avatar_default.png';

        if (isset($_GET['email'])) {
            $url_extension = $_GET['email'];
        }

        $im = file_get_contents("/var/www/html/api/cache/profile_images/$url_extension");

        if (!$im) {
            $im = file_get_contents("/var/www/html/api/cache/profile_images/avatar_default.png");
        }

        echo $im;
    }
}