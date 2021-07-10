<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;

use App\Models\Cost;
use App\Models\Santri;
use App\Models\Syahriah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Helpers\ActivityLog;
use App\Models\CashBook;
use App\Models\User;

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
    public function index(Request $request)
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
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Not Found',
                'data'    => null
            ]);
        }
    }
}
