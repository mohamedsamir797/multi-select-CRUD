<?php

namespace App\Http\Controllers\test;

use App\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Importer;
use Exporter;





class testController extends Controller
{
    public function excele(){
        return view('excel.form');
    }

    public function importexcele(Request $request){

        request()->validate([
            'file'=>'required|max:5000|mimes:xlsx,xls,cs'
        ]);


        $filename =$request->file('file')->getClientOriginalName();
        $filepath = $request->file('file')->move('uploads',$filename);

        $excel = Importer::make('Excel');
        $excel->load($filepath);
        $collection = $excel->getCollection();

        if (sizeof($collection[1]) ==5 ){
            for ( $row=1 ; $row<sizeof($collection) ; $row++){
                try{
                    $excel = new Excel;
                    $excel->name = $collection[1][1];
                    $excel->age = $collection[1][2];
                    $excel->school = $collection[1][3];
                    $excel->birthdate = $collection[1][4];
                    $excel->save();

                    $excel = new Excel;
                    $excel->name = $collection[2][1];
                    $excel->age = $collection[2][2];
                    $excel->school = $collection[2][3];
                    $excel->birthdate = $collection[2][4];
                    $excel->save();

                    $excel = new Excel;
                    $excel->name = $collection[3][1];
                    $excel->age = $collection[3][2];
                    $excel->school = $collection[3][3];
                    $excel->birthdate = $collection[3][4];
                    $excel->save();

                    $excel = new Excel;
                    $excel->name = $collection[4][1];
                    $excel->age = $collection[4][2];
                    $excel->school = $collection[4][3];
                    $excel->birthdate = $collection[4][4];
                    $excel->save();
                    return redirect()->back();
                }catch (\Exception $e){
                  return redirect()->back();
                }
            }
        }
        return back();
    }

}

