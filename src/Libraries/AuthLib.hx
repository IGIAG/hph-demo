import php.Syntax;
import php.Web;
import redis.Redis;
import HttpUtils;
import uuid.Uuid;


class CreateUserForm { 
    public var username:String;
    public var password:String;
    public var permissions:Array<String>;

    public function new(username:String,password:String,permissions:Array<String>){
        this.username = username;
        this.password = password;
        this.permissions = permissions;
    }
}
class GenericResponse { 
    public var response:String;
    public var isSuccess:Bool;

    public function new(response:String,isSuccess:Bool){
        this.response = response;
        this.isSuccess = isSuccess;
    }
}

class CreateTokenForm { 
    public var username:String;
    public var password:String;

    public function new(username:String,password:String){
        this.username = username;
        this.password = password;
    }
}

class CheckAuthForm { 
    public var username:String;
    public var token:String;

    public function new(username:String,token:String){
        this.username = username;
        this.token = token;
    }
}

class AuthLib {
    public static function CreateUser(userCreationForm:CreateUserForm):GenericResponse {
        
        var db = new Redis("localhost");  

        if(db.exists('user.${userCreationForm.username}.password')){
            return new GenericResponse("User already exists!",false);
        }

        db.set('user.${userCreationForm.username}.password', userCreationForm.password);

        db.set('user.${userCreationForm.username}.permissions', "default,user");

        return new GenericResponse("User created!",true);
    }
    public static function CreateToken(tokenCreationForm:CreateTokenForm):GenericResponse {

        var db = new Redis("localhost");  


        if(!(db.get('user.${tokenCreationForm.username}.password') == tokenCreationForm.password)){
            return new GenericResponse("Bad username or password!",false);
        }

        var token:String = Uuid.nanoId();
        
        db.set('user.${tokenCreationForm.username}.token',token);

        return new GenericResponse(token,true);
    }
    public static function CheckAuth(checkAuthForm:CheckAuthForm,permission:String):GenericResponse{

        if(permission == "default"){
            return new GenericResponse("Authorized!",true);
        }

        var db = new Redis("localhost");  

        if(!(db.get('user.${checkAuthForm.username}.token') == checkAuthForm.token && checkAuthForm.token != null)){
            return new GenericResponse("Unauthorized!",false);
        }

        if(permission == "user"){
            return new GenericResponse("Authorized!",true);
        }

        var permissions:Array<String> = db.get('user.${checkAuthForm.username}.permissions').split(',');

        var containsString:Bool = false;

        for (px in permissions) {
            if (px == permission) {
                containsString = true;
                break;
            }
        }

        if(containsString){
            return new GenericResponse("Authorized!",true);
        }
        return new GenericResponse("Unauthorized!",false);
        
    }
    public static function CheckAuthAuto(permission:String):GenericResponse{
        var checkAuthForm = new CheckAuthForm(Web.getCookies()["User"],Web.getCookies()["Auth"]);

        if(permission == "default"){
            return new GenericResponse("Authorized!",true);
        }

        var db = new Redis("localhost");  

        if(!(db.get('user.${checkAuthForm.username}.token') == checkAuthForm.token && checkAuthForm.token != null)){
            return new GenericResponse("Unauthorized!",false);
        }
        return new GenericResponse("Authorized!",true);
    }
}