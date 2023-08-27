import php.Web;

class NavigationComponent {
    public static function Index():String {
        return '
        <div class="NavigationContainer">
            <a class="Logo" href="/" >Krzysiek</a>
            <div class="Grow"></div>
            ${ApplyAccounting()}
            <a class="Element" href="/about">O tej stronie</a>
            <a class="Element" href="/portfolio">Portfolio</a>
        </div>
        ';
    }

    private static function ApplyAccounting():String {
        if(AuthLib.CheckAuthAuto("user").isSuccess){
            return '<div class="Element">Witaj ${Web.getCookies()["User"]}</div>
            <div class="Element"><form method="post" action="/api/logout"><button type="submit">Wyloguj się</button></form></div>';
        }
        else {
            return '<div class="Element" hx-target=".page" hx-get="/components/login" hx-swap="innerHTML">Login</div>
            <div class="Element" hx-target=".page" hx-get="/components/register" hx-swap="innerHTML">Rejestracja</div>';
        }
    }
}