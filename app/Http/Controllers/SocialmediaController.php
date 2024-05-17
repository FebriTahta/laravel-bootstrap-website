<?php

namespace App\Http\Controllers;

use App\Models\Socialmedia;
use Illuminate\Http\Request;
use Validator;

class SocialmediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $socialmedia_ready;

    public function __construct()
    {
        $this->socialmedia_ready = [
            ['name' => 'facebook', 'icon' => 'fa fa-facebook'],
            ['name' => 'tiktok', 'icon' => 'fa fa-tiktok'],
            ['name' => 'instagram', 'icon' => 'fa fa-instagram'],
            ['name' => 'linkedin', 'icon' => 'fa fa-linkedin'],
            ['name' => 'twitter', 'icon' => 'fa fa-twitter'],
            ['name' => 'whatsapp', 'icon' => 'fa fa-whatsapp'],
            ['name' => 'youtube', 'icon' => 'fa fa-youtube'],
            ['name' => 'telegram', 'icon' => 'fa fa-telegram'],
            ['name' => 'discord', 'icon' => 'fa fa-discord'],
            ['name' => 'threads', 'icon' => 'fa fa-thread'],
            ['name' => 'reddit', 'icon' => 'fa fa-reddit'],
            ['name' => 'quora', 'icon' => 'fa fa-quora'],
        ];
    }
    
    public function index(Request $request)
    {
        if ($request->ajax() && $request->tipe == 'socialmedia') {
            $socialmedia = Socialmedia::orderBy('id','desc')->paginate(10);
            return response()->json([
                'status' => 200,
                'message' => 'load socialmedia data',
                'data_socialmedia' => $socialmedia
            ]);
        }
        $title = 'SOCIAL MEDIA';
        return view('backend.socialmedia.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "SOCIAL MEDIA";
        $socialmedia_list = Socialmedia::get();

        // Mengambil nama-nama dari socialmedia_list
        $list_names = $socialmedia_list->pluck('socialmedia_name');

        // Mengambil nama-nama dari socialmedia_ready yang tidak ada di list_names
        $sosmed = collect($this->socialmedia_ready)->reject(function ($item) use ($list_names) {
            return $list_names->contains($item['name']);
        });
        
        return view('backend.socialmedia.create',compact('title','sosmed'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'socialmedia_name'    => 'required',
            'socialmedia_source'  => 'required|starts_with:https://',
        ],[
            'socialmedia_source.starts_with' => 'The :attribute must start with https://',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->with('input', $request->all());
        }else {
            $socialmedia_name = $request->socialmedia_name;
            $socialmedia_icon = null;
            foreach ($this->socialmedia_ready as $socialmedia) {
                if ($socialmedia['name'] === $socialmedia_name) {
                    $socialmedia_icon = $socialmedia['icon'];
                    break; // Keluar dari loop jika ditemukan
                }
            }
    
            Socialmedia::create([
                'socialmedia_name' => $request->socialmedia_name,
                'socialmedia_icon' => $socialmedia_icon,
                'socialmedia_source' => $request->socialmedia_source
            ]);

            return redirect()->to('/admin-socialmedia')->with('success','Social Media '.$request->socialmedia_name.' has been Added');
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Socialmedia $socialmedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Socialmedia $socialmedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Socialmedia $socialmedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Socialmedia $socialmedia)
    {
        //
    }
}
