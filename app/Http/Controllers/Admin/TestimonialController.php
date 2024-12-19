<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonials;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function model()
    {
        return new Testimonials;
    }
    public function index()
    {
        $searchColumns = ['id', 'name', 'comments'];
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
                foreach ($searchColumns as $key => $value)
                    ($key == 0) ? $q->where($value, 'LIKE', '%' . $search . '%') : $q->orWhere($value, 'LIKE', '%' . $search . '%');
            });

        // sorting
        ($order == '') ? $query->orderByDesc('id') : $query->orderBy($order, $orderBy);

        $testimonials = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.testimonial.index', compact('testimonials'));
    }
    public function create()
    {
        return view('admin.testimonial.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comments' => 'required|string',
            'image_url' => 'required|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $testimonial = $this->model()->create([
                'name' => $request->name,
                'comments' => $request->comments,
            ]);

            $path = '';
            if ($request->hasFile('image_url')) {
                $path = $request->file('image_url')->store("testimonials/{$testimonial->id}", 'public');
                $testimonial->update(['image_url' => $path]);
            }

            DB::commit();
            return redirect()->route('admin.testimonials')->with('success', 'Testimonial added successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e);
            return back()->withErrors(['error' => 'An error occurred while adding the testimonial.'])->withInput();
        }
    }
    public function edit($id)
    {
        $testimonials = $this->model()->find($id);
        return view('admin.testimonial.update', compact('testimonials'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'comments' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $testimonials = $this->model()->findOrFail($id);

            $testimonials->update([
                'name' => $request->name,
                'comments' => $request->comments,
            ]);

            if ($request->hasFile('image_url')) {
                if ($testimonials->image_url) {
                    Storage::disk('public')->delete('testimonials/' . $testimonials->image_url);
                }

                $folder = 'testimonials/' . $testimonials->id;

                $imagePath = $request->file('image_url')->store($folder, 'public');

                $testimonials->update(['image_url' => $imagePath]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('admin.testimonials')->with('success', 'testimonials updated successfully');
    }

    public function delete($id)
    {
        $this->model()->destroy($id);
        return back()->with('success', 'testimonials deleted successfully');
    }
}
