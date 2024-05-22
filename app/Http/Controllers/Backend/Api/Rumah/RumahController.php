<?php

namespace App\Http\Controllers\Backend\Api\Rumah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Rumah\RumahCreateRequest;
use App\Http\Requests\Backend\Rumah\RumahUpdateRequest;
use App\Http\Resources\Backend\Rumah\RumahResource;
use Illuminate\Http\JsonResponse;
use App\Models\Rumah;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use DB;


class RumahController extends Controller
{
    /**
     * Get Rumah list
     *
     * @param Rumah $rumah
     *
     * @return JsonResponse
     */
    public function index(Rumah $rumah): JsonResponse
    {
        $rumahs = $rumah::get();
        
        return response()->json(RumahResource::collection($rumahs), HttpResponse::HTTP_OK);
    }

    /**
     * Create a rumah
     *
     * @param RumahCreateRequest $request
     * @param Rumah $rumah
     *
     * @return JsonResponse
     */
    public function store(RumahCreateRequest $request, Rumah $rumah)
    {
        try {
            DB::beginTransaction();
            $storeRumah = $rumah::create($request->validated());
            DB::commit();
            return response()->json(new RumahResource($storeRumah), HttpResponse::HTTP_CREATED);
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating account: error on database'], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating data: ' . $e->getMessage()], 404);
        }   
    }

    /**
     * Show a debit card
     *
     * @param Request $request
     * @param Rumah $rumah
     *
     * @return JsonResponse
     */
    public function show(Request $request, Rumah $rumah)
    {
        return response()->json(new RumahResource($rumah), HttpResponse::HTTP_OK);
    }

    /**
     * Update a debit card
     *
     * @param RumahUpdateRequest $request
     * @param Rumah              $rumah
     *
     * @return JsonResponse
     */
    public function update(Request $request, Rumah $rumah)
    {
        try {
            DB::beginTransaction();
            $rumah->update([
                'nomor_rumah' => $request->input('nomor_rumah'),
                'status_rumah' => $request->input('status_rumah'),
            ]);
            DB::commit();
            return response()->json(new RumahResource($rumah), HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating data: ' . $e->getMessage()], 404);
        }  catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating account: error on database'], 400);
        }
    }

    /**
     * Destroy a rumah
     *
     * @param Request $request
     * @param Rumah $rumah
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Rumah $rumah)
    {
        $rumah->delete();

        return response()->json([], HttpResponse::HTTP_NO_CONTENT);
    }

}
