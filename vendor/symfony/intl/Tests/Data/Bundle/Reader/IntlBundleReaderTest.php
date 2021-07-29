<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Intl\Tests\Data\Bundle\Reader;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Intl\Data\Bundle\Reader\IntlBundleReader;

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 * @requires extension intl
 */
class IntlBundleReaderTest extends TestCase
{
    /**
     * @var IntlBundleReader
     */
    private $reader;

    protected function setUp()
    {
        $this->reader = new IntlBundleReader();
    }

    public function testReadReturnsArrayAccess()
    {
        $data = $this->reader->read(__DIR__.'/Fixtures/res', 'ro');

        $this->assertInstanceOf('\ArrayAccess', $data);
        $this->assertSame('Bar', $data['Foo']);
        $this->assertArrayNotHasKey('ExistsNot', $data);
    }

    public function testReadFollowsAlias()
    {
        // "alias" = "ro"
        $data = $this->reader->read(__DIR__.'/Fixtures/res', 'alias');

        $this->assertInstanceOf('\ArrayAccess', $data);
        $this->assertSame('Bar', $data['Foo']);
        $this->assertArrayNotHasKey('ExistsNot', $data);
    }

    public function testReadDoesNotFollowFallback()
    {
        if (\defined('HHVM_VERSION')) {
            $this->markTestSkipped('ResourceBundle does not support disabling fallback properly on HHVM.');
        }

        // "ro_MD" -> "ro"
        $data = $this->reader->read(__DIR__.'/Fixtures/res', 'ro_MD');

        $this->assertInstanceOf('\ArrayAccess', $data);
        $this->assertSame('Bam', $data['Baz']);
        $this->assertArrayNotHasKey('Foo', $data);
        $this->assertNull($data['Foo']);
        $this->assertArrayNotHasKey('ExistsNot', $data);
    }

    public function testReadDoesNotFollowFallbackAlias()
    {
        if (\defined('HHVM_VERSION')) {
            $this->markTestSkipped('ResourceBundle does not support disabling fallback properly on HHVM.');
        }

        // "mo" = "ro_MD" -> "ro"
        $data = $this->reader->read(__DIR__.'/Fixtures/res', 'mo');

        $this->assertInstanceOf('\ArrayAccess', $data);
        $this->assertSame('Bam', $data['Baz'], 'data from the aliased locale can be accessed');
        $this->assertArrayNotHasKey('Foo', $data);
        $this->assertNull($data['Foo']);
        $this->assertArrayNotHasKey('ExistsNot', $data);
    }

    public function testReadFailsIfNonExistingLocale()
    {
        $this->expectException('Symfony\Component\Intl\Exception\ResourceBundleNotFoundException');
        $this->reader->read(__DIR__.'/Fixtures/res', 'foo');
    }

    public function testReadFailsIfNonExistingFallbackLocale()
    {
        $this->expectException('Symfony\Component\Intl\Exception\ResourceBundleNotFoundException');
        $this->reader->read(__DIR__.'/Fixtures/res', 'ro_AT');
    }

    public function testReadFailsIfNonExistingDirectory()
    {
        $this->expectException('Symfony\Component\Intl\Exception\RuntimeException');
        $this->reader->read(__DIR__.'/foo', 'ro');
    }
}
