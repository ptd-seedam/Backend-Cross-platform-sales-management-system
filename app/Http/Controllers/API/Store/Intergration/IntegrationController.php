<?php

namespace App\Http\Controllers\Api\Integration;

use App\Http\Controllers\API\BaseController;
use App\Services\IntegrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntegrationController extends BaseController
{
    protected $integrationService;

    public function __construct(IntegrationService $integrationService)
    {
        $this->integrationService = $integrationService;
    }

    public function index()
    {
        $userId = Auth::id();

        return response()->json($this->integrationService->getUserIntegrations($userId));
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|in:shopee,tiktok',
            'shop_name' => 'required|string',
            'access_token' => 'required|string',
            'refresh_token' => 'nullable|string',
            'token_expires_at' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        $integration = $this->integrationService->connect($data);

        return response()->json($integration, 201);
    }

    public function destroy($id)
    {
        $deleted = $this->integrationService->disconnect($id, Auth::id());

        if ($deleted) {
            return response()->json(['message' => 'Xóa thành công']);
        }

        return response()->json(['message' => 'Không tìm thấy hoặc không có quyền'], 404);
    }
}
