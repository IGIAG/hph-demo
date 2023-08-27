import Router;
import php.Lib;
import php.Web;
import IndexPage;


class Main {
  static function main() {
    var router:Router = new Router();


    //Adding the static files
    router.mapStaticFiles();

    router.addRoute("/dr/hi",function():String{
      return "Hi!";
    },"user",true);

    router.addRoute("/api/create-user",AuthController.CreateUser,"default",true);

    router.addRoute("/api/login",AuthController.CreateToken,"default",true);

    router.addRoute("/api/login-r",AuthController.CreateTokenRedirect,"default",true);
    

    //Adding the ssr pages
    router.addRoute("/",IndexPage.Index,"default",true);

    router.addRoute("/api/logout",AuthController.RemoveAuth,"default",true);

    router.addRoute("/api/routes",router.getRouteList,"default",true);

    //Adding the dynamicly loadable components

    router.addRoute("/components/login",LoginComponent.Index,"default",false);

    router.addRoute("/components/register",RegisterComponent.Index,"default",false);



    

    var route:RouteDefinition = router.getRoute(Web.getURI(),["default"]);
    if(route.ApplyHtml){
      Lib.println(MainTemplate.GenerateReturnHTML(route.Function()));
    }
    else {
      Lib.println(route.Function());
    }

  }
}