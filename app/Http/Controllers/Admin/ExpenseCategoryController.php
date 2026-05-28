<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use App\Http\Requests\StoreExpenseCategoryRequest;
use domain\Facades\ExpenseCategoryFacade;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $categories = ExpenseCategoryFacade::allWithParamAndPaginate($request->all());

            $allCategories = ExpenseCategoryFacade::all();
            $totalCount = $allCategories->count();
            $activeCount = ExpenseCategoryFacade::activeCount();
            $inactiveCount = ExpenseCategoryFacade::deactiveCount();

            return view('pages.admin.expense_category.index', compact('categories','totalCount','activeCount','inactiveCount'));
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('admin.expense-categories.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseCategoryRequest $request)
    {
        try {

            ExpenseCategoryFacade::store($request->all());

            return redirect()->route('admin.expense-categories.index')->with('success', 'Category Added Successfully');
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
        return redirect()->route('admin.expense-categories.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreExpenseCategoryRequest $request, string $id)
    {
        try {

            ExpenseCategoryFacade::update($id, $request->all());

            return redirect()->route('admin.expense-categories.index')->with('success', 'Category Updated Successfully');
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

            ExpenseCategoryFacade::destroy($id);

            return json_encode(array('response' => 'success', 'message' => 'Category Deleted Successfully!'));
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function updateExpenseCategoryStatus(Request $request)
    {

        ExpenseCategoryFacade::updateExpenseCategoryStatus($request->all());

        return response()->json([
            'status' => 'success',
            'message' =>  '',
        ]);
    }
}
