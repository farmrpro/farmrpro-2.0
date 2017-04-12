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

class Language {
    
    private $selectedLanguage;
    
    # sets the language pack
    public function __construct( $lang ) {
        global $ENV;
        $this->selectedLanguage = $lang;
        # load constant lang pack
        if( file_exists($ENV->getPath()."core/languages/langpack_$this->selectedLanguage.php") ) {
            include_once $ENV->getPath()."core/languages/langpack_$this->selectedLanguage.php";
        }
    }
}
