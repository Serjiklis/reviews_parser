<?php

namespace spec\App\HotelFeature;

use App\HotelFeature\Feature;
use PhpSpec\ObjectBehavior;

class FeatureSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Feature::class);
    }

    function it_hotel_feature_should_be_array()
    {
        $this->featureWords()->shouldBeArray();
    }
}
