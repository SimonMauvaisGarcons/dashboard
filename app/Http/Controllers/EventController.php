<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use Illuminate\Http\Request;
use App\EvenementModel;
use App\Services\Evenements\Evenements;


class EventController extends Controller
{
    /**
     * Ajouter un evenement
     */
    public function add(Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100|min:2',
            'description' => 'required',
            'date' => 'required',
            'type' => 'required',
         ]);
        
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }else{
            return EvenementModel::create([
                'user_id' => Auth::id(),
                'titre' => $request->input('name'),
                'description' => $request->input('description'),
                'date' => $request->input('date'),
                'type' => $request->input('type'),
            ]);
        }
    }
    public function delete(Request $request) {

        $id = $request->input('id');
        Evenements::delete($id);

    }

    public function update(Request $request) {
        
        return Evenements::update($request);
        
    }
}
