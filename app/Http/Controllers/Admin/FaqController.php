<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function model()
    {
        return new FAQ;
    }
    public function index()
    {
        $searchColumns = ['id', 'question', 'answer'];
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

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $faq = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.faq.index', compact('faq'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'position' => 'required|integer',
        ]);
        DB::beginTransaction();
        try {
            FAQ::create($request->all());
            DB::commit();
            return redirect()->route('admin.faq')->with('success', 'FAQ created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('error', 'Error creating FAQ');
        }
    }
    public function edit($id)
    {
        $faq = FAQ::find($id);
        return view('admin.faq.update', compact('faq'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'position' => 'required|integer',
        ]);
        DB::beginTransaction();
        try {
            FAQ::find($id)->update($request->all());
            DB::commit();
            return redirect()->route('admin.faq')->with('success', 'FAQ updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('error', 'Error updating FAQ');
        }
    }
    public function delete($id)
    {
        $faq = FAQ::find($id);
        $faq->delete();
        return redirect()->route('admin.faq')->with('success', 'FAQ deleted successfully');
    }
    public function bulk(Request $request)
    {
        $type = $request->type;
        $selectedItems = $request->selectedIds;
        $status = $request->status;

        foreach ($selectedItems as $item) {
            $category = FAQ::find($item);
            if ($type == 1) {
                $category->delete();
            } else if ($type == 2) {
                $category->update(['status' => $status]);
            }
        }
        return response()->json(['success' => true, 'message' => 'Bulk operation is completed']);
    }
}
