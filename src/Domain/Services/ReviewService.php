<?php

namespace App\Domain\Services;

use App\Domain\Entities\Review;

class ReviewService implements IReviewService
{

    /**
     * @param string $reviewText
     * @return array<mixed>
     */
    function parseReview(string $reviewText) : array
    {
        $Review = new Review($reviewText);
        return $Review->getReviewResults();
    }
}