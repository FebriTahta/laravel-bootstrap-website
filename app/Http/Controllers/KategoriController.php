<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Post;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->tipe == 'kategori') {
            $data = Kategori::orderBy('id','desc')->paginate(5);
            return response()->json([
                'status' => 200,
                'message' => 'load kategori data',
                'data_kategori' => $data
            ]);
        }
        $title = 'KATEGORI';
        return view('backend.kategori.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "CREATE NEW KATEGORI";
        return view('backend.kategori.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_name'    => 'required|max:50|unique:kategoris,kategori_name',
            'kategori_status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->with('input', $request->all());
        }else {
            $kategori = Kategori::create([
                'kategori_name' => strtolower($request->kategori_name),
                'kategori_slug' => Str::slug($request->kategori_name),
                'kategori_status' => $request->kategori_status,
            ]);
            return redirect()->to('/admin-kategori')->with('success','kategori '.$request->kategori_name.' has been Added');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori, $id)
    {
        $id = base64_decode($id);
        $data = Kategori::find($id);
        $title = 'EDIT KATEGORI';
        return view('backend.kategori.edit',compact('data','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori, $id)
    {
        // return $request->kategori_status;
        $validator = Validator::make($request->all(), [
            'kategori_name'    => 'required|max:50',
            'kategori_status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->with('input', $request->all());
        }else {

            $kategori = Kategori::where('id', $id)->first();
            if ($kategori->kategori_name == strtolower($request->kategori_name)) {
                $kategori->update([
                    'kategori_name' => strtolower($request->kategori_name),
                    'kategori_slug' => Str::slug($request->kategori_name),
                    'kategori_status' => $request->kategori_status,
                ]);

                return redirect()->to('/admin-kategori')->with('success','Kategori '.$request->kategori_name.' has been updated');
            }else {
                if (empty(Kategori::where('kategori_name', strtolower($request->kategori_name))->first())) {
                    $kategori->update([
                        'kategori_name' => strtolower($request->kategori_name),
                        'kategori_slug' => Str::slug($request->kategori_name),
                        'kategori_status' => $request->kategori_status,
                    ]);
                    return redirect()->to('/admin-kategori')->with('success','kategori '.$request->kategori_name.' has been Updated');
                }else {
                    return redirect()->back()->with('error','Kategori dengan nama tersebut telah terdaftar');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori, $id)
    {
        $id = base64_decode($id);
        $kategori = Kategori::findOrFail($id);
        if ($kategori->post()) {
            $kategori->post()->detach();
        }
        $kategori->delete();
        return response()->json([
            'status'=>200,
            'message'=>'kategori Telah dihapus'
        ]);
    }
}
