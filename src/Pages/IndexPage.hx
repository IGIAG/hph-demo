import AuthLib.CheckAuthForm;
import php.Web;
import AuthLib;

class IndexPage {
    public static function Index():String{
        return '<h1>This is a prerendered composed index site!</h1>
        <h2>Why?</h2>
        <h3>Because fuck you thats why</h3>
        <p>Some demos:</p>
        <ul>
        <li>
        Your IP: ${Web.getClientIP()}
        </li>
        <li>
        Current time: ${Sys.time()}
        </li>
        ${LoginField()}
        <li>
        <p hx-get="/api/routes" hx-swap="outerHTML">Click me to see the available routes</p>
        </li>

        </ul>

        ';
    }
    private static function LoginField():String {
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
    }
}