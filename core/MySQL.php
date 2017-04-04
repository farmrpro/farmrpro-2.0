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

class MySQL {
    
    private $env;
    
    # public constructor
    public function __construct() {
        global $ENV;
        $this->env = $ENV;
        $this->readMysqlConfig();
    }
    
    public function getMysqlHandle() { return $this->handle; }
    public function getMysqlPrefix() { return env_mysql_table_prefix; }
    public function getMysqlServer() { return env_mysql_server; }
    public function getMysqlUser() { return env_mysql_user; }
    public function getMysqlPass() { return env_mysql_pass; }
    public function getMysqlDatabase() { return env_mysql_database; }
    
    # get the mysql config from config.php
    private function readMysqlConfig() {
       if( file_exists( $this->env->getPath()."config.php" ) ) {
           # include config file
           require_once $this->env->getPath()."config.php";
       }
       else { return logErr("Couldn't load 'config.php': File not found!"); }
    }
    
    # connects with the MySQL server defined in config.php
    public function openMysqlConnection() {
        
        $this->readMysqlConfig();
        $this->handle = new mysqli(
                            env_mysql_server,
                            env_mysql_user,
                            env_mysql_pass,
                            env_mysql_database
                        );
        
        if( empty($this->handle) ) { 
            return logErr("Couldn't establish connection to MySQL server!"); 
        }
        return 1;
    }
    
    # closes the connection with handle
    public static function closeMysqlConnection() {
        if( ! $this->handle->close() ) { 
            return logErr("Couldn't terminate MySQL connection!"); 
        }
    }
}
