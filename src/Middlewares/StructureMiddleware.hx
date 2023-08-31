import IMiddleware;

class StructureMiddleware implements IMiddleware{
    public function Output(input:String,params:Array<String>):String {
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
            $input
            <div class="overlay"></div>
            </div>
        </body>
        </html>';
        
    }
    public function new(){}

	
}