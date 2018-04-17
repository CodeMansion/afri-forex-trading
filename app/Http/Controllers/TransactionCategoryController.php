<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionCategory;

class TransactionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['transactioncategories'] = TransactionCategory::all();
        return view('admin.transactioncategories.index')->with($data);
    }


    public function getEditInfo(Request $request)
    {
        try {
            $params['transactioncategory'] = TransactionCategory::find($request->transactioncategories_id, 'slug');
            return view('admin.transactioncategories.partials._transaction_categories_details_')->with($params);
        } catch (Exception $e) {
            return false;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        if(isset($data) && $data['req'] == 'add_transactioncategories') {
            \DB::beginTransaction();
            try {
                    TransactionCategory::insert([
                            'slug' => bin2hex(random_bytes(64)),
                            'name' => $data['name'],
                    ]);
                    $ip = $_SERVER['REMOTE_ADDR'];
                    activity_logs(auth()->user()->id, $ip, "Added Transaction Category");
                \DB::commit();
                return $response = [
                    'msg' => "Transaction Category Addedd Successfully.",
                    'type' => "true"
                ];

            } catch(Exception $e) {
                \DB::rollback();
                return $response = [
                    'msg' => "Internal Server Error",
                    'type' => "false"
                ];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->except('_token');
        if(isset($data) && $data['req'] == 'update_transactioncategories') {
            \DB::beginTransaction();
            try {
                    $transaction_category = TransactionCategory::find($data['transactioncategories_id'],'slug');
                    $transaction_category->name = $data['name'];
                    $transaction_category->save();
                    $ip = $_SERVER['REMOTE_ADDR'];
                    activity_logs(auth()->user()->id, $ip, "Update Transaction Category");
                \DB::commit();
                return $response = [
                    'msg' => "Transaction Category Updated Successfully.",
                    'type' => "true"
                ];

            } catch(Exception $e) {
                \DB::rollback();
                return $response = [
                    'msg' => "Internal Server Error",
                    'type' => "false"
                ];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $data = $request->except('_token');
        if($data) {
            if($data['req'] == 'transactioncategories_delete') {
                try {
                    $transaction_category = TransactionCategory::find($id,'slug');
                    $transaction_category->delete();

                    $ip = $_SERVER['REMOTE_ADDR'];
                    activity_logs(auth()->user()->id,$ip,"Delete Transaction Category");

                    return $response = [
                        'msg' => 'Deleted successfully',
                        'type' => 'true'
                    ];

                } catch(Exception $e) {
                    return $response = [
                        'msg' => "Internal Server Error",
                        'type' => "false"
                    ];
                }
            }
        }
    }
}
