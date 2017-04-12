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

class Dialog {
    
    # show the requested dialog 
    public function showDialog() {
        $type = filter_input( INPUT_POST,"type");
        ?>
        <?php if( $type == "resetPasswordDone") : ?>
            <h2><?php echo __resetPassDoneTopic__; ?></h2>
            <p><?php echo __resetPassDoneContent__; ?></p>
        
        <?php else : ?>
            <h2><?php echo __emptyTopic__; ?></h2>
            <p><?php echo __emptyContent__; ?></p>
            
        <?php endif; ?>
            <button onclick="location.replace('index.php');">
                <?php echo __backToIndex__; ?>
            </button>
        <?php
    }
    
}
