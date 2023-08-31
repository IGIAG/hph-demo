import AuthLib.CheckAuthForm;
import php.Web;
import AuthLib;
import LoginComponent;

class IndexPage {
    public static function Index():String{
        return '
        <div id="gridFullPage">
            <div id="introGridElement">
                <h2>Cześć!</h2>
                <p>Tu jakieś intro. Bla bla blaBla bla blaBla bla blaBla bla blaBla bla blaBla bla blaBla<br/> bla blaBla bla blaBla bla blaBla bla blaBla bla bla</p>
                <p>Tu coś o wykształceniu. Bla bla blaBla bla blaBla bla blaBla bla blaBla bla blaBla bla blaBla<br/> bla blaBla bla blaBla bla blaBla bla blaBla bla bla</p>
                <p>To poprzedznie projekty. Bla bla blaBla bla blaBla bla blaBla bla blaBla bla blaBla bla blaBla<br/> bla blaBla bla blaBla bla blaBla bla blaBla bla bla</p>
                </div>
            <div id="statusGridElement">
                <h2>Statystyki strony</h2>
                <p>Wyświetlenia: 2137</p>
                <p>Konta: 38</p>
                <p>Dni online: 40</p>
            </div>
            <div id="pidGridElement">
                <h2>O mnie:</h2>
                <p>Najlepszy w języku: C#</p>
                <p>Inne języki:</p>
                <ul>
                <li>Java</li>
                <li>Javascript</li>
                <li>Typescript</li>
                <li>Python</li>
                <li>HTML/CSS</li>
                <li>Haxe</li>
                </ul>
            </div>
            
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