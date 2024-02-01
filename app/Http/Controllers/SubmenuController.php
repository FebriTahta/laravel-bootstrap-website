<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use App\Models\Menu;
use App\Models\Konten;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tipe == 'submenu') {
                $data_submenu = Submenu::with('menu')->withCount(['konten'])->orderBy('id','desc')->paginate(3);
                return response()->json([
                    'status' => 200,
                    'data_submenu' => $data_submenu,
                    'message' => 'data sub-menu loaded'
                ]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = Menu::where('menu_status', 1)->with('konten')->get();
        return view('backend.menu.create2',compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'submenu_name'    => 'required|max:20',
            'submenu_status'  => 'required',
            'menu_id' => 'required'
        ]);

        if ($validator->fails()) {
           return redirect()->back()->with('error',$validator->errors()->first());
        }else {
            $menu = Menu::where('id',$request->menu_id)->whereHas('konten')->first();
            if (empty($menu)) {
                if (empty(Submenu::where('submenu_name',$request->submenu_name)->first())) {
                    Submenu::create([
                        'submenu_name' => strtolower($request->submenu_name),
                        'submenu_status' => $request->submenu_status,
                        'submenu_slug' => Str::slug($request->submenu_name),
                        'menu_id' => $request->menu_id
                    ]);
        
                    return redirect()->to('/admin-menus')->with('success','Sub-Menu '.$request->submenu_name.' has been Added');
                }else {
                    return redirect()->back()->with('error','Sub-menu dengan nama tersebut telah terdaftar');
                }
            }else {
                return redirect()->back()->with('error','Menu yang dipilih menjadi parent dari sub-menu ini telah memiliki konten. pilih menu lain');   
            }
           
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Submenu $submenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Submenu $submenu, $id)
    {
        $id = base64_decode($id);
        $submenu = Submenu::findOrFail($id);
        $menu = Menu::where('menu_status', 1)->whereDoesntHave('konten')->get();
        return view('backend.menu.edit2',compact('submenu','menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Submenu $submenu, $id)
    {
        $validator = Validator::make($request->all(), [
            'submenu_name'    => 'required|max:20',
            'submenu_status'  => 'required',
            'menu_id' => 'required'
        ]);

        if ($validator->fails()) {
           return redirect()->back()->with('error',$validator->errors()->first());
        }else {
            $submenu = Submenu::where('id', $id)->first();
            if ($submenu->submenu_name == strtolower($request->submenu_name)) {
                $submenu->update([
                    'submenu_name' => strtolower($request->submenu_name),
                    'submenu_status' => $request->submenu_status,
                    'submenu_slug' => Str::slug($request->submenu_name),
                    'menu_id' => $request->menu_id
                ]);
                return redirect()->to('/admin-menus')->with('success','Sub-Menu '.$request->submenu_name.' has been Updated');
            }else {
                if (empty(Submenu::where('submenu_name', strtolower($request->submenu_name))->first())) {
                    $submenu->update([
                        'submenu_name' => strtolower($request->submenu_name),
                        'submenu_status' => $request->submenu_status,
                        'submenu_slug' => Str::slug($request->submenu_name),
                        'menu_id' => $request->menu_id
                    ]);
                    return redirect()->to('/admin-menus')->with('success','Sub-Menu '.$request->submenu_name.' has been Updated');
                }else {
                    return redirect()->back()->with('error','Sub-Menu dengan nama tersebut telah terdaftar');
                }
            }   
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submenu $submenu, $id)
    {
        // $id = base64_decode($id);
        $submenu = Submenu::findOrFail($id);
        if (isset($submenu->konten)) {
            # cek konten code...
            $konten = Submenu::where('id', $id)->whereHas('konten', function($q){
                $q->where('konten_name', 'LIKE', '%berita%')
                ->orWhere('konten_name', 'LIKE', '%artikel%')
                ->orWhere('konten_name', 'LIKE', '%guru%')
                ->orWhere('konten_name', 'LIKE', '%prestasi%')
                ->orWhere('konten_name', 'LIKE', '%e-book%');
            })->get();
            if ($konten->count() > 0) {
                # ada konten terkait code...
                return response()->json([
                    'status'=>400,
                    'message'=>'Submenu tersebut tidak dapat dihapus'
                ]);
            }else {
                # tidak ada konten terkait code...
                $submenu->konten()->delete();
            }
        }
        $submenu->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Submenu, Konten, serta Post Telah dihapus'
        ]);
    }
}
