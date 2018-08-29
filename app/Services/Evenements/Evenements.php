<?php

namespace App\Services\Evenements;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;

class Evenements
{


    public static function update($request)
    {      


        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100|min:2',
            'description' => 'required',
            'date' => 'required',
            'type' => 'required',
         ]);

        if ($validator->fails()) {

            return response()->json(['errors'=>$validator->errors()]);

        }else{

            return DB::table('evenements')->where('id_event', $request->input('id_event'))->update([
                'titre' => $request->input('name'), 
                'description' => $request->input('description'),
                'date' => $request->input('date'),
                'type' => $request->input('type'),
            ]);
            
        }

    }

    public static function get()
    {
        /**
         * Appel à la base de donnée 
         * @return array 
        */
        $query = DB::table('evenements')->select('*')->where('user_id', Auth::id())->get()->toArray();
        return $query;
    }


    public static function delete($id)
    {
        $query = DB::table('evenements')->where([
            ['user_id', Auth::id()],
            ['id_event', $id],
        ])->delete();

        return $query;
    }


}
