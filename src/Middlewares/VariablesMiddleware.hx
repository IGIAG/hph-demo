class VariablesMiddleware implements IMiddleware {
    private static var Variables:Map<String,String> = []; //Name:Value

    public static function AddVariable(name:String,value:String):Void {
        Variables.set(name,value);
    }


    public function Output(input:String,params:Array<String>):String {
        input = replacePlaceholders(input,Variables);

        return input;
    }

    private static function replacePlaceholders(input: String, values: Map<String, String>): String {
        for (key in values.keys()) {
            
            var placeholder = "@&" + key;
            var replacement = values.get(key);
            input = input.split(placeholder).join(replacement);
            
            
        }
        return input;
    }
    public function new() {
        
    }
}