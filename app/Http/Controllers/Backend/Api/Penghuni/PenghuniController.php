<?php

namespace App\Http\Controllers\Backend\Api\Penghuni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Penghuni\PenghuniCreateRequest;
use App\Http\Requests\Backend\Penghuni\PenghuniUpdateRequest;
use App\Http\Resources\Backend\Penghuni\PenghuniResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use App\Models\Penghuni;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use DB;

class PenghuniController extends Controller
{
   /**
     * Get Penghuni list
     *
     * @param Penghuni $penghuni
     *
     * @return JsonResponse
     */
    public function index(Penghuni $penghuni): JsonResponse
    {
        $penghunis = $penghuni::get();

        return response()->json(PenghuniResource::collection($penghunis), HttpResponse::HTTP_OK);
    }

    /**
     * Create a penghuni
     *
     * @param PenghuniCreateRequest $request
     * @param Penghuni $penghuni
     *
     * @return JsonResponse
     */
    public function store(PenghuniCreateRequest $request, Penghuni $penghuni)
    {
        try {
            $request->validate(['foto_ktp' => 'required|file|max:500']);
            $path = null;
            if ($request->hasFile('foto_ktp')) {
                $files = $request->file('foto_ktp');
                $ext = $files->extension();
                $imgName = date('dmyHis'). '.' .$ext;
                $path = Storage::putFileAs('public/images', $request->file('foto_ktp'), $imgName);
            }
            DB::beginTransaction();
            $storePenghuni = $penghuni::create(
                array_merge($request->validated(), ['foto_ktp' => $path])
            );
            
            DB::commit();
            return response()->json(new PenghuniResource($storePenghuni), HttpResponse::HTTP_CREATED);
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating account: error on database'], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating data: ' . $e->getMessage()], 404);
        }   
    }

    /**
     * Show a penghunis
     *
     * @param Request $request
     * @param Penghuni              $penghuni
     *
     * @return JsonResponse
     */
    public function show(Request $request, Penghuni $penghuni)
    {
        return response()->json(new PenghuniResource($penghuni), HttpResponse::HTTP_OK);
    }

    /**
     * Update a penghunis 
     *
     * @param PenghuniUpdateRequest $request
     * @param Penghuni              $penghuni
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(Request $request, Penghuni $penghuni)
    {
        try {
            dd($request);
            DB::beginTransaction();
            if ($request->hasFile('foto_ktp')) {
                $files = $request->file('foto_ktp');
                $ext = $files->extension();
                $imgName = date('dmyHis'). '.' .$ext;
                // $request->validate($request, ['foto_ktp' => 'required|file|max:500']);
                Storage::delete($penghuni->foto_ktp);
                $path = Storage::putFileAs('public/images', $request->file('foto_ktp'), $imgName);
                $penghuni->update([
                    'foto_ktp' => $path,
                ]);
            } else {
                $penghuni->update([
                    'nama_lengkap' => $request->input('nama_lengkap'),
                    'status_penghuni' => $request->input('status_penghuni'),
                    'nomor_telepon' => $request->input('nomor_telepon'),
                    'sudah_menikah' => (boolean) $request->input('sudah_menikah'),
                ]);
            }
            DB::commit();
            return response()->json(new PenghuniResource($penghuni), HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating data: ' . $e->getMessage()], 404);
        }  catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating account: error on database'], 400);
        }
    }

    /**
     * Destroy a penghuni
     *
     * @param Request $request
     * @param Penghuni $penghuni
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Penghuni $penghuni)
    {
        $penghuni->delete();

        return response()->json([], HttpResponse::HTTP_NO_CONTENT);
    }
}
