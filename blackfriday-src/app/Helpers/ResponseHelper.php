<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

/**
 *
 */
class ResponseHelper extends Response
{
    /**
     * @param mixed $data
     * @param mixed $messages
     * @param int|null $code
     * @return JsonResponse
     */
    public function success(mixed $data = [], mixed $messages = [], ?int $code = 200): JsonResponse
    {
        $messages = is_array($messages) ? $messages : [$messages];

        return response()->json([
            'status' => true,
            'data' => $data ?? [],
            'messages' => $messages
        ], $code);
    }

    /**
     * @param mixed $messages
     * @param int|null $code
     * @return JsonResponse
     */
    public function error(mixed $messages, ?int $code = 422): JsonResponse
    {
        $rawMessages = [];
        $messages = is_array($messages) ? $messages : [$messages];

        foreach ($messages as $message) {
            if(is_array($message)) {
                $rawMessages = array_merge($rawMessages, $message);
            } else if($message instanceof MessageBag) {
                $rawMessages = array_merge($rawMessages, $message->all());
            } else {
                $rawMessages[] = $message;
            }
        }

        return response()->json([
            'status' => false,
            'data' => [],
            'messages' => $rawMessages
        ], $code);
    }

    /**
     * @param bool $status
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function translateMessage(bool $status, string $message, int $code = 500): JsonResponse
    {
        $splitMessage = explode('.', $message);
        if($splitMessage[0] != 'messages' && $splitMessage[0] != 'validation') {
            $message = 'messages.' . $message;
        }

        return response()->json([
            'status' => $status,
            'data' => [],
            'messages' => [trans($message)]
        ], $code);
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function rawSuccess(array $data): JsonResponse
    {
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     */
    public function notFound(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'data' => [],
            'messages' => ['Request not found!'],
        ], 404);
    }

    /**
     * @return JsonResponse
     */
    public function accessDenied(): JsonResponse
    {
        return response()->json([
            'status' => false,
            'data' => [],
            'messages' => ['Access denied!'],
        ], 403);
    }
}
