<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\SantriRequest;
use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Validator;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $per_page   = $request->per_page ? $request->per_page : 10;
            $sort_by    = $request->sort_by ? $request->sort_by : 'created_at';
            $order_by   = $request->order_by ? $request->order_by : 'asc';
            $page       = $request->page ? $request->page : 1;
            $search     = $request->search;
            $santri     = Santri::query();
            $data       = $search
                            ? $santri->where('name', 'LIKE', "%$search%")->orderBy($sort_by, $order_by)->paginate($per_page)
                            : $santri->orderBy($sort_by, $order_by)->paginate($per_page);

            $response = [
                'message'       => 'Santry Query Get Success',
                'status'        => 'success',
                'data'          => $data->items(),
                'page'          => $page,
                'per_page'      => $per_page,
                'sort_by'       => $sort_by,
                'order_by'      => $order_by,
                'total_data'    => $data->total(),
                'total_page'    => ceil($data->total() / $per_page)
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => null
            ]);
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
    public function store(SantriRequest $request)
    {
        try {
            if ($request->validator->fails()) {
                return response()->json([
                    'message'       => 'Validation Error',
                    'status'        => 'error',
                    'data'          => $request->validator->errors(),
                ], 400);
            }

            $data = $request->validated();

            $data = Santri::create($data);

            $response = [
                'message'       => 'New Santri Added Successfully',
                'status'        => 'success',
                'data'          => $data,
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => null
            ]);
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
        try {
            $data = Santri::findOrFail($id);

            $response = [
                'message'       => 'Get Data Santri Detail',
                'status'        => 'success',
                'data'          => $data,
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => null
            ]);
        }
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
    public function update(SantriRequest $request, $id)
    {
        try {
            if ($request->validator->fails()) {
                return response()->json([
                    'message'       => 'Validation Error',
                    'status'        => 'error',
                    'data'          => $request->validator->errors(),
                ], 400);
            }

            $data = $request->validated();
            $santri = Santri::findOrFail($id);
            $santri->update($data);

            $response = [
                'message'       => 'Data Santri Update Successfully',
                'status'        => 'success',
                'data'          => $santri,
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => null
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $santri = Santri::findOrFail($id);
            $santri->delete();

            $response = [
                'message'       => 'Data Santri Delete Successfully',
                'status'        => 'success',
            ];

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'       => 'Not Found',
                'status'        => 'error',
                'data'          => null
            ]);
        }
    }
}
