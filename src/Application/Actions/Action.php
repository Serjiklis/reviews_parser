<?php
declare(strict_types=1);

namespace App\Application\Actions;

use App\Application\Providers\CompanionServiceAPISecurity\IRequestSecurityProvider;
use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

abstract class Action
{
    /**
     * @var LoggerInterface
     */
    protected $logger;


    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array<mixed>
     */
    protected $args;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array<mixed>    $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        if(!$this->requestValidates($request))
            return $this->respondWithError("Denied","Access denied",401);


        try {
            return $this->action();
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    abstract protected function action(): Response;

    /**
     * @return mixed
     * @throws HttpBadRequestException
     */
    protected function getFormData()
    {
        $inputContents = file_get_contents('php://input');
        if($inputContents===false)
            throw new \Exception("Could not open contents");
        $input = json_decode($inputContents);
        if($input===false)
            throw new \Exception("Could not decode JSON");
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    /**
     * @param  string $name
     * @return mixed
     * @throws HttpBadRequestException
     */
    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }
    /**
     * @param  string $name
     * @return mixed
     */
    protected function tryResolveArg(string $name)
    {
        try
        {
            $result = $this->resolveArg($name);
            return $result;
        }
        catch(HttpBadRequestException $ex)
        {
            return "";
        }
    }

    /**
     * @param mixed $data
     * @return Response
     */
    protected function respondWithData($data = null, int $statusCode = 200): Response
    {
        $payload = new ActionPayload($statusCode, $data);

        return $this->respond($payload);
    }

    /**
     * @param string $errorTypeString
     * @param string $errorDescriptionString
     * @param  int $statusCode
     * @return Response
     */
    protected function respondWithError($errorTypeString = null, $errorDescriptionString = null,int $statusCode = 400): Response
    {
        $ActionError = new ActionError($errorTypeString, $errorDescriptionString);
        $payload = new ActionPayload($statusCode, null, $ActionError);

        return $this->respond($payload);
    }

    /**
     * @param ActionPayload $payload
     * @return Response
     */
    protected function respond(ActionPayload $payload): Response
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        if($json===false)
            throw new \Exception("Could not decode JSON");

        $this->response->getBody()->write($json);

        return $this->response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus($payload->getStatusCode());
    }

    /**
     * @return bool
     */
    protected function requestValidates(Request $request) : bool
    {
        $uri = $request->getUri();

        // If it's a health check or stripe webhook, pass it
        $path = $uri->getPath();
        if($path=="/" || $path=="" || $path=="/webhook" || $path=="webhook")
            return true; 

        //return $this->RequestSecurityProvider->passesValidation($request);
        return true;
    }

    /**
     * @return array<string>
     */
    protected function getParams() : array
    {
        $params = $this->request->getQueryParams();

        return $params;
    }
}
