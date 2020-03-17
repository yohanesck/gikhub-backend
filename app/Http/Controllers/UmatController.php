<?php

namespace App\Http\Controllers;

use App\Exceptions\ForbiddenException;
use App\Exceptions\NIKNotMatchException;
use App\Http\Requests\ValidateNIKMatching;
use App\Http\Requests\ValidateUmatInsert;
use App\Http\Requests\ValidateUmatUpdate;
use App\Models\Umat;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UmatController extends Controller
{
    private $umat;
    private $user;

    public function __construct(Umat $umat, User $user)
    {
        $this->umat = $umat;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidateUmatInsert $request
     * @return false|string
     */
    public function store(ValidateUmatInsert $request)
    {
        $result = DB::transaction(function () use ($request) {
            $this->umat->insert($this->umat->prepareData($request->validated(), $this->umat->handleUploadedImages($request->file())));
            is_null(auth()->user()) ? : auth()->user()->update(['nik' => $request['umat_ktp']]);
            $this->umat->find($request['umat_ktp'])->sendNotificationEmail();
            return true;
        });

        return response()->json([
            'result' => $result
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Umat $umat
     * @return Response
     * @throws ForbiddenException
     */
    public function show(Umat $umat)
    {
        if ($umat->umat_ktp == auth()->user()->nik)
            return response()->json([
               'result' => $umat->data()->find("$umat->umat_ktp")
            ], 200);

        throw new ForbiddenException();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ValidateUmatUpdate $request
     * @param Umat $umat
     * @return void
     * @throws ForbiddenException
     */
    public function update(ValidateUmatUpdate $request, Umat $umat)
    {
        if ($umat->umat_ktp == auth()->user()->nik) {
            $result = DB::transaction(function () use ($request, $umat) {
                is_null(auth()->user()) ? : auth()->user()
                    ->update([
                        'nik' => $request['umat_ktp'],
                        'nama' => $request['umat_nama'],
                        'email' => $request['umat_email'],
                        'nomor_telepon' => $request['umat_handphone']
                    ]);
                $umat->update($umat->handlePhotoMove());
                $umat->update($umat->prepareData($request->validated(), $umat->handleUploadedImages($request->file())));
                $umat->sendNotificationEmail();
                return true;
            });

            return response()->json([
                'result' => $result
            ], 200);
        }
        throw new ForbiddenException();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @return JsonResponse
     */
    public function sendHelpRequest()
    {
        return response()->json([
            'message' => is_null($this->user->find(auth()->id())->sendHelpUpdateEmail()) ? 'true' : ''
        ], 200);
    }

    /**
     * @param ValidateNIKMatching $request
     * @param Umat|null $umat
     * @return JsonResponse
     * @throws ForbiddenException
     */
    public function nikVerification(ValidateNIKMatching $request, Umat $umat = null)
    {
        if ($this->updateUserNIK($this->umat->handleNIKVerification($request, $umat)))
            return response()->json([
                'result' => 'true'
            ],200);

        throw new ForbiddenException();
    }

    /**
     * @param null $data
     * @return bool
     */
    public function updateUserNIK($data = null)
    {
        if (!is_null($data)) {
            auth()->user()->update([
                'nik' => "$data->umat_ktp",
                'nama' => "$data->umat_nama",
                'email' => "$data->umat_email",
                'nomor_telepon' => "$data->umat_handphone"
            ]);
            return true;
        } else return false;
    }
}
