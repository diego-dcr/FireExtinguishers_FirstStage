<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Floorplan;
use App\Models\FireExt;

class FloorplanController extends Controller
{
    private $path = 'imagenes/planos/';

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $img = $request->file('img');
        $url = $this->path . $img->getClientOriginalName();
        Storage::disk('public')->put($url, file_get_contents($img));

        $floorplan = new Floorplan($request->all());
        $floorplan->path = $url;
        $floorplan->save();

        return redirect()->route('landscape', ['section' => 2]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id, int $section)
    {
        $floorplan = Floorplan::findOrFail($id);
        $exts = FireExt::where('floor', $floorplan->floor)->get();
        $devices = Device::where('floorplan_id', $floorplan->id)->get();
        return view('floorplan.edit', compact(
            'floorplan',
            'exts',
            'devices',
            'section'
        ));
    }

    public function update(Request $request, string $id)
    {
        $points = json_decode($request->input('points'));
        foreach ($points as $point) {
            Device::updateOrCreate(
                [
                    'floorplan_id' => $id,
                    'fire_ext_id' => $point->id,
                ],
                [
                    'x' => $point->x,
                    'y' => $point->y,
                ]
            );
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $id = $request->input('ext_id');
        $floorplan = Floorplan::find($id);
        $floorplan->delete();
        return redirect()->back();
    }
}
