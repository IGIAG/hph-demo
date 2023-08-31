import AuthLib.CreateTokenForm;
import AuthLib.CreateUserForm;
import AuthLib.GenericResponse;
import php.Syntax;
import php.Web;
import redis.Redis;
import HttpUtils;
import uuid.Uuid;

class AuthController {
    private static var ManagementSecret:String = "Keep this string safe! It allows access to modify AUTHMAN users directly!!!";



    public static function CreateUser():String {
        if(Web.getMethod() != "POST"){Syntax.code("http_response_code(400)");return "<h1>Bad request! (Method)</h1>";}
        if(!HttpUtils.VerifyFields(["username","password"])){Syntax.code("http_response_code(400)");return "<h1>Bad request! (Parameters! expected:  username, password)</h1>";}
        
        

        var form: Map<String,String> = Web.getMultipart(999);

        var userCreationResponse:GenericResponse = AuthLib.CreateUser(new CreateUserForm(form["username"],form["password"],["user"]));

        if(userCreationResponse.isSuccess){
            return "<h1>User created</h1>";
        }

        return '<h1>Failure! Reason: ${userCreationResponse.response}</h1>'; //This might be a vulnerability. Look into it later
        
    }

    public static function CreateToken():String {
        if(Web.getMethod() != "POST"){Syntax.code("http_response_code(400)");return "Bad request! (Method)";}
        if(!HttpUtils.VerifyFields(["username","password"])){Syntax.code("http_response_code(400)");return "Bad request! (Parameters! expected:  username, password)";}

        

        var form: Map<String,String> = Web.getMultipart(999);

        var response:GenericResponse = AuthLib.CreateToken(new CreateTokenForm(form["username"],form["password"]));

        if(!response.isSuccess){
            return '<h1>Failure! Reason: ${response.response}</h1>'; //This might be a vulnerability. Look into it later
        }

        Web.setCookie("User",form["username"]);

        Web.setCookie("Auth",response.response);

        return "<h1>Logged in!</h1>";
    }
    public static function CreateTokenRedirect():String {
        if(Web.getMethod() != "POST"){Syntax.code("http_response_code(400)");return "Bad request! (Method)";}
        if(!HttpUtils.VerifyFields(["username","password"])){Syntax.code("http_response_code(400)");return "Bad request! (Parameters! expected:  username, password)";}

        

        var form: Map<String,String> = Web.getMultipart(999);

        var response:GenericResponse = AuthLib.CreateToken(new CreateTokenForm(form["username"],form["password"]));

        if(!response.isSuccess){
            return '<h1>Failure! Reason: ${response.response}</h1>'; //This might be a vulnerability. Look into it later
        }

        Web.setCookie("User",form["username"]);

        Web.setCookie("Auth",response.response);

        Web.redirect("/");

        return "<h1>Logged in!</h1>";
    }
    

    

    public static function RemoveAuth() {
        var now = Date.now();

        var oneHourAgo = Date.fromTime(now.getTime() - 3600 * 1000);

        var timestamp = Math.floor(oneHourAgo.getTime() / 1000);

        Web.setCookie("User", "", oneHourAgo);

        Web.setCookie("Auth", "", oneHourAgo);

        Web.redirect("/");

        return true;
    }

    
}