<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Plan;
use App\Models\PlanPrice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function model()
    {
        return new Plan;
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

        $plans = $paginate ? $query->paginate($paginate)->appends(request()->query()) : $query->paginate(10)->appends(request()->query());
        return view('admin.plan.index', compact('plans'));
    }

    public function create()
    {
        $features = Feature::all();
        return view('admin.plan.create', compact('features'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $plan = $this->model()->create([
                'name' => $request->name,
                'position' => $request->position,
                'status' => $request->status,
                'description' => $request->description,
            ]);
            if ($request->hasFile('thumbnail')) {
                $plan->thumbnail = $request->file('thumbnail')->store('plans');
                $plan->save();
            }
            if ($request->has('feature_ids')) {
                foreach ($request->feature_ids as $feature) {
                    $plan->features()->attach($feature);
                }
            }
            if ($request->duration && $request->prices && $request->special_prices) {
                foreach ($request->duration as $key => $duration) {
                    $plan->prices()->create([
                        'plan_id' => $plan->id,
                        'duration' => $duration,
                        'price' => $request->prices[$key],
                        'special_price' => $request->special_prices[$key],
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.plans')->with('success', 'Plan added successfully');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->withErrors(['error' => 'An error occurred while adding the Plan.'])->withInput();
        }
    }
    public function edit($id)
    {
        $plan = $this->model()->find($id);
        $features = Feature::all();
        return view('admin.plan.edit', compact('plan', 'features'));
    }
    public function update($id, Request $request)
    {
        $plan = $this->model()->find($id);
        DB::beginTransaction();
        try {
            $plan->update([
                'name' => $request->name,
                'position' => $request->position,
                'status' => $request->status,
                'description' => $request->description,
            ]);
            if ($request->hasFile('thumbnail')) {
                $plan->thumbnail = $request->file('thumbnail')->store('plans');
                $plan->save();
            }
            if ($request->has('feature_ids')) {
                $plan->features()->sync($request->feature_ids);
            }
            $plan->prices()->delete();
            if ($request->duration && $request->prices && $request->special_prices) {
                foreach ($request->duration as $key => $duration) {
                    $plan->prices()->create([
                        'plan_id' => $plan->id,
                        'duration' => $duration,
                    ], [
                        'price' => $request->prices[$key],
                        'special_price' => $request->special_prices[$key],
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.plans')->with('success', 'Plan updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->withErrors(['error' => 'An error occurred while adding the Plan.'])->withInput();
        }
    }
}
