<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Campaign;
use App\Models\Backend\Page;
use App\Models\Backend\ProductCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        $values = Page::all();
        return view('backend.pages.index', compact('values'));
    }

    public function create()
    {
        return view('backend.pages.create');
    }


    public function store(Request $request)
    {

        $messages = [
            'page_name.required' => 'Te rugam sa completezi datele',
            'url.required' => 'Te rugam sa completezi datele',
            'content.required' => 'Te rugam sa completezi datele',
        ];

        $validator = Validator::make($request->all(),
            [
                'page_name' => 'required',
                'url' => 'required',
                'page_content' => 'required',

            ], $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $page = new Page();
        $page->page_name = $request->page_name;
        $page->url = $request->url;
        $page->page_content = $request->page_content;
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page added successfully');
    }

    public function edit($id)
    {
        //
        $value = Page::find($id);
        return view('backend.pages.edit', compact('value'));
    }

    public function update(Request $request, $id)
    {
        //check if all the fields are completed
        $request->validate(
            [
                'page_name' => 'required',
                'url' => 'required',
                'page_content' => 'required',
            ]
        );

        // save the new page
        $page = Page::find($id);
        $page->page_name = $request->page_name;
        $page->url = $request->url;
        $page->page_content = $request->page_content;
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page edited');
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();

        return redirect()->route('pages.index')->with('success', 'Page deleted');
    }

    //display the desired page
    public function displayPage($url)
    {
        $page = Page::where('url', $url)->first();

        if ($page == "") {
            $segment = config('app.locale');
            $page = Page::where('url', $url)->first();
            if ($page == "") {
                return back()->with('error', 'Could not find the page at the moment');
            }
        } else {
            return view('frontend.pages.index')->with(
                [
                    'value' => $page
                ]
            );
        }
    }

    public function participationIndex()
    {

        $prizes = ProductCatalog::get();
        return view('frontend.participation.index', compact('prizes'));
    }
}
