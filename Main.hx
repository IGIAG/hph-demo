import Router;
import php.Lib;
import php.Web;
import IndexPage;
import LoginPage;

class Main {
  static function main() {
    var router:Router = new Router();


    //Adding the static files
    router.mapStaticFiles();

    router.addRoute("/dr/hi",function():String{
      return "Hi!";
    },"user");

    router.addRoute("/api/create-user",AuthController.CreateUser,"default");

    router.addRoute("/api/login",AuthController.CreateToken,"default");
    

    //Adding the ssr pages
    router.addRoute("/",IndexPage.Index,"default");
    router.addRoute("/login",LoginPage.Index,"default");

    router.addRoute("/api/logout",AuthController.RemoveAuth,"default");

    router.addRoute("/api/routes",router.getRouteList,"default");

    var head:String = '<script src="https://unpkg.com/htmx.org@1.9.5"></script>';


    Lib.println('<html><head>$head</head><body>${router.getRoute(Web.getURI(),["default"])()}</body></html>');

  }
}