<?php

namespace App\Domain\Services;

use App\Domain\Entities\Review;

interface IReviewService
{
    /**
     * @param string $reviewText
     * @return array<mixed>
     */
    function parseReview(string $reviewText) : array;
}