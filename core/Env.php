<?php

/*
 * Copyright (C) 2016 Sebastian Schwaner
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

class Env {
    
    private  $appName = "Farmr Pro 2.0";
    private  $appVersion = "2.0.1";
    private  $localHost = "127.0.0.1";
    private  $hostName = "";
    private  $session;
    
    public function getAppName() { return $this->appName; }
    public function getAppVersion() { return $this->appVersion; }
    public function getSession() { return $this->session; }
    
    public function getPath() {
        if( file_exists("./core/Env.php") ) { return "./"; }
        elseif( file_exists("../core/Env.php") ) { return "../"; }
        else return;
    }
    
    public function getURL() { 
        return "http://".$this->localHost."/".$this->appName."/";
    }
    
    public function getBackendJavaPath() {
        return self::getURL()."backend/content/js/"; 
    }
    
    public function getJavaPath() {
        return self::getURL()."content/js/";
    }
    
    public function getBackendCSSPath() {
        return self::getURL()."backend/content/css/";
    }
    
    public function getCSSPath() {
        return self::getURL()."content/css/";
    }
    
    public function getQueryString() {
        return filter_input( INPUT_SERVER,"QUERY_STRING");
    }
    
    public function getScope() {
        if( $get = filter_input( INPUT_GET,"scope") ) return $get;
        elseif( $post = filter_input( INPUT_POST,"scope") ) return $post;
        else return;
    }
    
    public function getCall() {
        if( $get = filter_input(INPUT_GET,"call") ) return $get;
        elseif( $post = filter_input(INPUT_POST,"call") ) return $post;
        else return;
    }
    
    # Setter Functions =========================================================
    public function setSession() { $this->session = session_start(); }
    
}
