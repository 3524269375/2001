<?php
namespace App\Http\Response;
trait JsonResponse{
    //失败调用方法
    public function error($msg='',$data=[]){
        return $this->JsonResponse('-1',$msg,$data);
    }
    //成功调用方法
    public function success($msg='',$data=[]){
        return $this->JsonResponse('0',$msg,$data);
    }

    //主用方法
    public function JsonResponse($code=0,$msg,$data=[]){
        $data=[
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data,
        ];
        return response()->json($data);


        }




}
