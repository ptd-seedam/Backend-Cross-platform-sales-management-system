<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="Seedam API Docs",
 *     version="1.0.0",
 *     description="Tài liệu API cho nền tảng Seedam",
 *
 *     @OA\Contact(
 *         email="support@seedam.vn"
 *     ),
 *
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 */
class SwaggerController extends Controller
{
    // Controller không cần chứa code
}
