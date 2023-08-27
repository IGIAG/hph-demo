import haxe.Json;
import sys.FileSystem;
import php.Web;
import sys.io.File;



class Router {
    private var routes: Map<String, RouteDefinition> = [];
    public function addRoute(route:String,work:Void -> Dynamic,permission:String,applyHtml:Bool){
        routes.set(route,new RouteDefinition(work,permission,applyHtml));
    }
    public function getRoute(route:String,permissions:Array<String>):RouteDefinition{
        var routeDefinition:RouteDefinition = routes.get(route);

        if(permissions.contains(routeDefinition.Permission)){
            return routes.get(route);
        }
        return new RouteDefinition(function():String {
            return "Forbidden!";
        },"default",true) ;
        
    }
    public function getRouteList():String{
        var routesIterator:Iterator<String> = routes.keys();
        var outputString:String = "<h2>Here are the registered paths:</h2>";
        while(routesIterator.hasNext()){
            outputString += '<p>${routesIterator.next()}</p>';
        }
        return outputString;


        
    }

    public function mapStaticFiles():Void{
        var files:Array<String> = FileSystem.readDirectory("./wwwroot");
        var i:Int = 0;
        
        for(file in files){
            var applyHtml = (getContentType(file) == "text/html");

            addRoute('/${file}',function():Dynamic {
                try {
                    var fileContent:String = File.getContent('./wwwroot/$file');
                    
                    Web.setHeader('Content-Type',getContentType(file));
                    return fileContent;
                } catch (e:Dynamic) {
                    trace("Error reading file: " + e);
                    return null;
                }
            },"default",applyHtml);
        }
    }

    public function new(){}

    public static function getContentType(fileName:String):String {
        var extension = fileName.substring(fileName.lastIndexOf(".") + 1);
        
        switch (extension.toLowerCase()) {
            case "html": return "text/html";
            case "css": return "text/css";
            case "js": return "application/javascript";
            case "json": return "application/json";
            case "png": return "image/png";
            case "jpg": return "image/jpeg";
            case "jpeg": return "image/jpeg";
            case "gif": return "image/gif";
            case "pdf": return "application/pdf";
            case "txt": return "text/plain";
            case "less": return "text/less";
            default: return "application/octet-stream"; // Default content type
        }
    }

}

class RouteDefinition {
    public var Function:Void -> Dynamic;

    public var Permission:String;

    public var ApplyHtml:Bool;

    public function new(Function:Void -> Dynamic,Permission:String,ApplyHtml:Bool) {
        this.Function = Function;
        this.Permission = Permission;
        this.ApplyHtml = ApplyHtml;
    }
}