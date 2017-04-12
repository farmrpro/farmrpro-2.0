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

?>

        <div class="header-container" id="header-container">
            <span class="left no-menu">
                <strong><?php echo $ENV->getAppName(); ?></strong>
            </span>
            
            <?php if( $USER->isLoggedIn() ) : ?>
            
            <span class="menu-item right">
                <a href="exec.php?scope=UserExec&call=userlogout">Ausloggen</a>
            </span>

            <span class="menu-item right">
                <a><?php echo $USER->getValue("realname"); ?></a>
            </span>
            
            <?php endif; ?>
        </div>