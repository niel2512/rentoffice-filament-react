<?php

namespace App\Http\Controllers\Api;

use App\Models\OfficeSpace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfficeSpaceResource;

class OfficeSpaceController extends Controller
{
    public function index()
    {
        // Get all office spaces with their cities and photos
        $officeSpaces = OfficeSpace::with(['city'])->get();
        // Return the office spaces as a resource collection
        return OfficeSpaceResource::collection($officeSpaces);
    }

    public function show(OfficeSpace $officeSpace)
    {
        // Load the city and photos for the specific office space
        $officeSpace->load(['city', 'photos', 'benefits']);
        // Return the office space as a resource
        return new OfficeSpaceResource($officeSpace);
    }
}
