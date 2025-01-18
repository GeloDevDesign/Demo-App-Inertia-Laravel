<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Middleware\ThrottleRequests;

class CustomThrottleRequest extends ThrottleRequests
{
    protected function buildResponse($key, $maxAttempts)
    {
        $retryAfter = $this->getTimeUntilNextRetry($key);


        return response()->json([
            'limit_message' => 'Too many requests. Please try again in ' . $retryAfter . ' minutes.',
            'retry_after' => $retryAfter, // Include retry time explicitly
        ], Response::HTTP_TOO_MANY_REQUESTS);
    }
}
