import php.Web;

class LoginPage {
    public static function Index():String{
        return '<h1>Login demo</h1>
        <form action="/api/login" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required>
        <br>
        <input type="submit" value="Submit">
        </form>
        ';
    }
    
}