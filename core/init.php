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

# BASIC ITERATIVE METHODS =====================================================

# lazy class loader
spl_autoload_register(function ($class_name) {
    $classfile = "core/$class_name.php";
    if( file_exists("./$classfile")) include "./$classfile";
    elseif( file_exists("../$classfile") ) include "../$classfile";
    else logErr("Couldn't load class file '$class_name': File not found!");
});

# error logger
function logErr( $err ) {
    if( file_exists("./logs/errors.log") ) { $file = "./logs/errors.log"; }
    if( file_exists("../logs/errors.log") ) { $file = "../logs/errors.log"; }
    
    $logmsg = date("Y-m-d G:i",time())."\t".$err;
    
    # open log, write to log1
    $fhandle = fopen($file,"a");
    fwrite($fhandle,$logmsg."\n");
    fclose($fhandle);
    
    return 0;
}

# INITIALIZE THE SOFTWARE ======================================================

global $ENV, $MYSQL, $USER, $LANG;

# now the OOP becomes the mastermind
$ENV = new Env();
$ENV->setSession();

# setting up MySQL
$MYSQL = new MySQL();
$MYSQL->openMysqlConnection(); 

# SETTING UP LANGUAGE
$LANG = new Language("DE");

# CREATE/CHECK USER
$USER = new User();

