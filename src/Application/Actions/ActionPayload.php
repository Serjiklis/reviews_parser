<?php
declare(strict_types=1);

namespace App\Application\Actions;

use JsonSerializable;

/**
 * @OA\Info(title="Review Parse", version="CS-1.0"),
 *  @SWG\SecurityScheme(
  *      securityDefinition="apiKeyAuth",
  *      type="apiKey",
  *      in="header",
  *      name="Authorization"
  *  ),

    * security = {{"apiKeyAuth": {}}}
  */
class ActionPayload implements JsonSerializable
{

    const API_VERSION="RP-1.0";
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var string
     */
    private $apiVersion;

    /**
     * @var ActionError|null
     */
    private $error;

    /**
     * @param int                   $statusCode
     * @param mixed     $data
     * @param ActionError|null      $error
     */
    public function __construct(
        int $statusCode = 200,
        $data = null,
        ?ActionError $error = null
    ) {
        $this->statusCode = $statusCode;
        $this->data = $data;
        $this->error = $error;
        $this->apiVersion = self::API_VERSION;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return ActionError|null
     */
    public function getError(): ?ActionError
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * @return mixed
     *
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $payload = [
            'statusCode' => $this->statusCode,
            'apiVersion' => $this->apiVersion
        ];

        if ($this->data !== null) {
            $payload['data'] = $this->data;
        } elseif ($this->error !== null) {
            $payload['error'] = $this->error;
        }

        return $payload;
    }
}
