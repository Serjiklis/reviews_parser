<?php

namespace App\Application\Actions\ReviewParser;

use App\Application\Actions\Action;
use App\Domain\Services\IReviewService;
use Psr\Http\Message\ResponseInterface;

class GetReviewFromTextAction extends Action
{
    /** @var IReviewService $ReviewService */
    var $ReviewService;

    function __construct(IReviewService $ReviewService)
    {
        $this->ReviewService = $ReviewService;
    }

    /**
     * {@inheritdoc }
     */
    protected function action() : ResponseInterface
    {
        $text = $this->resolveArg("reviewText");

        $reviewResult = $this->ReviewService->parseReview($text);

        return $this->respondWithData($reviewResult)->withStatus(200);
    }
}