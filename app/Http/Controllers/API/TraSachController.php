<?php

namespace App\Http\Controllers\API;

use App\Models\TraSach;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TraSachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (Auth::check()) {
            $traSach = TraSach::with(['docGia', 'sach'])->get();
            return response()->json($traSach);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        if (Auth::check()) {
            $request->validate([
                'id_doc_gia' => 'required|integer|exists:doc_gia,ID',
                'ngay_tra' => 'required|date',
                'ma_sach' => 'required|integer|exists:sach,ID',
                'ngay_muon' => 'required|date',
                'so_ngay_muon' => 'required|integer',
                'tien_phat' => 'nullable|numeric',
                'tong_no' => 'nullable|numeric',
            ]);

            $traSach = TraSach::create($request->all());

            return response()->json($traSach, 201);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        if (Auth::check()) {
            $traSach = TraSach::with(['docGia', 'sach'])->findOrFail($id);
            return response()->json($traSach);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        if (Auth::check()) {
            $traSach = TraSach::findOrFail($id);

            $request->validate([
                'id_doc_gia' => 'required|integer|exists:doc_gia,ID',
                'ngay_tra' => 'required|date',
                'ma_sach' => 'required|integer|exists:sach,ID',
                'ngay_muon' => 'required|date',
                'so_ngay_muon' => 'required|integer',
                'tien_phat' => 'nullable|numeric',
                'tong_no' => 'nullable|numeric',
            ]);

            $traSach->update($request->all());

            return response()->json($traSach);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if (Auth::check()) {
            $traSach = TraSach::findOrFail($id);
            $traSach->delete();

            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
