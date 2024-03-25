<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreleaveRequestRequest;
use App\Http\Requests\UpdateleaveRequestRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LeaveRequest::query();
    
        if($request->has('sortBy') && $request->has('sortOrder')) {
            $query->orderBy($request->sortBy, $request->sortOrder);
        }

        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('user_id', 'LIKE', "%{$keyword}%")
                  ->orWhere('leave_type', 'LIKE', "%{$keyword}%");
            });
        }
    
        if ($request->has(['start_date_from', 'start_date_to'])) {
            $query->whereBetween('start_date', [$request->start_date_from, $request->start_date_to]);
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        $perPage = $request->get('perPage', 15);
        return $query->paginate($perPage);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreleaveRequestRequest $request)
    {
        $validated = $request->validated();

        $overlap = $this->checkForOverlap($request);

        if ($overlap) {
            return response()->json(
                ['message' => 'There is an existing leave request within the specified dates.'], 409
            );
        }

        $leaveRequest = LeaveRequest::create($request->all());

        return response()->json($leaveRequest, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(LeaveRequest $leaveRequest)
    {
        $leaveRequest = LeaveRequest::find($leaveRequest);

        return response()->json($leaveRequest, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveRequest $leaveRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateleaveRequestRequest $request, LeaveRequest $leaveRequest)
    {
        $leaveRequest->update($request->all());

        return response()->json($leaveRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return response()->json('Leave request deleted', 204);
    }

    public function CreateTestBatch(Request $request)
    {
        Log::debug($request->all());
        if ($request->has('amount')) {
            $leaveRequest = tap($request->only('amount'),  function ($amount) {
                return LeaveRequest::factory()
                    ->count($amount['amount'])
                    ->create();
            });

            return response()->json($leaveRequest, 201);
        }

        if ($request->has('clearAll')) {
            LeaveRequest::truncate();
            return response()->json('All leave requests deleted', 204);
        }
    }

    private function checkForOverlap($request)
    {
        $overlap = LeaveRequest::where('user_id', $request->user_id)
        ->where(function($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                  ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
        })->exists();

        return $overlap;
    }
}
