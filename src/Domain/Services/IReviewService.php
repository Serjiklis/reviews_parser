<?php

namespace App\Domain\Services;

interface IReviewService
{
    /**
     * @param string $reviewText
     * @return array<mixed>
     */
    function parseReview(string $reviewText) : array;
}