<?php
declare(strict_types=1);

namespace Ekvio\Integration\Extractor\Tests;

use Ekvio\Integration\Extractor\DataFromCsv;
use PHPUnit\Framework\TestCase;

/**
 * Class UsersFromCsvTest
 * @package Ekvio\Integration\Extractor\Tests
 */
class DataFromCsvTest extends TestCase
{
    public function testGetRecordsFromString()
    {
        $string = <<<EOF
"parent"|"child"|"title"
"parentA"|"childA"|"titleA"
EOF;
        $extractor = DataFromCsv::fromString($string)->configure(['delimiter' => '|', 'offset' => 0, 'use_keys' => true]);
        $extracted = $extractor->extract();

        $this->assertIsArray($extracted);
        $this->assertEquals(
            ['parent' => 'parentA', 'child' => 'childA', 'title' => 'titleA'],
            array_shift($extracted)
        );
    }
}