import php.Web;

class NavigationComponent {
    public static function Index():String {
        return '
        <div class="NavigationContainer">
            <div class="Logo">Krzysiek</div>
            <div class="Grow"></div>
            ${ApplyAccounting()}
            <div class="Element">Nav3</div>
            <div class="Element">Nav4</div>
        </div>
        ';
    }

    private static function ApplyAccounting():String {
        if(AuthLib.CheckAuthAuto("user").isSuccess){
            return '<div class="Element">Welcome ${Web.getCookies()["User"]}</div>
            <div class="Element"><form method="post" action="/api/logout"><button type="submit">Wyloguj się</button></form></div>';
        }
        else {
            return '<div class="Element" hx-target=".page" hx-get="/components/login" hx-swap="innerHTML">Login</div>
            <div class="Element" hx-target=".page" hx-get="/components/register" hx-swap="innerHTML">Rejestracja</div>';
        }
    }
}