<?php

namespace App\Http\Controllers\Admin;
use App\Models\BrandModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandPost;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //搜索
        $brand_name=request()->brand_name;
        // dump($brand_name);
        $where=[];
        if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
        }
        $brand_url=request()->brand_url;
        // dump($brand_url);
        if($brand_url){
            $where[]=['brand_url','like',"%$brand_url%"];
        }

        //
       $brand=BrandModel::where($where)->orderBy('brand_id','desc')->paginate(5);
       //dump($brand);
       if(request()->ajax()){
           return view('admin.brand.ajaxpage',['brand'=>$brand,'query'=>request()->all()]);
       }
        return view('admin.brand.index',['brand'=>$brand,'query'=>request()->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *添加执行
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //第二种验证
     // public function store(StoreBrandPost $request)
    public function store(Request $request)
    {
        //第一种验证
        // $validatedData = $request->validate([
        // 'brand_name' => 'required|unique:brand|max:255',
        // 'brand_url' => 'required|unique:brand',
        // 'brand_desc'=>'required'
        // ],[
        //     'brand_name.required' => '品牌名称不能为空',
        //     'brand_name.unique' => '品牌名称已存在',
        //     'brand_url.required' => '品牌网址不能为空',
        //     'brand_url.unique' => '品牌网址已存在',
        //     'brand_desc.required' => '品牌简介不能为空',
        // ]);
        //
        //
        //第三种验证
        $validator = Validator::make($request->all(),
        [
        'brand_name' => 'required|unique:brand|max:255',
        'brand_url' => 'required',
        'brand_desc'=>'required'
        ],[
            'brand_name.required' => '品牌名称不能为空',
            'brand_name.unique' => '品牌名称已存在',
            'brand_url.required' => '品牌网址不能为空',
            'brand_desc.required' => '品牌简介不能为空',
        ]);
        if ($validator->fails()) {
        return redirect('brand/create')
        ->withErrors($validator)
        ->withInput();
        }

        //第一中接收,可以在数组中多排除
        $post=$request->except(['_token','file']);
         // dd($post);
        //第二种只接收的数据
        // $post=$request->only(['_token']);
        // dd($post);
        //第一种save添加也可做修改
        // $brand=new BrandModel;
        // $brand->brand_name=$request->brand_name;
        // $brand->brand_url=$request->brand_url;
        // $brand->brand_desc=$request->brand_desc;
        // $brand->brand_logo=$request->brand_logo;
        // $res=$brand->save();
        // dd($res);
        //第二种insert
        // $res=BrandModel::insert($post);
        //第三种insertGetId
        // $res=BrandModel::insertGetId($post);
        //第四种create 需要设置黑白名单
         $res=BrandModel::create($post);
        // dd($res);
        if($res){
            return redirect('/brand');
        }else{
            return redirect('/brand/create');
        }

}
    /**
     * Display the specified resource.
     *详情页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        echo "品牌详情页面";
    }
    /**
     * Display the specified resource.
     *文件上传
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request){

        // dd($file);
        // echo 123;

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $photo=$request->file;
        $store_result = $photo->store('upload');
        // return json_encode(['code'=>0,'msg'=>'上传成功','data'=>env('IMG_URL').$store_result]);
        return $this->success('上传成功',env('IMG_URL').$store_result);
        }
       // return json_encode(['code'=>2,'msg'=>'上传失败']);
       return $this->error('上传失败');

        }
    /**
     * Show the form for editing the specified resource.
     *修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $brand=BrandModel::find($id);
         // dd($brand);
        return view('admin.brand.edit',['brand'=>$brand]);

    }

    /**
     * Update the specified resource in storage.
     *修改执行
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBrandPost $request, $id)
    {
        //
       $post=$request->except(['_token','file']);
        // dd($post);
       $res=BrandModel::where('brand_id',$id)->update($post);
       // dd($res);
       if($res!==false){
           return redirect('/brand');
       }
    }

    /**
     * Remove the specified resource from storage.
     *删除页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        //
        // echo "品牌删除页面";
        // dd($id);
        $id=request()->id?:$id;
        if(!$id){
            return;
        }
        $res=BrandModel::destroy($id);
        if(request()->ajax()){
            // return response()->json(['code'=>0,'msg'=>'删除成功√']);
            return $this->success('删除成功√');
        }
        if($res){
            return redirect('/brand');
        }
    }
    public function change(Request $request){
        $brand_name=$request->newname;
        $id=$request->id;
        // dump($brand_name);
        // dd($id);
        //只要一个参数为空就返回错误
        if(!$brand_name || !$id){
            // return response()->json(['code'=>3,'msg'=>'缺少参数']);
            return $this->error('缺少参数');
        }
        //成功返回
        $res=BrandModel::where('brand_id',$id)->update(['brand_name'=>$brand_name]);
        if($res){
            // return response()->json(['code'=>0,'msg'=>'修改成功']);
            return $this->success('修改成功');

        }
        }
}
