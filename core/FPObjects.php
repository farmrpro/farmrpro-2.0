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


class FPObjects {
   
    private $handle;
    private $class;
    private $table;
    
    # public construct opens a mysql server connection 
    public function __construct() {
        global $MYSQL;
        # get the handle, save it to object for internal access
        $this->handle = $MYSQL->getMysqlHandle();
        # set the child class name
        $this->class = get_class( $this );
        # set the table's name based on class name
        $this->table = strtolower( $MYSQL->getMysqlPrefix()."_".$this->class );
    }
    
    # get the table name 
    public function isLoaded() { if( isset( $this->id ) ) { return true;} }
    public function getTableName() { return $this->table; }
    public function getValue( $key ) { if( isset( $this->$key ) ) { return $this->$key; } }
    
    # set a value for a key
    public function setValue( $key,$value ) {
        if( empty( $this->id ) ) { return; }
        if( empty( $key ) || ! isset( $this->$key ) ) { return; }
        $this->$key = $value;
        $query = "UPDATE `$this->table` SET $key='$value' WHERE id='$this->id'";
        return $this->handle->query( $query );
    }
    
    # get mysql object by ID
    public function getByID( $id ) {
        if( ! is_int( $id ) || empty( $id ) ) { return; }
        $query = "SELECT * FROM `$this->table` WHERE id='$id'";
        if( $res = $this->handle->query( $query ) ) { 
            return $res->fetch_object( $this->class ); 
        }
        else { return; }
    }
    
    # get mysql object by a key-valaue-pair
    public function getByKey( $key, $value ) {
        if( empty( $key ) ) { return; }
        $query = "SELECT * FROM `$this->table` WHERE $key='$value'";
        if( $res = $this->handle->query( $query ) ) { 
            return $res->fetch_object( $this->class ); 
        }
        else { return; }
    }
    
    # create a new mysql object and returns it
    public function create() {
        $ar = array();
        $res = $this->handle->query("DESCRIBE `$this->table`");
        if( empty( $res->num_rows ) ) { return; }  
        for( $i=0;$i<$res->num_rows;$i++ ) { array_push( $ar,"''"); }
        $query = "INSERT INTO `$this->table` VALUES( ".implode(",",$ar)." )";
        $this->handle->query( $query );
        if( ! $newid = $this->handle->insert_id ) { return; }
        return $this->getByID( $newid );
    }
    
    # delete the current object from database and itself
    public function delete() {
        if( ! $this->isLoaded() ) { return; }
        $query = "DELETE FROM `$this->table` WHERE id='$this->id'";
        if( $this->handle->query( $query ) ) {
            $this->id = null;
            return null;
        }
        return;
    }
    
    # PRIVATE METHODS ==========================================================
    
    private function getEmptyInsertQuery() {
        $ar = $ar2 = array();
        $fcount = $this->getTableFieldsCounter();
        $fields = $this->getTableFields();
        if( $fcount > 0 && is_array( $fields ) ) {
            for($i=0;$i<$fcount;$i++) { array_push($ar,"''"); }
            foreach( $fields as $f ) { array_push( $ar2,"`$f`");} 
            $str = implode(",",$ar);
            $str2 = implode(",",$ar2);
            return "INSERT INTO `$this->table` ( $str2 ) VALUES ( $str )";
        } 
        return;
    }
    
    private function getTableFields() {
        $ar = array();
        if( $res = $this->handle->query("DESCRIBE `$this->table`") ) { 
            while( $erg = $res->fetch_object() ) {  
                $key = key($erg);
                array_push( $ar, $erg->$key );
            }
            return $ar;
        }
        return;
    }
    
}
