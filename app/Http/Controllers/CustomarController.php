<?php

namespace App\Http\Controllers;

use App\Models\Customar;
use Illuminate\Http\Request;

class CustomarController extends Controller
{
   public function index(){

    return view('homeajax');
   }
//    all data show 
   public function customer_all()
   {

 $data=Customar::orderby('id','DESC')->get();
 return response()->json($data);

   }

   public function store (Request $request)
   {
      $request->validate([
         'frist_name' =>'required',
         'last_name' =>'required',
         'email' =>'required',

      ]);

      $data =Customar::insert([
     'frist_name' =>$request->frist_name,
     'last_name' =>$request->last_name,
     'email' =>$request->email,
      ]);
      return response()->json($data);

   }
   public function edit($id){
   $data=Customar::findorfail($id);
   return response()->json($data);

   }
   public function update(Request $request,$id){
   
      $request->validate([
       'frist_name'=>'required',

      ]);
      $data=Customar::findorfail($id)->update([
       'frist_name' =>$request->frist_name,
     'last_name' =>$request->last_name,
     'email' =>$request->email,

      ]);
      return response()->json($data);
   
      }
      public function delete($id)
      {
         $data=Customar::findorfail($id)->delete();
         return response()->json($data);
      }
}
