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


var ajax = {
    
    // properties
    index : 0,
    buffer : null,
    
    getInput: function( id ) {
        if( ! id ) return;
	else return document.getElementById( id ).value;
    },
    
    setBuffer: function( layer ) {
        if( document.getElementById(layer) ) {
            this.buffer = document.getElementById(layer).innerHTML;
        }
    },
    
    getBuffer: function( layer ) {
        if( document.getElementById( layer ) )  {
            document.getElementById( layer ).innerHTML = this.buffer;
        }
    },
    
    // ajaxing with GET method
    get: function( url,layer ) {
        var request = new XMLHttpRequest();
        if( request ) {
            request.open("GET", url, true);
            request.onreadystatechange = function() {
                // loaded
                if( request.readyState == 4 ) {
                    if( layer && document.getElementById( layer ) ) {
                    document.getElementById( layer ).innerHTML = '';
                    document.body.style.cursor="default";
                    document.getElementById( layer ).style.visibility  = 'visible';
                    document.getElementById( layer ).style.height  = 'auto';
                    document.getElementById( layer ).innerHTML = request.responseText; 
                    } 
                }
                // waiting
                if( request.readyState == 1 ) {
                    document.body.style.cursor="wait";
                }
                
            }
        request.send(null);   
        }
    },
    
    // ajaxing with POST method
    post: function( url,layer,param ) {
        var request = new XMLHttpRequest();
        if( request ) {
            request.open("POST", url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.onreadystatechange = function() {
                // loaded
                if( request.readyState == 4 ) {
                    if( layer && document.getElementById( layer ) ) {
                    document.getElementById( layer ).innerHTML = '';
                    document.body.style.cursor="default";
                    document.getElementById( layer ).style.visibility  = 'visible';
                    document.getElementById( layer ).style.height  = 'auto';
                    document.getElementById( layer ).innerHTML = request.responseText; 
                    } 
                }
                // waiting
                if( request.readyState == 1 ) {
                    document.body.style.cursor="wait";
                }
                
            }
        request.send( param );  
        }
    }
    
};




