<?php namespace Arcanedev\Localization\Tests\Entities;

use Arcanedev\Localization\Entities\Locale;
use Arcanedev\Localization\Tests\TestCase;

/**
 * Class     LocaleTest
 *
 * @package  Arcanedev\Localization\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LocaleTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Locale */
    private $locale;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        unset($this->locale);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->locale = $this->makeLocale('en');

        $this->assertInstanceOf(Locale::class, $this->locale);

        $this->assertEquals('en',      $this->locale->key());
        $this->assertEquals('English', $this->locale->name());
        $this->assertEquals('Latin',   $this->locale->script());
        $this->assertEquals('ltr',     $this->locale->direction());
        $this->assertEquals('English', $this->locale->native());
        $this->assertEquals('en_GB',   $this->locale->regional());

        $this->assertTrue($this->locale->isDefault());
    }

    /** @test */
    public function it_must_lower_direction_case()
    {
        $key          = 'en';
        $data         = $this->getLocale($key);
        $data['dir']  = 'LTR';
        $this->locale = new Locale($key, $data);

        $this->assertEquals(strtolower($data['dir']), $this->locale->direction());
    }

    /** @test */
    public function it_can_get_direction_if_empty()
    {
        $key          = 'en';
        $data         = $this->getLocale($key);
        $data['dir']  = '';
        $this->locale = new Locale($key, $data);

        $this->assertEquals('ltr', $this->locale->direction());
    }

    /** @test */
    public function it_can_convert_entity_to_array()
    {
        $this->locale = $this->makeLocale('en');

        $this->assertInternalType('array', $this->locale->toArray());
    }

    /** @test */
    public function it_can_convert_entity_to_json()
    {
        $this->locale = $this->makeLocale('en');

        $this->assertJson($this->locale->toJson());
        $this->assertJson(json_encode($this->locale, JSON_PRETTY_PRINT));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make a locale.
     *
     * @param  string  $key
     *
     * @return Locale
     */
    private function makeLocale($key)
    {
        return Locale::make($key, $this->getLocale($key));
    }

    /**
     * Get locale data.
     *
     * @param  string  $key
     *
     * @return array
     */
    private function getLocale($key)
    {
        return array_get([
            'ar' => [
                'name'     => 'Arabic',
                'script'   => 'Arab',
                'dir'      => 'rtl',
                'native'   => 'العربية',
                'regional' => 'ar_AE',
            ],
            'en' => [
                'name'     => 'English',
                'script'   => 'Latin',
                'dir'      => 'ltr',
                'native'   => 'English',
                'regional' => 'en_GB',
            ],
            'fr' => [
                'name'     => 'French',
                'script'   => 'Latin',
                'dir'      => 'ltr',
                'native'   => 'Français',
                'regional' => 'fr_FR',
            ],
        ], $key);
    }
}
