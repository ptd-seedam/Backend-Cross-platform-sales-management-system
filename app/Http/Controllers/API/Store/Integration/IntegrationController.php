<?php

namespace App\Http\Controllers\Api\Store\Integration;

use App\Http\Controllers\API\BaseController;
use App\Services\Integration\IntegrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(
 *     name="Integration",
 *     description="API cho đồng bộ Shopee / TikTokShop"
 * )
 */
class IntegrationController extends BaseController
{
    protected $integrationService;

    public function __construct(IntegrationService $integrationService)
    {
        $this->integrationService = $integrationService;
    }

    /**
     * @OA\Get(
     *     path="/api/store/integration",
     *     tags={"Integration"},
     *     summary="Lấy danh sách tài khoản tích hợp",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Thành công"
     *     )
     * )
     */
    public function index()
    {
        $userId = Auth::id();

        return $this->sendResponse($this->integrationService->getUserIntegrations($userId), 'Integrations retrieved successfully.');
    }

    /**
     * @OA\Post(
     *     path="/api/store/integration",
     *     tags={"Integration"},
     *     summary="Tạo mới tài khoản tích hợp",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"platform", "shop_name", "access_token"},
     *
     *             @OA\Property(property="platform", type="string", example="shopee"),
     *             @OA\Property(property="shop_name", type="string", example="Shop Seeda"),
     *             @OA\Property(property="access_token", type="string", example="abc123"),
     *             @OA\Property(property="refresh_token", type="string", example="xyz456"),
     *             @OA\Property(property="token_expires_at", type="string", format="date-time", example="2025-05-01T00:00:00Z")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Tạo thành công"
     *     )
     * )
     */
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

        return $this->sendResponse($integration, 'Integration created successfully.');
    }

    /**
     * @OA\Delete(
     *     path="/api/store/integration/{id}",
     *     tags={"Integration"},
     *     summary="Xoá tích hợp",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID của tài khoản tích hợp",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Xoá thành công"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Không tìm thấy"
     *     )
     * )
     */
    public function destroy($id)
    {
        $deleted = $this->integrationService->disconnect($id, Auth::id());

        if ($deleted) {
            return $this->sendResponse([], 'Integration deleted successfully.');
        }

        return $this->sendError('Integration not found or unauthorized.', [], 404);
    }
}
