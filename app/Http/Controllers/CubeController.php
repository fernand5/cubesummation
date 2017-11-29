<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cube;
use Form;

class CubeController extends Controller
{
    public function index(){
        return view('pages/index');
    }

    /**
     * Receive the request that contain the N and M value
     * plus the sentences
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function calculate(Request $request){

        $n=$_POST['n'];
        $m=$_POST['m'];
        $sentences=$_POST['sentences'];

        $dataSentence=explode("\n", $sentences);
        $cube=new Cube($n,$m);
        $response=array();
        // check if M value and the array of sentences (length) are the same
        if($m==count($dataSentence)){
            foreach ($dataSentence as $line){
                $sentence=explode(" ", $line);
                if($sentence[0]=='UPDATE'){
                    $cube->setValuePosition($sentence[1]-1,$sentence[2]-1,$sentence[3]-1,$sentence[4]);
                }elseif ($sentence[0]=='QUERY'){
                    array_push($response,$cube->getQuery($sentence[1]-1,$sentence[2]-1,$sentence[3]-1,$sentence[4]-1,$sentence[5]-1,$sentence[6]-1));
                }else{
                    return response()->json([
                        'error'=>'Command not found'
                    ]);
                }
            }

            return response()->json($response);
        }else{
            return response()->json([
                'error'=>'M value distinct of sentences quantity'
            ]);
        }
    }
}
