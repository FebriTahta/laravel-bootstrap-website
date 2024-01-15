<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Konten;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Menu';
        if ($request->ajax()) {
            if ($request->tipe == 'menu') {
                $data_menu = Menu::withCount(['submenu','konten'])->orderBy('id','desc')->paginate(3);
                return response()->json([
                    'status' => 200,
                    'data_menu' => $data_menu,
                    'message' => 'data menu loaded'
                ]);
            }
        }
        return view('backend.menu.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Menu Edit';
        return view('backend.menu.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_name'    => 'required|max:20',
            'menu_status'  => 'required'
        ]);

        if ($validator->fails()) {
           return redirect()->back()->with('error',$validator->errors()->first());
        }else {

            if (empty(Menu::where('menu_name',$request->menu_name)->first())) {
                
                Menu::create([
                    'menu_name' => strtolower($request->menu_name),
                    'menu_status' => $request->menu_status,
                    'menu_slug' => Str::slug($request->menu_name)
                ]);

                return redirect()->to('/admin-menus')->with('success','Menu '.$request->menu_name.' has been Added');
            }else {
                return redirect()->back()->with('error','Menu dengan nama tersebut telah terdaftar');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu, $id)
    {
        $menu = Menu::findOrFail($id);
        return view('backend.menu.edit',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu, $id)
    {
        $validator = Validator::make($request->all(), [
            'menu_name'    => 'required|max:20',
            'menu_status'  => 'required'
        ]);

        if ($validator->fails()) {
           return redirect()->back()->with('error',$validator->errors()->first());
        }else {
            $menu = Menu::where('id', $id)->first();
            if ($menu->menu_name == strtolower($request->menu_name)) {
                # code...
                $menu->update([
                    'menu_name' => strtolower($request->menu_name),
                    'menu_slug' => Str::slug($request->menu_name),
                    'menu_status' => $request->menu_status
                ]);
                return redirect()->to('/admin-menus')->with('success','Menu '.$request->menu_name.' has been Updated');
            }else {
                if (empty(Menu::where('menu_name', strtolower($request->menu_name))->first())) {
                    $menu->update([
                        'menu_name' => strtolower($request->menu_name),
                        'menu_slug' => Str::slug($request->menu_name),
                        'menu_status' => $request->menu_status
                    ]);
                    return redirect()->to('/admin-menus')->with('success','Menu '.$request->menu_name.' has been Updated');
                }else {
                    return redirect()->back()->with('error','Menu dengan nama tersebut telah terdaftar');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu, $id)
    {
        $menu   = Menu::findOrFail($id);
        // cek konten yang berelasi dengan menu
        $konten = Konten::where(function ($query) {
                $query->where('konten_name', 'LIKE', '%berita%')
                ->orWhere('konten_name', 'LIKE', '%artikel%')
                ->orWhere('konten_name', 'LIKE', '%guru%')
                ->orWhere('konten_name', 'LIKE', '%prestasi%')
                ->orWhere('konten_name', 'LIKE', '%e-book%');
        })
        ->get();

        if ($konten->count() > 0) {
            # menu punya konten code...
            return response()->json([
                'status'=>400,
                'message'=>'Menu tersebut tidak dapat dihapus'
            ]);
        }

        if (isset($menu->submenu)) {
            # menu punya submenu code...
            $submenu = Submenu::where('menu_id', $id)->get();
            $submenu_id = [];
            foreach ($submenu as $key => $value) {
                $submenu_id[] = $value->id;
            }

            $konten2 = Konten::where('kontentable_type', Submenu::class)
                                ->where(function ($query) {
                                    $query->where('konten_name', 'LIKE', '%berita%')
                                    ->orWhere('konten_name', 'LIKE', '%artikel%')
                                    ->orWhere('konten_name', 'LIKE', '%guru%')
                                    ->orWhere('konten_name', 'LIKE', '%prestasi%')
                                    ->orWhere('konten_name', 'LIKE', '%e-book%');
                                })
                                ->whereIn('kontentable_id', $submenu_id)->get();
            if ($konten2->count() > 0) {
                # ada konten terkait pada submenu code...
                return response()->json([
                    'status'=>400,
                    'message'=>'Menu tersebut tidak dapat dihapus'
                ]);
            }else {
                # tidak ada konten terkait code...
                Konten::where('kontentable_type', Submenu::class)
                        ->whereIn('kontentable_id', $submenu_id)->delete();
                Submenu::where('menu_id',$id)->delete();
            }
        }
        $menu->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Menu, Submenu, Konten, serta Post Telah dihapus'
        ]);
    }
}
