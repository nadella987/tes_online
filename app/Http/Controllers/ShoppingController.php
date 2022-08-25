<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Shopping;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' => 'required',
            'createdDate' => 'required',
    
        ]);

        if($validator->fails()) {
            return Response()->json($validator->errors());

        }

        $shopping = new Shopping;
        $shopping->name = $request->name;
        $shopping->createdDate = $request->createdDate;
        $shopping->save();
        return response()->json(['message' => 'Berhasil Tambah shopping']);

    }


    public function getAll()
    {
        $data = Shopping::get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function getById($id)
    {
        $data = Shopping::where('id', '=', $id)->first();        
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator= Validator::make($request->all(),[
            'name' => 'required',
            'createdDate' => 'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $shopping = Shopping::where('id', '=' ,$id)->first();
        $shopping->name = $request->name;
        $shopping->createdDate = $request->createdDate;
        $shopping->save();
        return response()->json(['message' => 'Data shopping Berhasil update']);
        
    }

    public function delete($id)
    {
        $delete = Shopping::where('id', '=', $id)->delete();
        
        if($delete) {
            return response()->json([
                'success' => true,
                'message' => 'Databerhasil dihapus'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Data  gagal dihapus'
            ]);            
        }
    }
 
}