<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use App\Http\Requests\StoreIncomeCategoryRequest;
use domain\Facades\IncomeCategoryFacade;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $categories = IncomeCategoryFacade::allWithParamAndPaginate($request->all());

            $allCategories = IncomeCategoryFacade::all();
            $totalCount = $allCategories->count();
            $activeCount = IncomeCategoryFacade::activeCount();
            $inactiveCount = IncomeCategoryFacade::deactiveCount();

            return view('pages.admin.income_category.index', compact('categories','totalCount','activeCount','inactiveCount'));
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('admin.income-categories.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncomeCategoryRequest $request)
    {
        try {

            IncomeCategoryFacade::store($request->all());

            return redirect()->route('admin.income-categories.index')->with('success', 'Category Added Successfully');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect()->route('admin.income-categories.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            IncomeCategoryFacade::update($id, $request->all());

            return redirect()->route('admin.income-categories.index')->with('success', 'Category Updated Successfully');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            IncomeCategoryFacade::destroy($id);

            return json_encode(array('response' => 'success', 'message' => 'Category Deleted Successfully!'));
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function updateIncomeCategoryStatus(Request $request)
    {

        IncomeCategoryFacade::updateIncomeCategoryStatus($request->all());

        return response()->json([
            'status' => 'success',
            'message' =>  '',
        ]);
    }
}
