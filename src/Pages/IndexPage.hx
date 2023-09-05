import redis.Redis;
import AuthLib.CheckAuthForm;
import php.Web;
import AuthLib;
import LoginComponent;

class IndexPage {
    public static function Index():String{
        return '
        <div id="gridFullPage">
            <div id="introGridElement">
                <h2>Hi!</h2>
                <p>Something about the framework.</p>
                </div>
            <div id="statusGridElement">
                <h2>Statistics (not working yet)</h2>
                <p>Wyświetlenia: ${GetViews()}</p>
                <p>Konta: 38</p>
                <p>Dni online: 40</p>
            </div>
            <div id="pidGridElement">
                <h2>Features:</h2>
                <p>Language: HAXE</p>
                <p>Features:</p>
                <ul>
                <li>Feature</li>
                <li>Feature</li>
                <li>Feature</li>
                <li>Feature</li>
                <li>Feature</li>
                <li>Feature</li>
                </ul>
            </div>
            
        </div>
        ';
    }
    private static function GetViews(){
        var db = new Redis("localhost");

        return db.get("views");
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