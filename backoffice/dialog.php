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
                    
                        <script type="text/javascript">
                            action.showDialog('<?php echo filter_input( INPUT_GET,"type"); ?>');
                        </script>
                        
                    </div>
                    
                </div>
                
            </div>

        </div>

<?php include "templates/footer.php"; ?>

