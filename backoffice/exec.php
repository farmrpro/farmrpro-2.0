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

# basic stuff to run all other things
if( file_exists("../core/init.php") ) { include "../core/init.php"; }
elseif( file_exists("./core/init.php") ) { include "./core/init.php"; }
else die("Corrupt Installation!");

# now the OOP becomes the mastermind
$ENV = new Env();
$ENV->setSession();
$MYSQL = new MySQL();
$MYSQL->openMysqlConnection();
$USER = new User();

# get the environment
$str = $ENV->getQueryString();
$class = $ENV->getScope();
$call = $ENV->getCall();

# call member function in requested scope
(new $class())->$call( $str );

