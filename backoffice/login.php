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
?>

<?php include "templates/header.php"; ?>
<?php include "templates/menu.php"; ?>

        <div class="main-container" id="main-container">
            
            <div class="background-container" id="background-container">
                
                <div class="top80"></div>
                
                <div class="content-container" id="content-container">
                    
                    <div class="login-container" id="login-container">
                    
                        <h2>Login</h2>
                        
                        <?php if( filter_input(INPUT_GET,"errmsg") == "true" ) : ?>
                        <p class="error"><?php echo $LANG->getMessage(2); ?></p>
                        <?php endif; ?>

                        <form method="post" action="exec.php">
                        <input type="hidden" name="scope" value="UserExec"/>
                        <input type="hidden" name="call" value="userLogin"/>

                        <p><input type="text" class="w100" placeholder="E-Mail" 
                        name="email" tabindex="1"/></p>

                        <p><input type="password" class="w100" placeholder="Passwort"
                        name="pass" tabindex="2" required/></p>
                        
                        <p><?php echo $LANG->getMessage(1); ?></p>

                        <p><button type="submit" class="w100">Login</button></p>
                        </form>
                        
                    </div>
                    
                </div>
                
            </div>

        </div>

<?php include "templates/footer.php"; ?>

