<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocGia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DocGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $docGia = DocGia::all();
            return response()->json($docGia);
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
        // Check if the user is authenticated
        if (Auth::check()) {
            // Validate the request data
            $request->validate([
                'ho_va_ten' => 'required|string|max:255',
                'loai_doc_gia' => 'required|string|max:1',
                'ngay_sinh' => 'nullable|date',
                'dia_chi' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'ngay_lap_the' => 'nullable|date_format:Y-m-d H:i:s',
            ]);

            // Create a new DocGia instance and save it to the database
            $docGia = DocGia::create($request->all());

            return response()->json($docGia, 201); // 201 Created status code
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
        // Check if the user is authenticated
        if (Auth::check()) {
            $docGia = DocGia::findOrFail($id); // Find or throw a 404 error
            return response()->json($docGia);
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
        // Check if the user is authenticated
        if (Auth::check()) {
            // Validate the request data
            $request->validate([
                'ho_va_ten' => 'required|string|max:255',
                'loai_doc_gia' => 'required|string|max:1',
                'ngay_sinh' => 'nullable|date',
                'dia_chi' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'ngay_lap_the' => 'nullable|date',
            ]);

            $docGia = DocGia::findOrFail($id);
            $docGia->update($request->all());

            return response()->json($docGia);
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
        // Check if the user is authenticated
        if (Auth::check()) {
            $docGia = DocGia::findOrFail($id);
            $docGia->delete();

            return response()->json(['message' => 'Done'], 204); // 204 No Content status code
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    /**
     * Search for DocGia by ho_va_ten or email.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $query = DocGia::query();

            if ($request->has('ho_va_ten')) {
                $query->where('ho_va_ten', 'like', '%' . $request->input('ho_va_ten') . '%');
            }

            if ($request->has('email')) {
                $query->where('email', 'like', '%' . $request->input('email') . '%');
            }

            $docGia = $query->get();

            return response()->json($docGia);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
