<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SuspiciousReport;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuspiciousReportController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.suspiciousReport.index';
        $this->baseRoute = 'suspiciousReport.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $suspiciousReports = SuspiciousReport::withTrashed()->with(['user', 'product']);
            return DataTables::eloquent($suspiciousReports)
                ->addIndexColumn()
                ->editColumn('product', function (SuspiciousReport $suspiciousReport) {
                    return '<a href="' . route('products.show', [$suspiciousReport->product_id]) . '" target="_blank">' . $suspiciousReport->product->name . '</a>';
                })
                ->editColumn('user', function (SuspiciousReport $suspiciousReport) {
                    return $suspiciousReport->user->getFullName();
                })
                ->editColumn('responded_text', function (SuspiciousReport $suspiciousReport) {
                    if (is_null($suspiciousReport->responded_text)) {
                        return '<a href="javascript:void(0)" onclick="reportDialog(' . $suspiciousReport->id . ')">Respond Back</a>';
                    } else {
                        return $suspiciousReport->responded_text;
                    }
                })
                ->addColumn('actions', function (SuspiciousReport $suspiciousReport) {
                    return view('admin.suspiciousReport.actions', compact('suspiciousReport'))->render();
                })
                ->rawColumns(['user', 'product', 'responded_text', 'actions'])
                ->toJson();
        }
        return view($this->view);
    }

    public function destroy(SuspiciousReport $suspiciousReport)
    {
        if (request()->ajax()) {
            if (isset($suspiciousReport) && !empty($suspiciousReport)) {
                if ($suspiciousReport->delete()) {
                    return response()->json(['success' => true, 'message' => 'Suspicious Report deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $suspiciousReport = SuspiciousReport::withTrashed()->where('id', $id)->first();
            if (isset($suspiciousReport) && !empty($suspiciousReport)) {
                if ($suspiciousReport->restore()) {
                    return response()->json(['success' => true, 'message' => 'Suspicious Report restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $suspiciousReport = SuspiciousReport::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($suspiciousReport->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Suspicious Report deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function respondBack(Request $request, SuspiciousReport $suspiciousReport)
    {
        $data = $request->only('responded_text');
        $suspiciousReport->update($data);
        return redirect()->back();
    }

}
