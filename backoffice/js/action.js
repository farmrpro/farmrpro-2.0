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

var action = {
    
    // Properties
    loginContainer: "login-container",
    url: "exec.php",
   
    // Methods
    showDialog: function( type ) {
        var param = 'scope=Dialog&call=showDialog&type='+type;
        ajax.post( this.url,this.loginContainer,param);
    },
    
    setResetPass: function() {
        var param = 'scope=UserExec&call=requestPasswordReset&email='+ajax.getInput('email');
        ajax.post( this.url,this.loginContainer,param );
    },
    
    showResetPass: function() {
        var param = 'scope=UserExec&call=showResetPass';
        ajax.post( this.url,this.loginContainer,param );
    },
    
};


