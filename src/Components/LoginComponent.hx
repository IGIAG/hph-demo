class LoginComponent {
    public static function Index():String{
    


        if(AuthLib.CheckAuthAuto("user").isSuccess){
            return '<div class="loginComponent">
            
            <h1>You are already logged in!</h1>
            
            </div>
            ';
        }


        return '<div class="loginComponent"><h1>Login component</h1>
        <form action="/api/login-r" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required>
        <br>
        <input type="submit" value="Submit">
        </form></div>
        ';
    }
}

