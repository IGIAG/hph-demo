import AuthLib.CheckAuthForm;
import php.Web;
import AuthLib;
import LoginComponent;

class IndexPage {
    public static function Index():String{
        return '
        <div id="codepage"><h2>O mnie:</h2><p>Jestem Krzysiek, uczęszczam do liceum informatycznego. Moja fascynacja technologią przerodziła się w pasję tworzenia profesjonalnych stron internetowych.</p></div>
        <div id="codepage"><h2>Pasja i Profesjonalizm:</h2><p>Tworzenie stron to dla mnie nie tylko sposób na zarobek, to przede wszystkim to, co kocham robić. Dzięki umiejętnościom i doświadczeniu dostarczam responsywne strony o doskonałej funkcjonalności.</p></div>
        <div id="codepage"><h2>Najnowsze Trendy:</h2><p>Nieustannie się rozwijam, aby być na bieżąco z trendami w projektowaniu i programowaniu webowym. Moje projekty są zawsze dopasowane do indywidualnych potrzeb klientów.</p></div>
        <div id="codepage"><h2>Gotowy na Współpracę:</h2><p>Potrzebujesz nowej strony lub poprawy istniejącej? Jestem tu po to, aby pomóc. Skontaktuj się ze mną, a razem stworzymy funkcjonalną i atrakcyjną stronę internetową.</p></div>
        <div id="codepage"><h2>Dziękuję za Odwiedziny:</h2><p>Dziękuję, że znalazłeś/aś chwilę, aby odwiedzić moją stronę. Zapraszam do odkrywania świat nowoczesnych stron razem ze mną!</p></div>
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