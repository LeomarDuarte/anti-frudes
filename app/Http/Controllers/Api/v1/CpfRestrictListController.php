<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;

use App\Repositories\Contracts\CpfRestrictListRepositoryInterface;

class CpfRestrictListController extends Controller
{
    private $cpfRestrictListRepository;

    public function __construct(CpfRestrictListRepositoryInterface $cpfRestrictListRepository)
    {
        $this->cpfRestrictListRepository = $cpfRestrictListRepository;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json(['Content' => $this->cpfRestrictListRepository->findAll()], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['erro' => 'Internal server erro.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $cpf): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json(['Content' => $this->cpfRestrictListRepository->check($cpf)], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['erro' => 'Internal server erro.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json(['Content' => $this->cpfRestrictListRepository->add($request->cpf)], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
            return response()->json(['erro' => 'Internal server erro.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(string $cpf): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json($this->cpfRestrictListRepository->remove($cpf), Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['erro' => 'Internal server erro.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}