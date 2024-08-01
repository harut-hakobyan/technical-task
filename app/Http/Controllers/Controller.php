<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller {
    public function respond(mixed $data = [], int $status = 200): JsonResponse {
        return response()->json($data, $status);
    }

    public function respondError(string $message, int $status = 400, ?string $field = null): JsonResponse {
        $data = compact('message');

        if ($field) {
            $data['errors'] = [$field => [$message]];
        }

        return response()->json($data, $status);
    }
}
