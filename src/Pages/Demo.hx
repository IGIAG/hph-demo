import AuthLib.CheckAuthForm;
import php.Web;
import AuthLib;
import LoginComponent;

class Demo {
    public static function Index():String{
        return '
        <div id="codepage">
        <h2>Demo:</h2>
        <h3>Dynamic content (Pages):</h3>
        <ul>
        <li>Server time: ${Date.now().getHours()}:${Date.now().getMinutes()}:${Date.now().getSeconds()}</li>
        <li>Your IP:${Web.getClientIP()}</li>
        </ul>
        <h3>Middleware example (Default variables middleware)</h3>
        <ul>
        <li>Time variable: @&time</li>
        </ul>

        </div>
        ';
    }
    /*private static function LoginField():String {
        if(AuthLib.CheckAuth(new CheckAuthForm(Web.getCookies()["User"],Web.getCookies()["Auth"]),"user").isSuccess){
            return '
            <li>
            <p>You are logged in as ${Web.getCookies()["User"]}!</p>
            <a href="/api/logout">Logout!</a>
            </li>
            '; 
        }


        return '
        <li>
        <a href="/login">Login!</a>
        </li>
        ';
    }*/
}