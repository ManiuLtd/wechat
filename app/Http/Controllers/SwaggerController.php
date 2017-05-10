<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Swagger\Annotations as SWG;
use App\Http\Requests;


/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="localhost:8000/api",
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0",
 *         title="量炫流量项目api文档",
 *         description="",
 *         termsOfService="",
 *     ),
 * )
 */

class SwaggerController extends Controller
{
    public function doc()
    {
        $swagger = \Swagger\scan(realpath(__DIR__.'/../../'));
        return response()->json($swagger);
    }
}
