<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function model()
    {
        return new Page;
    }
    public function index()
    {
        $searchColumns = ['id', 'name', 'position'];
        $search = request()->search;
        $from_date = request()->from_date;
        $to_date = request()->to_date;
        $order = request()->orderedColumn;
        $orderBy = request()->orderBy;
        $paginate = request()->paginate;

        $query = $this->model()->query();

        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }
        if ($search != '')
            $query->where(function ($q) use ($search, $searchColumns) {
                foreach ($searchColumns as $key => $value) ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

      
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $pages = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.cms.pages.index', compact('pages'));
    }
    public function bulk(Request $request)
    {
        $type = $request->type;
        $selectedItems = $request->selectedIds;
        $status = $request->status;

        foreach ($selectedItems as $item) {
            $category = Page::find($item);
            if ($type == 1) {
                $category->delete();
            } else if ($type == 2) {
                $category->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }

    public function create()
    {
        return view('admin.cms.pages.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'title' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'keywords' => 'required',
        ]);
        Page::create([
            'name' => $request->name,
            'position' => $request->position,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->keywords,
        ]);
        return redirect()->route('admin.pages')->with('success', 'Pages added successfully');
    }

    public function edit(string $id)
    {
        $page = Page::find($id);
        return view('admin.cms.pages.update', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = Page::find($id);
        $page->update([
            'name' => $request->name,
            'position' => $request->position,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->keywords,
        ]);
        return redirect()->route('admin.pages')->with('success', 'Pages updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Page::destroy($id);
        return back()->with('success', 'Page removed successfully');
    }
}
