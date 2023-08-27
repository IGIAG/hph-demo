import AuthLib.CheckAuthForm;
import php.Web;
import AuthLib;
import LoginComponent;

class Portfolio {
    public static function Index():String{
        return '
        <div id="codepage">
        <h2>Moje portfolio</h2>

        <ul>
        <li>MindPro - Strona główna gabinetu psychologicznego.</li>
        <li>AiLuvU - Strona główna aplikacji randkowej AI ORAZ cała aplikacja AiLuvU</li>
        <li>Mój Github</li>
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