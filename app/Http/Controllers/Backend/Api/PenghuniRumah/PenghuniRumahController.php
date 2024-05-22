<?php

namespace App\Http\Controllers\Backend\Api\PenghuniRumah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\PenghuniRumah\PenghuniRumahCreateRequest;
use App\Http\Requests\Backend\PenghuniRumah\PenghuniRumahUpdateRequest;
use App\Http\Resources\Backend\PenghuniRumah\PenghuniRumahResource;
use App\Models\PenghuniRumah;
use Illuminate\Http\JsonResponse;
use App\Models\Penghuni;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use DB;
class PenghuniRumahController extends Controller
{
    /**
     * Get Penghuni Rumah list
     *
     * @param PenghuniRumah $penghuniRumah
     *
     * @return JsonResponse
     */
    public function index(PenghuniRumah $penghuniRumah, Request $request)
    {
        $penghuniRumahs = $penghuniRumah::with(['penghuni', 'rumah'])
        ->when($request->has('id') , function ($query) use ($request){
            $query->where('id', request("id"));
        })->paginate($request->limit ?? "10");
        
        return PenghuniRumahResource::collection($penghuniRumahs);
    }

    /**
     * Create a penghuni Rumah
     *
     * @param PenghuniRumahCreateRequest $request
     * @param PenghuniRumah $penghuniRumah
     *
     * @return JsonResponse
     */
    public function store(PenghuniRumahCreateRequest $request, PenghuniRumah $penghuniRumah)
    {
        try {
            DB::beginTransaction();
            $storePenghuniRumah = $penghuniRumah::create($request->validated());
            DB::commit();
            return response()->json(new PenghuniRumahResource($storePenghuniRumah), HttpResponse::HTTP_CREATED);
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating account: error on database'], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating data: ' . $e->getMessage()], 404);
        }   
    }

    /**
     * Show a penghuni Rumah
     *
     * @param Request $request
     * @param PenghuniRumah  $penghuniRumah
     *
     * @return JsonResponse
     */
    public function show(Request $request, PenghuniRumah $penghuniRumah)
    {
        $getPenghuni = $penghuniRumah::with(['penghuni', 'rumah'])->get();
        return response()->json(new PenghuniRumahResource($getPenghuni), HttpResponse::HTTP_OK);
    }

    /**
     * Update a penghuni Rumah
     *
     * @param PenghuniUpdateRequest $request
     * @param PenghuniRumah         $penghuniRumah
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(PenghuniUpdateRequest $request, PenghuniRumah $penghuniRumah)
    {
        try {
            DB::beginTransaction();
            $penghuni->update([
                'penghuni_id' => $request->input('nama_lengkap'),
                'rumah_id' => $request->input('status_penghuni'),
                'tanggal_mulai_menempati' => $request->input('tanggal_mulai_menempati'),
                'tanggal_selesai_menempati' =>  $request->input('tanggal_selesai_menempati'),
            ]);
            DB:commit();
            return response()->json(new PenghuniRumahResource($penghuniRumah), HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating data: ' . $e->getMessage()], 404);
        }  catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating account: error on database'], 400);
        }
    }

    /**
     * Destroy a penghuni Rumah
     *
     * @param Request $request
     * @param PenghuniRumah $penghuniRumah
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, PenghuniRumah $penghuniRumah)
    {
        $penghuniRumah->delete();

        return response()->json([], HttpResponse::HTTP_NO_CONTENT);
    }
}
