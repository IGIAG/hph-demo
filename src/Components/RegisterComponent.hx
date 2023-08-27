class RegisterComponent {
    public static function Index():String{
    


        if(AuthLib.CheckAuthAuto("user").isSuccess){
            return '<div class="loginComponent">
            
            <h1>Jesteś już zalogowany lol</h1>
            
            </div>
            ';
        }


        return '<div class="registerComponent"><h1>Register component</h1>
        <form hx-post="/api/create-user" hx-target="#loginspace" hx-swap="outerHTML">
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

