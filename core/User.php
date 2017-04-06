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


class User extends FPObjects {
    
    # returns true if user with session is logged in, otherwise false
    public function isLoggedIn() {
        global $ENV;
        return $this->getByKey("hash", $ENV->getSession() );
    }
    
    # get user by its email and pass
    public function getUserByLoginData( $email,$pass ) {
        if( empty( $email) || empty( $pass) ) { return; }
        $tb = $this->getTable();
        $query =    "SELECT * FROM `$tb` WHERE email='$email' AND "
                    . "pass=PASSWORD('$pass')";
        $res = $this->getMySQLHandle()->query( $query );
        if( empty( $res->num_rows ) ) { return; }
        else { return $res->fetch_object( $this->getClass() );  }
        return; 
    }
    
}
