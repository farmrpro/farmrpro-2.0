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
    
    # check given email, send a reset request
    public function requestPasswordReset( $param ) {
        global $LANG;
        $email = filter_input( INPUT_POST,"email" );
        
        # check
        if( empty( $email ) || ! preg_match("/^[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/i",$email ) ) {
            $this->showResetPass("errmsg=true"); 
            return; 
        }
        
        # creates temporary hash, save hash to user entry identified by email
        $tb = (new User())->getTable();
        $tmphash = sha1(time().$email);
        $query = "UPDATE `$tb` SET hash='$tmphash' WHERE email='$email'";
        
        # if successfull, send email, show success dialogue
        if( (new User())->getMySQLHandle()->query( $query ) ) {
            
            # TODO: Implement EMail class
            # see ticket: https://github.com/farmrpro/farmrpro-2.0/issues
            #
            #
            
            ?>
            <h2><?php echo __resetPassSuccessTopic__; ?></h2>
            <p><?php echo __resetPassSuccessContent__; ?></p>
            <?php
        }
        
        # otherwise show reset dialogue with error message
        else { 
            $this->showResetPass("errmsg=true"); 
            return;
        }
    }

    # shows the dialogue for resetting the password
    public function showResetPass( $param='' ) {
        global $LANG;
        parse_str( $param );
        ?>
        <h2><?php echo __resetPassTopic__; ?></h2>
        <p><?php echo __resetPassContent__; ?></p>
        
        <?php if( ! empty( $errmsg ) ) : ?>
        <p class="error"><?php echo __resetPassError__; ?></p>
        <?php endif; ?>
        
        <p><input type="text" name="email" id="email" class="w100"
        placeholder="E-Mail"/></p>
        
        <p>
            <button class="w100" onclick="action.setResetPass();">
                <?php echo __resetPassButton__; ?>
            </button>
        </p>
        <?php
    }
    
    # login the user, set time and hash
    public function userLogin() {
        global $USER, $ENV;
        $email = filter_input( INPUT_POST,"email");
        $pass = filter_input( INPUT_POST,"pass");
        if( empty( $email ) || empty( $pass ) ) { return; }
        $USER = (new User())->getUserByLoginData( $email,$pass );
        
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
   
    # Setter Methods ===========================================================
   
   
    # creates a random password and send it by email
    public function setNewPassword() {
        global $USER, $ENV;
        $USER = $USER->getByKey("hash",$ENV->getPerformHash());
        if( empty( $USER ) ) die("Nee");
        $split = str_split( md5( time().$USER->realname ), 8);   
        $newpass = "!!".$split[0]."+"; 
        $USER->setValue('pass',sha1($newpass));
        # TODO: send E-Mail with new password
        # ...
        # show succcess dialog
        header("Location: ".$ENV->getDialogLink("resetPasswordDone"));
    }
}
