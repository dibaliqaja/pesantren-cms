<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Syahriah;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class SyahriahController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_history(Request $request)
    {
        try {
            $user      = User::findOrFail(auth()->id());
            $per_page  = $request->per_page ? $request->per_page : 10;
            $page      = $request->page ? $request->page : 1;
            $search    = $request->search;
            $syahriah  = Syahriah::query();
            $data      = $search
                            ? $syahriah->where('santri_id', $user->santri_id)
                                ->where('date', 'LIKE', "%$search%")
                                ->orWhere('month', 'LIKE', "%$search%")
                                ->orWhere('year', 'LIKE', "%$search%")
                                ->orderBy('date', 'DESC')
                                ->orderBy('created_at', 'DESC')
                                ->paginate($per_page)
                            : $syahriah->where('santri_id', $user->santri_id)
                                ->orderBy('date', 'DESC')
                                ->orderBy('created_at', 'DESC')
                                ->paginate($per_page);
      
            $response = [
                'status'     => 'success',
                'message'    => 'Syahriah query get success',
                'data'       => $data->items(),
                'page'       => $page,
                'per_page'   => $per_page,
                'total_data' => $data->total(),
                'total_page' => ceil($data->total() / $per_page)
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()                
            ], 500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_spp(Request $request)
    {
        try {
            $now  = (int) date('Y');
            $user = User::findOrFail(auth()->id());
            $search = $request->search;
                         
            $jan = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Jan'
                ])->first();

            $feb = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Feb'
                ])->first();
            $mar = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Mar'
                ])->first();
            $apr = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Apr'
                ])->first();
            $may = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'May'
                ])->first();
            $jun = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Jun'
                ])->first();
            $jul = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Jul'
                ])->first();
            $aug = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Aug'
                ])->first();
            $sep = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Sep'
                ])->first();
            $oct = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Oct'
                ])->first();
            $nov = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Nov'
                ])->first();
            $dec = Syahriah::select('date', 'month', 'year', 'spp')
                ->where([
                    'santri_id' => $user->santri_id,
                    'year' => $search ? intval($search) : $now,
                    'month' => 'Dec'
                ])->first();

            $data = [
                'jan' => $jan,
                'feb' => $feb,
                'mar' => $mar,
                'apr' => $apr,
                'may' => $may,
                'jun' => $jun,
                'jul' => $jul,
                'aug' => $aug,
                'sep' => $sep,
                'oct' => $oct,
                'nov' => $nov,
                'dec' => $dec
            ];

            $response = [
                'status'     => 'success',
                'message'    => 'Syahriah (SPP) query get success',
                'year'       => $search ? intval($search) : $now,
                'data'       => $data
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()                
            ], 500);
        }
    }
}
