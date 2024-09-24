<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;

use App\Models\FireExt;


class FireExtController extends Controller
{
    private $name = 'floorplan';

    public function index(int $section)
    {
        $exts = FireExt::all();
        return view('welcome', compact(
            'exts',
            'section'
        ));
    }

    public function store(Request $request)
    {
        $url = url()->previous();
        $ext = new FireExt($request->all());
        $ext->save();
        return Str::contains($url, $this->name) ? redirect()->back() : redirect()->route('landscape', ['section' => 1]);
    }

    public function update(Request $request)
    {
        $id = $request->input('ext_id');
        $ext = FireExt::findOrFail($id);
        $ext->fill($request->all());
        $ext->save();
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $id = $request->input('ext_id');
        $ext = FireExt::find($id);
        $ext->delete();
        return redirect()->back();
    }
}
