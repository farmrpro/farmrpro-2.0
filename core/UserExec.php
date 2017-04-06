<?php

/*
 * Copyright (C) 2017 Sebastian Schwaner
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class UserExec extends User {

    # login the user, set time and hash
    public function userLogin() {
        global $USER, $ENV;
        $email = filter_input( INPUT_POST,"email");
        $pass = filter_input( INPUT_POST,"pass");
        if( empty( $email ) || empty( $pass ) ) { return; }
        $USER = $USER->getUserByLoginData( $email,$pass );
        
        # log failed login attempt with email
        if( empty( $USER ) ) { 
            logErr("Login failed: Couldn't find user '$email' with matching password!");
            header("Location: ".$ENV->getLoginLink()."?errmsg=true");
            return;
        }
        
        # login, set hash and new timecode
        $USER->setValue("hash",$ENV->getSession());
        $USER->setValue("last_online",time());
        
        # relocate to index page
        header("Location: ".$ENV->getBackOfficeLink());
        return;
   } 
}
