<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'user_role' => 'required|string',
            'company_id' => 'string',
        ]);

        $setArray = $request->toArray();
        $setArray['password'] = Hash::make('defaultPassword');
        if (!$request['company_id'] && in_array($request['user_role'], ['super_admin', 'admin'])) {
            $setArray['company_id'] = 'super_admin';
        }
        $user = User::create($setArray);

        if ($user->user_role === 'teacher') {
            $teacher = $user->toArray();
            $teacher['start_date'] = Carbon::now()->format('Y-m-d');
            Teacher::create($teacher);
        }

        return new JsonResponse([
            'message' => 'success',
            'data' => $user,
        ]);
    }

    public function find(string $id): JsonResponse
    {
        $client = User::find($id);
        if (null === $client) {
            throw new \App\Exceptions\EntityNotFoundException('User');
        }

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

    public function updatePassword(Request $request, string $id): JsonResponse
    {
        $this->validate($request, [
            'password' => 'required|string',
        ]);
        /** @var User $user */
        $user = User::find($id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return response()->json([]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|string',
            'company_id' => 'required|string',
        ]);

        $client = User::find($id);
        if (null === $client) {
            throw new \App\Exceptions\EntityNotFoundException('User');
        }
        $client->update($request->toArray());

        return new JsonResponse([
            'message' => 'success',
        ]);
    }

    public function listAll(Request $request): JsonResponse
    {
        $user = Auth::user()->toArray();
        $users = User::query()->with('company');

        if (!in_array($user['user_role'], ['super_admin', 'admin'])) {
            $users->where('company_id', $user['company_id']);
        }

        if ($request->query->get('company_id')) {
            $users->where('company_id', $request->query->get('company_id'));
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
