<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @group User Information
 * @groupDescription Endpoints for retrieving user profile information including email, datetime and GitHub details
 */
class ApiController extends Controller
{
    /**
     * Get User Info
     *
     * Returns user information including email, current datetime and GitHub URL.
     *
     * @responseField email string The user's email address. Example: idehendivine16@gmail.com
     * @responseField current_datetime string Current date and time in ISO8601 format. Example: 2023-09-14T12:00:00+00:00
     * @responseField github_url string URL to the GitHub repository. Example: https://github.com/idehen-divine/HNG12
     *
     * @response 200 scenario=success {
     *     "email": "idehendivine16@gmail.com",
     *     "current_datetime": "2023-09-14T12:00:00+00:00",
     *     "github_url": "https://github.com/idehen-divine/HNG12"
     * }
     * @response 404 scenario=not_found {
     *     "message": "Resource not found"
     * }
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'email' => 'idehendivine16@gmail.com',
            'current_datetime' => now()->toIso8601String(),
            'github_url' => 'https://github.com/idehen-divine/HNG12',
        ]);
    }
}
