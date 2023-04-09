<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'company_id' => 'required|string',
        ]);

        $setArray = $request->toArray();
        $setArray['password'] = 'not_set';
        $user = User::create($setArray);

        return new JsonResponse([
            'message' => 'success',
            'data' => $user,
        ]);
    }

    public function find(string $id): JsonResponse
    {
        $client = User::find($id);

        return new JsonResponse([
            'message' => 'success',
            'data' => $client,
        ]);
    }

    public function delete(string $id): JsonResponse
    {
        User::destroy([$id]);

        return new JsonResponse([
            'message' => 'success'
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|string',
            'company_id' => 'required|string',
        ]);

        $client = User::find($id);
        $client->update($request->toArray());

        return new JsonResponse([
            'message' => 'success',
        ]);
    }

    public function listAll(Request $request): JsonResponse
    {
        $user = Auth::user()->toArray();
        $users = User::query()->with('company');

        if ($request->query->get('company_id')) {
            $users->where('company_id', $user['company_id']);
        }

        if ($request->query->get('name')) {
            $users->where('name', 'LIKE', "%" . $request->query->get('name') . "%");
        }

        $users = $users->get()->toArray();

        return new JsonResponse([
            'message' => 'success',
            'data' => $users,
        ]);
    }
}
