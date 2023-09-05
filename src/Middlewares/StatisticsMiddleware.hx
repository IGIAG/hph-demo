import IMiddleware;
import redis.Redis;

class StatisticsMiddleware implements IMiddleware{


	public function Output(input:String, params:Array<String>):String {

        var db = new Redis("localhost");  

        db.incr("views");

		return input;
	}
    public function new(){}
}