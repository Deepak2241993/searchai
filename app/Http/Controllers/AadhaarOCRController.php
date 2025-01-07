<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GridlinesService;
use App\Exceptions\GridlinesApiException;
use Illuminate\Support\Facades\Log;

class AadhaarOCRController extends Controller
{
    protected $gridlinesService;

    public function __construct(GridlinesService $gridlinesService)
    {
        $this->gridlinesService = $gridlinesService;
    }

    public function performOCR(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'base64_data' => 'required|string',
        ]);

        try {
            // Call the Gridlines service to perform OCR
            $data = $this->gridlinesService->performOCR($request->input('base64_data'));

            // Return successful response
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (GridlinesApiException $e) {
            // Log the error details for debugging
            Log::error('Gridlines API Error', [
                'message' => $e->getMessage(),
                'error_data' => $e->getErrorData(),
            ]);

            // Return error response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => $e->getErrorData(),
            ], 500);
        } catch (\Exception $e) {
            // Log unexpected exceptions
            Log::critical('Unexpected Error in AadhaarOCRController', [
                'message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
