<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tag_show', ['only' => 'index']);
        $this->middleware('permission:tag_create', ['only' => 'create', 'store']);
        $this->middleware('permission:tag_update', ['only' => 'edit', 'update']);
        $this->middleware('permission:tag_delet', ['only' => 'destroy']);
        $this->middleware('permission:tag_detail', ['only' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tag =  Tag::orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            $allData = DataTables::of($tag)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="text-center"><a href="javascript:void(0)" id="editTag" data-toggle="tooltip" data-id=" ' . $row->id . '" data-original-title="Edit" class="edit btn-sm btn btn-primary"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '<a href="javascript:void(0)" id="hapusTag" data-toggle="tooltip" data-original-title="Delete" data-id="' . $row->id . '" class="delete btn-sm btn btn-danger"><i class="fas fa-trash"></i></a></div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $allData;
        }
        $content = [
            'title' => 'Tag',
            'tag' => $tag
        ];
        return view('tags/admin', $content);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.insert', [
            'title' => 'Tag',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tag::updateOrCreate(['id' => $request->id], [
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::find($id);
        // $content = [
        //     'title' => 'Tag',
        //     'tags' => $tags
        // ];
        return response()->json($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:tags'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => false, 'message' => $validator->errors()->first()]);
        }

        try {
            Tag::find($id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
            ]);
        } catch (\Throwable $th) {
            Alert::error('Error', 'Tag Gagal DiUpdate!');
            return redirect()->back();
        }

        Alert::success('Success', 'Tag Berhasil DiUpdate!');
        return redirect('/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $a = Tag::find($id);
        $a->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Post Berhasil Dihapus!.',
        ]);
    }
}