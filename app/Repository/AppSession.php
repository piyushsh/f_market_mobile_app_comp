<?php
/**
 * Created by PhpStorm.
 * User: piyush sharma
 * Date: 08-10-2015
 * Time: 19:45
 */

namespace App\Repository;


use Illuminate\Session\SessionInterface;

class AppSession {

    const SESSION_ID = "user_session_id";
    const FULL_NAME = "user_full_name";
    const EMAIL_ADDRESS = "user_email_address";
    const IDEA_NAME = "user_idea_name";

    public function __construct()
    {

    }


    /**
     * Initializes new session for the user
     * @param Session $
     */
    public function initalizeNewUser(SessionInterface $session)
    {
        if(!$session->has(self::SESSION_ID))
        {
            $session->clear();
            $session->set(self::SESSION_ID,hash('md5',time()));
        }
    }
}