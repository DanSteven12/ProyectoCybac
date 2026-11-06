<?php

namespace Tests\Unit;

use App\Models\Membership;
use Tests\TestCase;

class MembershipDurationTest extends TestCase
{
    /**
     * Comprueba que 30 días se formateen como '1 mes'.
     */
    public function test_duration_of_30_days_returns_one_month(): void
    {
        $membership = new Membership(['duration' => 30]);

        $this->assertEquals('1 mes', $membership->readable_duration);
    }

    /**
     * Comprueba que 365 días se formateen como '1 año'.
     */
    public function test_duration_of_365_days_returns_one_year(): void
    {
        $membership = new Membership(['duration' => 365]);

        $this->assertEquals('1 año', $membership->readable_duration);
    }

    /**
     * Comprueba que 183 días se formateen como '6 meses'.
     */
    public function test_duration_of_183_days_returns_six_months(): void
    {
        $membership = new Membership(['duration' => 183]);

        $this->assertEquals('6 meses', $membership->readable_duration);
    }

    /**
     * Comprueba que 15 días se formateen como '15 días'.
     */
    public function test_duration_of_15_days_returns_fifteen_days(): void
    {
        $membership = new Membership(['duration' => 15]);

        $this->assertEquals('15 días', $membership->readable_duration);
    }

    /**
     * Comprueba que 395 días se formateen como '1 año y 1 mes'.
     */
    public function test_duration_of_395_days_returns_one_year_and_one_month(): void
    {
        $membership = new Membership(['duration' => 395]);

        $this->assertEquals('1 año y 1 mes', $membership->readable_duration);
    }
}
