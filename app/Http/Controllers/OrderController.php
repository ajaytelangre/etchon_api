<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ordered_product;
use App\Models\Setting;
use Validator;
use Redirect;
use DB;

class OrderController extends Controller
{
    public function demo(){
        $a = "Hello";
        return $a;
    }
    
     public function order(Request $request)
    {
        $validateData=Validator::make($request->all(),[
            "productid"=>"required",
            "itemprice"=>"required",
            "qty"=>"required",
            "method"=>"required",
            "amount"=>"required",
            "user_id"=>"required",
            "address"=>"required",
        ]);

        if($validateData->fails())
        {
            return response()->json([
                "message" => 'validation fail',
                ]);
        }
        else{
            $setting = DB::table('setting')->get();
            foreach($setting as $s)
            {
                $admin_id=$s->admin_id;
            }
            $order=new Order;
            $order->admin_id=$admin_id;
            $order->method=$request->method;
            $order->amount=$request->amount;
            $order->user=$request->user_id;
            $order->address=$request->address;
            $s=$order->save();
            
            $pro_id=$request->productid;
            $c=count($pro_id);

            for($a=0;$a<$c;$a++)
            {
               $order_pro=new Ordered_product;
               
               $order_pro->product_order=$order->id;
               $order_pro->product=$request->productid[$a] ;//Helper::get_vget_valductid");
               $order_pro->price=$request->itemprice[$a]; //Helper::get_val("itemprice");
               $order_pro->quantity=$request->qty[$a];//Helper::get_val("qty");
               
               $order_pro->revenue=0;
               $order_pro->inventory=1;
               $b=$order_pro->save();
            }

            if($s && $b){
      
                return response()->json([
                    "message" => 'Order Place Succesufully',
                    ]);
            }
            else{
                return response()->json([
                    "message" => 'Order Fail',
                    ]);
            }
        }

    }

}
