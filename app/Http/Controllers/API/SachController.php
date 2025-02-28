<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocGia;
use App\Models\Sach;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $sach = Sach::all();
        return response()->json($sach);
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
            // Validate the request data
            $request->validate([
                'ten_sach' => 'required|string|max:255',
                'the_loai' => 'required|string|max:1',
                'tac_gia' => 'required|string|max:255',
                'nam_xuat_ban' => 'nullable|integer',
                'nha_xuat_ban' => 'nullable|string|max:255',
                'ngay_nhap' => 'nullable|date',
                'gia' => 'nullable|numeric',
            ]);

            // Create a new DocGia instance and save it to the database
            $sach = Sach::create($request->all());

            return response()->json($sach, 201); // 201 Created status code
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
        $sach = Sach::findOrFail($id);
        return response()->json($sach);
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
        $sach = Sach::findOrFail($id);

        $request->validate([
            'ten_sach' => 'required|string|max:255',
            'the_loai' => 'required|string|max:1',
            'tac_gia' => 'required|string|max:255',
            'nam_xuat_ban' => 'nullable|integer',
            'nha_xuat_ban' => 'nullable|string|max:255',
            'ngay_nhap' => 'nullable|date',
            'gia' => 'nullable|numeric',
        ]);

        $sach->update($request->all());

        return response()->json($sach);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $sach = Sach::findOrFail($id);
        $sach->delete();

        return response()->json(null, 204);
    }

    /**
     * Search for books by title, author, or category.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $query = Sach::query();

        if ($request->has('ten_sach')) {
            $query->where('ten_sach', 'like', '%' . $request->input('ten_sach') . '%');
        }

        if ($request->has('tac_gia')) {
            $query->where('tac_gia', 'like', '%' . $request->input('tac_gia') . '%');
        }

        if ($request->has('the_loai')) {
            $query->where('the_loai', $request->input('the_loai'));
        }

        $sach = $query->get();

        return response()->json($sach);
    }
}
