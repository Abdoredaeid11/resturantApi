<?php

namespace App\Http\Controllers;

use App\Models\Omelette;
use App\Models\Breakfast;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;



class BreakfastController extends Controller
{
    use GeneralTrait;
    
    //
    function list(){
        $Breakfasts= Breakfast::all();

        

        
        $data=[];
        foreach($Breakfasts as $Breakfast){
            $data[]=[
           'id' => $Breakfast -> id,
           'name_en' => $Breakfast -> name_en,
           'descrption_en' => $Breakfast -> descrption_en,
            'name_ar' => $Breakfast -> name_ar,
            'descrption_ar' => $Breakfast -> descrption_ar,
           'image' => url('/images/'.$Breakfast -> image),
           'time' => $Breakfast -> time,
           'category'=>$Breakfast->category,
           'topRated'=>$Breakfast->topRate,
           'price'=>$Breakfast->price,

        
        
        ];
        }
        return response()->json(['breakfast'=>$data]);


        
          return Response()->json(['omelette' => $omelette,
                                    'croissant' => $croissant,
                                    'pancake' => $pancake,
                                    'general' => $general,
                                
                                
                                                    ]);

    }
    function list_en(){
        $Breakfasts= Breakfast::all();
        $data=[];
        foreach($Breakfasts as $Breakfast){
            $data[]=[
           'id' => $Breakfast -> id,
           'name_en' => $Breakfast ->name_en,
           'descrption_en' => $Breakfast ->descrption_en,
           'image' => url('/images/'.$Breakfast -> image),
           'time' => $Breakfast -> time,
           'category'=>$Breakfast->category,
           'topRated' =>$Breakfast->topRate,
           'cost'=>$Breakfast->cost,

        
        
        ];
        }
        return response()->json(['breakfast'=>$data]);
    
    
    
    
        }
        
        function list_ar(){
            $Breakfasts= Breakfast::all();
            $data=[];
            foreach($Breakfasts as $Breakfast){
                $data[]=[
               'id' => $Breakfast -> id,
               'name_ar' => $Breakfast -> name_ar,
               'descrption_ar' => $Breakfast -> descrption_ar,
               'image' => url('/images/'.$Breakfast -> image),
               'time' => $Breakfast -> time,
               'category'=>$Breakfast->category,
               'topRated' =>$Breakfast->topRate,
               'price'=>$Breakfast->price,

        
            
            
            ];
            }
            return response()->json(['breakfast'=>$data]);
        
    }

    function addrate(Request $request,$id){

        $item=Breakfast::find($id);
        $item->topRate=$request->topRate;
        $result=$item->save();
        if($result){
        return 'your data is ok!!';}
    }
    //////////////////
    function getbreakfastbyid(Request $request){
        $item=Breakfast::find($request->id);
        if(!$item){
          return  $this->returnError('001','this item not found');
        }
return response()->json($item);


    }



   
}
