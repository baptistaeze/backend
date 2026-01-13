<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{
    public function index()
    {
        return Banner::orderBy('position')->get();
    }

    public function store(StoreBannerRequest $request)
    {
        $path = $request->file('image')->store('banners', 'public');

        Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $path,
            'position' => $request->position
        ]);
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
    }
}
