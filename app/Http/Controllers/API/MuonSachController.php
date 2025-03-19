<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MuonSach;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MuonSachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (Auth::check()) {
            $muonSach = MuonSach::with(['docGia', 'sach'])->get();
            return response()->json($muonSach);
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
                'ngay_muon' => 'required|date',
                'ma_sach' => 'required|integer|exists:sach,ID',
            ]);

            $muonSach = MuonSach::create($request->all());

            return response()->json($muonSach, 201);
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
            $muonSach = MuonSach::with(['docGia', 'sach'])->findOrFail($id);
            return response()->json($muonSach);
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
            $muonSach = MuonSach::findOrFail($id);

            $request->validate([
                'id_doc_gia' => 'required|integer|exists:doc_gia,ID',
                'ngay_muon' => 'required|date',
                'ma_sach' => 'required|integer|exists:sach,ID',
            ]);

            $muonSach->update($request->all());

            return response()->json($muonSach, 201);
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
            $muonSach = MuonSach::findOrFail($id);
            $muonSach->delete();

            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
