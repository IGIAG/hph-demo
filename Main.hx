import Router;
import php.Lib;
import php.Web;
import IndexPage;
import VariablesMiddleware;

class Main {
  static function main() {

    var router:Router = new Router();

    var variablesMiddleware:VariablesMiddleware = new VariablesMiddleware();

    var structureMiddleware:StructureMiddleware = new StructureMiddleware();

    var statisticsMiddleware:StatisticsMiddleware = new StatisticsMiddleware();

    //Mapping variables

    variablesMiddleware.AddVariable("time","The string @&time will always be replaced with this explaining string.");

    
    //Adding the static files
    router.mapStaticFiles();

    //Adding the API routes

    router.addRoute("/dr/hi",function():String{
      return "Hi!";
    },"user",[structureMiddleware]);

    router.addRoute("/api/create-user",AuthController.CreateUser,"default",[]);

    router.addRoute("/api/login",AuthController.CreateToken,"default",[]);

    router.addRoute("/api/login-r",AuthController.CreateTokenRedirect,"default",[]);
    
    router.addRoute("/api/logout",AuthController.RemoveAuth,"default",[]);

    router.addRoute("/api/routes",router.getRouteList,"default",[]);
    

    //Adding the ssr pages
    router.addRoute("/",IndexPage.Index,"default",[structureMiddleware,statisticsMiddleware]);
    router.addRoute("/about",About.Index,"default",[structureMiddleware,variablesMiddleware]);
    router.addRoute("/demo",Demo.Index,"default",[structureMiddleware,variablesMiddleware]);

    //Adding the dynamicly loadable components

    router.addRoute("/components/login",LoginComponent.Index,"default",[]);

    router.addRoute("/components/register",RegisterComponent.Index,"default",[]);



    

    var route:RouteDefinition = router.getRoute(Web.getURI(),["default"]);
    
    var routeOutput:String = route.Function();

    
    if(route.MiddleWares == null){
      Lib.println(routeOutput);
      return;
    }

    for(mw in route.MiddleWares){
      routeOutput = mw.Output(routeOutput,[]);
    }

    



    Lib.println(routeOutput);
    

  }
}