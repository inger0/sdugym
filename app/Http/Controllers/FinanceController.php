<?php
/**
 * Created by HBUILDER.
 * User: hefan
 * Date: 17-04-27
 * Time: 15:57
 */
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Finance;
use App\User;

class FinanceController extends Controller{


   public function addFinance(Request $request){
     	
     	if(!($this->check_token($request->api_token)&&$this->user_permission==2))
            return $this->stdResponse('-3');
             
        $res=$this->filter($request,[
        'title'=>'required|max:16',
        'content'=>'required|max:255',
        'money'=>'required|integer',
        'billing_time'=>'required|date_format:Y-m-d',
        'remark'=>'required|string|max:255',
        ]);     
        if(!$res) return $this->stdResponse('-1');
        
        $obj=Finance::create($request->all());
        $obj->campus=$this->user_campus;
    	
    	$admin=User::where('api_token',$request->api_token)->first();
        
     	$obj->u_id=$admin->schoolnum;     
     	$obj->save();
     	return $this->stdResponse("1");
     	 
             
   }
   
    public function editFinance(Request $request,$id){
     
     	if(!($this->check_token($request->api_token)&&$this->user_permission==2))
            return $this->stdResponse('-3');
             
        $res=$this->filter($request,[
        'title'=>'required|max:16',
        'content'=>'required|max:255',
        'money'=>'required|integer',
        'billing_time'=>'required|date_format:Y-m-d',
        'remark'=>'required|string|max:255',
        ]);     
        if(!$res) return $this->stdResponse('-1');   
         
         $obj=Finance::find($id);
         $obj->title=$request->title;
         $obj->content=$request->content;
         $obj->money=$request->money;
         $obj->billing_time=$request->billing_time;
         $obj->remark=$request->remark;
         $obj->save();
         
         return $this->stdResponse("1");
   }
   
   public function deFinance(Request $request,$id){
       	if(!($this->check_token($request->api_token)&&$this->user_permission==2))
            return $this->stdResponse('-3');
        $obj=Finance::find($id);
        $obj->delete();
        return $this->stdResponse("1");
   }
   
   
}