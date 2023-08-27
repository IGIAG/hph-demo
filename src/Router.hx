import haxe.Json;
import sys.FileSystem;
import php.Web;
import sys.io.File;


class Router {
    private var routes: Map<String, RouteDefinition> = [];

    public function addRoute(route:String,work:Void -> Dynamic,permission:String){
        routes.set(route,new RouteDefinition(work,permission));
    }
    public function getRoute(route:String,permissions:Array<String>):Void -> Dynamic{
        var routeDefinition:RouteDefinition = routes.get(route);

        if(permissions.contains(routeDefinition.Permission)){
            return routes.get(route).Function;
        }
        return function():String {
            return "Forbidden!";
        };
        
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
            addRoute('/${file}',function():Dynamic {
                try {
                    var fileContent:String = File.getContent('./wwwroot/$file');
                    return fileContent;
                } catch (e:Dynamic) {
                    trace("Error reading file: " + e);
                    return null;
                }
            },"default");
        }
    }

    public function new(){}

}

class RouteDefinition {
    public var Function:Void -> Dynamic;

    public var Permission:String;

    public function new(Function:Void -> Dynamic,Permission:String) {
        this.Function = Function;
        this.Permission = Permission;
    }
}