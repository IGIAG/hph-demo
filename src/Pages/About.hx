import AuthLib.CheckAuthForm;
import php.Web;
import AuthLib;
import LoginComponent;

class About {
    public static function Index():String{
        return '
        <div id="codepage">
        <h2>Trochę o tej stronie</h2>

        Ta strona nie została napisana w PHP. A jednak, działa na serwerze obsługującym tylko PHP. Jak to osiągnąłem?</br>

        Dzięki językowi <a href="https://haxe.org">HAXE</a> mogę pisać szybki i bezpieczny kod który dalej jest kompilowany(zamieniany) do PHP.

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