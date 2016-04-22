<?php

namespace App\Http\Controllers;

use App\Element;
use App\Http\Requests;
use App\Repositories\ElementRepository;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use ZipArchive;

class ElementController extends Controller
{

    protected $elements;


    public function __construct(ElementRepository $elements)
    {

        $this->middleware('auth');
        
        $this->elements = $elements;

    }

    /**
     * 发布切片到切片库
     *
     * 场景:比如4~5级别的用户不经过审核直接发布
     *
     * 需要将接收到的文件解压存放,然后在数据库中存储数据
     *
     * @param Request $request
     * @return array
     */
    public function publishElement(Request $request)
    {

        $element = new Element;
        $this->authorize('publish',$element);


        $this->validate($request, [
            'name' => 'required|max:255',
            'parentId'=>'required',
            'elementFile'=>'required',
        ]);

        $uuid = uniqid();


        if ($request->hasFile('elementFile')
            && $request->file('elementFile')->isValid()
        ) {
            $elementFile = $request->file('elementFile')->move('elements', "e_".$uuid);

            $zip = new ZipArchive();
            $res=$zip->open($elementFile->getPathname());
            if($res===true){
                $zip->extractTo('elements/ee_'.$uuid);
                $zip->close();
            }else{
                return response()->json([
                    'status' => 0,
                    'message'=>'zip fault',
                ]);
            }

            //注意这里的取值,使用input(),否则报错
            $element->name = $request->input('name');
            $element->url = 'e_'.$uuid;
            $element->user_id = $request->user()->id;
            $element->parent_id = $request->input('parentId');
            $element->e_type=2;//切片
            $element->save();

            return response()->json([
                'status' => 1,
                'result' => $element,
            ]);

        } else {
            return response()->json([
                'status' => 0,
            ]);
        }
    }

    /**
     *
     * 添加"坑","文件夹"
     * "文件"通过publish和待审接口处理
     *
     * @param Request $request
     */
    public function addElement(Request $request)
    {
        $element=new Element();
        $this->authorize('addElement',$element);

        $this->validate($request, [
            'name' => 'required|max:255',
            'parentId'=>'required',
            'eType'=>'required',
        ]);

        $element=new Element();
        $element->name=$request->name;
        $element->user_id=$request->user()->id;
        $element->parent_id=$request->parentId;
        $element->e_type=$request->eType;
        //todo: getGradeAndSubject($request->user()->position_id);
        $element->grade_subject="1010";
        $element->save();

        return response()->json([
            'status' => 1,
            'result'=>$element,
        ]);

    }

    /**
     *
     * 删除"坑","文件夹",那么在它们下面的"文件夹""坑""文件"都需要做删除
     * @param Request $request
     * @return mixed
     */
    public function removeElement(Request $request){
        $element = Element::findOrFail($request->id);

        //在ElementPolicy中设置
        $this->authorize('destroy', $element);

        $element->delete();

        return response()->json([
            'status' => 1,
            'result' => $element,
        ]);

    }

    /**
     *
     * 搜索
     * @param Request $request
     */
    public function search(Request $request){

    }

    /**
     *
     * 根据parentId获取切片列表
     * @param Request $request
     * @return
     */
    public function getElementsByParentId(Request $request)
    {
        return response()->json([
            'status' => 1,
            'result' => $this->elements->forParentId($request->parentId),
        ]);
    }

    /**
     *
     * 获取用户所属切片
     * @param Request $request
     * @return mixed
     */
    public function getOwnElements(Request $request)
    {
        return $this->elements->forUser($request->user());
    }

    /**
     * Display a listing of the resource.
     *
     * 显示用户的所有切片
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('element', [
            "elements" => $this->getOwnElements($request)]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * 存储切片
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->elements()->create([
            'name' => $request->name,
//            'user_id'=>$request->user()->id,//user_id会自动添加到数据库中
        ]);

        return redirect('element');
    }

    /**
     * Display the specified resource.
     *
     * 显示指定切片
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 编辑切片
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * 1. 修改名称
     * 2. 调整位置
     *
     *
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $element = Element::findOrFail($id);

        //在ElementPolicy中设置
        $this->authorize('destroy', $element);

        $element->delete();

        return redirect('element');
    }
}
