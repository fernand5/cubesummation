<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Cube;
use Illuminate\Http\Response;

class CalculateTest extends TestCase
{
    /**
     * Test Update
     *
     * @return void
     */
    public function testUpdate()
    {
        $cube = new Cube(4,5);

        $this->assertEquals(true, $cube->setValuePosition(1, 1, 1, 4));

    }
    /**
     * Test Query
     *
     * @return void
     */
    public function testQuery()
    {
        $cube = new Cube(4,5);
        $this->assertEquals(true, $cube->setValuePosition(1, 1, 1, 4));
        $this->assertEquals(4, $cube->getQuery(0, 0, 0, 2, 2, 2));

    }
}
