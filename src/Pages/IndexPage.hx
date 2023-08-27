import AuthLib.CheckAuthForm;
import php.Web;
import AuthLib;
import LoginComponent;

class IndexPage {
    public static function Index():String{
        return '';
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