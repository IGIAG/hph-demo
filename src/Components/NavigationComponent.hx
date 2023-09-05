import php.Web;

class NavigationComponent {
    public static function Index():String {
        return '
        <div class="NavigationContainer">
            <a class="Logo" href="/" >HPH</a>
            <div class="Grow"></div>
            ${ApplyAccounting()}
            <a class="Element" href="/about">About</a>
            <a class="Element" href="/demo">Demo</a>
        </div>
        ';
    }

    private static function ApplyAccounting():String {
        if(AuthLib.CheckAuthAuto("user").isSuccess){
            return '<div class="Element">Hi ${Web.getCookies()["User"]}</div>
            <div class="Element"><form method="post" action="/api/logout"><button type="submit">Log out</button></form></div>';
        }
        else {
            return '<div class="Element" hx-target=".page" hx-get="/components/login" hx-swap="innerHTML">Login</div>
            <div class="Element" hx-target=".page" hx-get="/components/register" hx-swap="innerHTML">Register</div>';
        }
    }
}