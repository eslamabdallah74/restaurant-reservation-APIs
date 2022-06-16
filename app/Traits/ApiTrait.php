<?php
namespace  App\Traits;

use App\Classes\Responseobject;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

trait ApiTrait {
    public function returnError($msg){
        return response()->json([
            'status'=>false,
            "msg"=>$msg
        ]);
    }
    public function returnSuccess($msg=""){
        return response()->json([
            'status'=>true,
            "msg"=>$msg
        ]);
    }
    public function returnData($key,$value,$msg="",array $extra=[]){
        $data = [
            $key=>$value
        ];
        if (!empty($extra)) {
            foreach ($extra as $key => $value) {
                $data[$key] = $value;
            }
        }
        $data['status'] = true;
        $data['msg'] = $msg;
        return response()->json($data);
    }


}
