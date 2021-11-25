<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'status' => $this->resource['status'],
            'error' => [
                'code' => $this->resource['status'],
                'message' => $this->resource['message'],
            ],
            'debug' => $this->when($this->resource['debug'], function () {
                $debug = $this->resource['debug'];
                return [
                        'extraMessage' => $debug['extraMessage'],
                        'file' => $debug['file'],
                        'line' => $debug['line'],
                        'trace' => $debug['trace'],
                    ];
            }),
        ];
    }

}
