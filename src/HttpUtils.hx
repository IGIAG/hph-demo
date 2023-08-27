import php.Web;

class HttpUtils {
    public static function VerifyFields(fieldNames:Array<String>){
        for (field in fieldNames) {
            if(!Web.getMultipart(999).exists(field)){
                return false;
            }
        }
        return true;
    }
}