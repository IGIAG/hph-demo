import NavigationComponent;

class MainTemplate {
    public static function GenerateReturnHTML(content:String):String {
        var head:String = '
        <script src="https://unpkg.com/htmx.org@1.9.5"></script>
        <link href="https://fonts.cdnfonts.com/css/intelone-display" rel="stylesheet">
        <link rel="stylesheet/less" type="text/css" href="style.less" />
        <script src="https://cdn.jsdelivr.net/npm/less" ></script>
        ';


        return '<html>
        <head>
            $head
        </head>
        <body>
            ${NavigationComponent.Index()}
            <div class="page">
            $content
            </div>
        </body>
        </html>';
    }
}