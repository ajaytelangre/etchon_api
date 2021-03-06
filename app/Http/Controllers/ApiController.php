<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cases;
use App\Models\Service_request;
use App\Models\Employee_feedback;
use App\Models\Order;
use App\Models\Ordered_product;
use App\Models\Setting;
use Validator;
use Redirect;
use DB;

class ApiController extends Controller
{

    public function add_case(Request $request)
    {
        $case=new Cases;
        $case->case_id=$request->case_id;
        $case->user_id=$request->user_id;
        $case->feedback=$request->feedback;
        $case->engineers_name=$request->engineers_name;
        $case->service_charges=$request->service_charges;
        $case->call_status=$request->call_status;
        $case->date_time=$request->date_time;
        $case->save();
        
        DB::table('employee_feedback')
            ->where('case_id',$request->case_id)
            ->update(array('call_status' => $request->call_status));

      
        return response()->json([
            "message"=>"Data saved"
        ]);
  
    }

    public function show_case(Request $request){
       
          $cases_get = DB::table('cases')
                                ->where('case_id',$request->case_id)
                                ->get();
        return response()->json($cases_get);
                             
    }
    
    public function emp_show_case(Request $request){
       
          $cases_get = DB::table('cases')
                                ->where('case_id',$request->case_id)
                                ->get();
        return response()->json($cases_get);
    }
    
    public function user_show_case(Request $request){
        
          $data = DB::table('cases')
                                ->where('user_id',$request->user_id)
                                ->where('case_id',$request->case_id)
                                ->get();
                                
        return response()->json($data);
    }
    
    // ------------------------------------------------------------------------------
    //  ORDER API
     
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
            "product_weight"=>"required",
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
               $order_pro->product_weight=$request->product_weight[$a];//Helper::get_val("weight");
               
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
