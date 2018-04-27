<?php

namespace App\Http\Controllers\Teacher;

use App\Asset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssetsController extends Controller
{
    /**
     * Store a newly created asset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asset = $request->validate([
            'title' => 'required',
            'description' => 'required|string',
            'type' => 'required|string',
            'path' => 'nullable',
        ]);
        // Storage::disk('public')->delete(auth()->user()->getOriginal('avatar_path'));
        if ($asset['path'] != null && $path = $request->file('path')->store('assets', 'public')) {
            $asset['path'] = $path;
        }
        $asset['user_id'] = auth()->id();
        $asset = Asset::create($asset);
        return redirect()
            ->back();
    }
}
