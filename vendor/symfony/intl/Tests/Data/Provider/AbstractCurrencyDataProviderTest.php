<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Intl\Tests\Data\Provider;

use Symfony\Component\Intl\Data\Provider\CurrencyDataProvider;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Intl\Locale;

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
abstract class AbstractCurrencyDataProviderTest extends AbstractDataProviderTest
{
    // The below arrays document the state of the ICU data bundled with this package.

    protected static $currencies = array(
        'ADP',
        'AED',
        'AFA',
        'AFN',
        'ALK',
        'ALL',
        'AMD',
        'ANG',
        'AOA',
        'AOK',
        'AON',
        'AOR',
        'ARA',
        'ARL',
        'ARM',
        'ARP',
        'ARS',
        'ATS',
        'AUD',
        'AWG',
        'AZM',
        'AZN',
        'BAD',
        'BAM',
        'BAN',
        'BBD',
        'BDT',
        'BEC',
        'BEF',
        'BEL',
        'BGL',
        'BGM',
        'BGN',
        'BGO',
        'BHD',
        'BIF',
        'BMD',
        'BND',
        'BOB',
        'BOL',
        'BOP',
        'BOV',
        'BRB',
        'BRC',
        'BRE',
        'BRL',
        'BRN',
        'BRR',
        'BRZ',
        'BSD',
        'BTN',
        'BUK',
        'BWP',
        'BYB',
        'BYN',
        'BYR',
        'BZD',
        'CAD',
        'CDF',
        'CHE',
        'CHF',
        'CHW',
        'CLE',
        'CLF',
        'CLP',
        'CNH',
        'CNX',
        'CNY',
        'COP',
        'COU',
        'CRC',
        'CSD',
        'CSK',
        'CUC',
        'CUP',
        'CVE',
        'CYP',
        'CZK',
        'DDM',
        'DEM',
        'DJF',
        'DKK',
        'DOP',
        'DZD',
        'ECS',
        'ECV',
        'EEK',
        'EGP',
        'ERN',
        'ESA',
        'ESB',
        'ESP',
        'ETB',
        'EUR',
        'FIM',
        'FJD',
        'FKP',
        'FRF',
        'GBP',
        'GEK',
        'GEL',
        'GHC',
        'GHS',
        'GIP',
        'GMD',
        'GNF',
        'GNS',
        'GQE',
        'GRD',
        'GTQ',
        'GWE',
        'GWP',
        'GYD',
        'HKD',
        'HNL',
        'HRD',
        'HRK',
        'HTG',
        'HUF',
        'IDR',
        'IEP',
        'ILP',
        'ILR',
        'ILS',
        'INR',
        'IQD',
        'IRR',
        'ISJ',
        'ISK',
        'ITL',
        'JMD',
        'JOD',
        'JPY',
        'KES',
        'KGS',
        'KHR',
        'KMF',
        'KPW',
        'KRH',
        'KRO',
        'KRW',
        'KWD',
        'KYD',
        'KZT',
        'LAK',
        'LBP',
        'LKR',
        'LRD',
        'LSL',
        'LTL',
        'LTT',
        'LUC',
        'LUF',
        'LUL',
        'LVL',
        'LVR',
        'LYD',
        'MAD',
        'MAF',
        'MCF',
        'MDC',
        'MDL',
        'MGA',
        'MGF',
        'MKD',
        'MKN',
        'MLF',
        'MMK',
        'MNT',
        'MOP',
        'MRO',
        'MRU',
        'MTL',
        'MTP',
        'MUR',
        'MVP',
        'MVR',
        'MWK',
        'MXN',
        'MXP',
        'MXV',
        'MYR',
        'MZE',
        'MZM',
        'MZN',
        'NAD',
        'NGN',
        'NIC',
        'NIO',
        'NLG',
        'NOK',
        'NPR',
        'NZD',
        'OMR',
        'PAB',
        'PEI',
        'PEN',
        'PES',
        'PGK',
        'PHP',
        'PKR',
        'PLN',
        'PLZ',
        'PTE',
        'PYG',
        'QAR',
        'RHD',
        'ROL',
        'RON',
        'RSD',
        'RUB',
        'RUR',
        'RWF',
        'SAR',
        'SBD',
        'SCR',
        'SDD',
        'SDG',
        'SDP',
        'SEK',
        'SGD',
        'SHP',
        'SIT',
        'SKK',
        'SLL',
        'SOS',
        'SRD',
        'SRG',
        'SSP',
        'STD',
        'STN',
        'SUR',
        'SVC',
        'SYP',
        'SZL',
        'THB',
        'TJR',
        'TJS',
        'TMM',
        'TMT',
        'TND',
        'TOP',
        'TPE',
        'TRL',
        'TRY',
        'TTD',
        'TWD',
        'TZS',
        'UAH',
        'UAK',
        'UGS',
        'UGX',
        'USD',
        'USN',
        'USS',
        'UYI',
        'UYP',
        'UYU',
        'UZS',
        'VEB',
        'VEF',
        'VND',
        'VNN',
        'VUV',
        'WST',
        'XAF',
        'XCD',
        'XEU',
        'XFO',
        'XFU',
        'XOF',
        'XPF',
        'XRE',
        'YDD',
        'YER',
        'YUD',
        'YUM',
        'YUN',
        'YUR',
        'ZAL',
        'ZAR',
        'ZMK',
        'ZMW',
        'ZRN',
        'ZRZ',
        'ZWD',
        'ZWL',
        'ZWR',
    );

    protected static $alpha3ToNumeric = array(
        'AFA' => 4,
        'ALK' => 8,
        'ALL' => 8,
        'DZD' => 12,
        'ADP' => 20,
        'AON' => 24,
        'AOK' => 24,
        'AZM' => 31,
        'ARA' => 32,
        'ARP' => 32,
        'ARS' => 32,
        'AUD' => 36,
        'ATS' => 40,
        'BSD' => 44,
        'BHD' => 48,
        'BDT' => 50,
        'AMD' => 51,
        'BBD' => 52,
        'BEF' => 56,
        'BMD' => 60,
        'BTN' => 64,
        'BOB' => 68,
        'BOP' => 68,
        'BAD' => 70,
        'BWP' => 72,
        'BRN' => 76,
        'BRE' => 76,
        'BRC' => 76,
        'BRB' => 76,
        'BZD' => 84,
        'SBD' => 90,
        'BND' => 96,
        'BGL' => 100,
        'MMK' => 104,
        'BUK' => 104,
        'BIF' => 108,
        'BYB' => 112,
        'KHR' => 116,
        'CAD' => 124,
        'CVE' => 132,
        'KYD' => 136,
        'LKR' => 144,
        'CLP' => 152,
        'CNY' => 156,
        'COP' => 170,
        'KMF' => 174,
        'ZRN' => 180,
        'ZRZ' => 180,
        'CRC' => 188,
        'HRK' => 191,
        'HRD' => 191,
        'CUP' => 192,
        'CYP' => 196,
        'CSK' => 200,
        'CZK' => 203,
        'DKK' => 208,
        'DOP' => 214,
        'ECS' => 218,
        'SVC' => 222,
        'GQE' => 226,
        'ETB' => 230,
        'ERN' => 232,
        'EEK' => 233,
        'FKP' => 238,
        'FJD' => 242,
        'FIM' => 246,
        'FRF' => 250,
        'DJF' => 262,
        'GEK' => 268,
        'GMD' => 270,
        'DEM' => 276,
        'DDM' => 278,
        'GHC' => 288,
        'GIP' => 292,
        'GRD' => 300,
        'GTQ' => 320,
        'GNF' => 324,
        'GNS' => 324,
        'GYD' => 328,
        'HTG' => 332,
        'HNL' => 340,
        'HKD' => 344,
        'HUF' => 348,
        'ISK' => 352,
        'ISJ' => 352,
        'INR' => 356,
        'IDR' => 360,
        'IRR' => 364,
        'IQD' => 368,
        'IEP' => 372,
        'ILS' => 376,
        'ILP' => 376,
        'ILR' => 376,
        'ITL' => 380,
        'JMD' => 388,
        'JPY' => 392,
        'KZT' => 398,
        'JOD' => 400,
        'KES' => 404,
        'KPW' => 408,
        'KRW' => 410,
        'KWD' => 414,
        'KGS' => 417,
        'LAK' => 418,
        'LBP' => 422,
        'LSL' => 426,
        'LVL' => 428,
        'LVR' => 428,
        'LRD' => 430,
        'LYD' => 434,
        'LTT' => 440,
        'LTL' => 440,
        'LUF' => 442,
        'MOP' => 446,
        'MGF' => 450,
        'MWK' => 454,
        'MYR' => 458,
        'MVR' => 462,
        'MLF' => 466,
        'MTP' => 470,
        'MTL' => 470,
        'MRO' => 478,
        'MUR' => 480,
        'MXN' => 484,
        'MXP' => 484,
        'MNT' => 496,
        'MDL' => 498,
        'MAD' => 504,
        'MZM' => 508,
        'MZE' => 508,
        'OMR' => 512,
        'NAD' => 516,
        'NPR' => 524,
        'NLG' => 528,
        'ANG' => 532,
        'AWG' => 533,
        'VUV' => 548,
        'NZD' => 554,
        'NIO' => 558,
        'NIC' => 558,
        'NGN' => 566,
        'NOK' => 578,
        'PKR' => 586,
        'PAB' => 590,
        'PGK' => 598,
        'PYG' => 600,
        'PEI' => 604,
        'PEN' => 604,
        'PES' => 604,
        'PHP' => 608,
        'PLZ' => 616,
        'PTE' => 620,
        'GWP' => 624,
        'GWE' => 624,
        'TPE' => 626,
        'QAR' => 634,
        'ROL' => 642,
        'RUB' => 643,
        'RWF' => 646,
        'SHP' => 654,
        'STD' => 678,
        'SAR' => 682,
        'SCR' => 690,
        'SLL' => 694,
        'SGD' => 702,
        'SKK' => 703,
        'VND' => 704,
        'SIT' => 705,
        'SOS' => 706,
        'ZAR' => 710,
        'RHD' => 716,
        'ZWD' => 716,
        'YDD' => 720,
        'ESP' => 724,
        'SSP' => 728,
        'SDP' => 736,
        'SDD' => 736,
        'SRG' => 740,
        'SZL' => 748,
        'SEK' => 752,
        'CHF' => 756,
        'SYP' => 760,
        'TJR' => 762,
        'THB' => 764,
        'TOP' => 776,
        'TTD' => 780,
        'AED' => 784,
        'TND' => 788,
        'TRL' => 792,
        'TMM' => 795,
        'UGS' => 800,
        'UGX' => 800,
        'UAK' => 804,
        'MKD' => 807,
        'RUR' => 810,
        'SUR' => 810,
        'EGP' => 818,
        'GBP' => 826,
        'TZS' => 834,
        'USD' => 840,
        'UYU' => 858,
        'UYP' => 858,
        'UZS' => 860,
        'VEB' => 862,
        'WST' => 882,
        'YER' => 886,
        'YUN' => 890,
        'CSD' => 891,
        'YUM' => 891,
        'YUD' => 891,
        'ZMK' => 894,
        'TWD' => 901,
        'MRU' => 929,
        'STN' => 930,
        'CUC' => 931,
        'ZWL' => 932,
        'BYN' => 933,
        'TMT' => 934,
        'ZWR' => 935,
        'GHS' => 936,
        'VEF' => 937,
        'SDG' => 938,
        'UYI' => 940,
        'RSD' => 941,
        'MZN' => 943,
        'AZN' => 944,
        'RON' => 946,
        'CHE' => 947,
        'CHW' => 948,
        'TRY' => 949,
        'XAF' => 950,
        'XCD' => 951,
        'XOF' => 952,
        'XPF' => 953,
        'XEU' => 954,
        'ZMW' => 967,
        'SRD' => 968,
        'MGA' => 969,
        'COU' => 970,
        'AFN' => 971,
        'TJS' => 972,
        'AOA' => 973,
        'BYR' => 974,
        'BGN' => 975,
        'CDF' => 976,
        'BAM' => 977,
        'EUR' => 978,
        'MXV' => 979,
        'UAH' => 980,
        'GEL' => 981,
        'AOR' => 982,
        'ECV' => 983,
        'BOV' => 984,
        'PLN' => 985,
        'BRL' => 986,
        'BRR' => 987,
        'LUL' => 988,
        'LUC' => 989,
        'CLF' => 990,
        'ZAL' => 991,
        'BEL' => 992,
        'BEC' => 993,
        'ESB' => 995,
        'ESA' => 996,
        'USN' => 997,
        'USS' => 998,
    );

    /**
     * @var CurrencyDataProvider
     */
    protected $dataProvider;

    protected function setUp()
    {
        parent::setUp();

        $this->dataProvider = new CurrencyDataProvider(
            $this->getDataDirectory().'/'.Intl::CURRENCY_DIR,
            $this->createEntryReader()
        );
    }

    abstract protected function getDataDirectory();

    public function testGetCurrencies()
    {
        $this->assertSame(static::$currencies, $this->dataProvider->getCurrencies());
    }

    /**
     * @dataProvider provideLocales
     */
    public function testGetNames($displayLocale)
    {
        $names = $this->dataProvider->getNames($displayLocale);

        $keys = array_keys($names);

        sort($keys);

        $this->assertEquals(static::$currencies, $keys);

        // Names should be sorted
        $sortedNames = $names;
        $collator = new \Collator($displayLocale);
        $collator->asort($names);

        $this->assertEquals($sortedNames, $names);
    }

    public function testGetNamesDefaultLocale()
    {
        Locale::setDefault('de_AT');

        $this->assertSame(
            $this->dataProvider->getNames('de_AT'),
            $this->dataProvider->getNames()
        );
    }

    /**
     * @dataProvider provideLocaleAliases
     */
    public function testGetNamesSupportsAliases($alias, $ofLocale)
    {
        // Can't use assertSame(), because some aliases contain scripts with
        // different collation (=order of output) than their aliased locale
        // e.g. sr_Latn_ME => sr_ME
        $this->assertEquals(
            $this->dataProvider->getNames($ofLocale),
            $this->dataProvider->getNames($alias)
        );
    }

    /**
     * @dataProvider provideLocales
     */
    public function testGetName($displayLocale)
    {
        $expected = $this->dataProvider->getNames($displayLocale);
        $actual = array();

        foreach ($expected as $currency => $name) {
            $actual[$currency] = $this->dataProvider->getName($currency, $displayLocale);
        }

        $this->assertSame($expected, $actual);
    }

    public function testGetNameDefaultLocale()
    {
        Locale::setDefault('de_AT');

        $expected = $this->dataProvider->getNames('de_AT');
        $actual = array();

        foreach ($expected as $currency => $name) {
            $actual[$currency] = $this->dataProvider->getName($currency);
        }

        $this->assertSame($expected, $actual);
    }

    /**
     * @dataProvider provideLocales
     */
    public function testGetSymbol($displayLocale)
    {
        $currencies = $this->dataProvider->getCurrencies();

        foreach ($currencies as $currency) {
            $this->assertGreaterThan(0, mb_strlen($this->dataProvider->getSymbol($currency, $displayLocale)));
        }
    }

    public function provideCurrencies()
    {
        return array_map(
            function ($currency) { return array($currency); },
            static::$currencies
        );
    }

    /**
     * @dataProvider provideCurrencies
     */
    public function testGetFractionDigits($currency)
    {
        $this->assertInternalType('numeric', $this->dataProvider->getFractionDigits($currency));
    }

    /**
     * @dataProvider provideCurrencies
     */
    public function testGetRoundingIncrement($currency)
    {
        $this->assertInternalType('numeric', $this->dataProvider->getRoundingIncrement($currency));
    }

    public function provideCurrenciesWithNumericEquivalent()
    {
        return array_map(
            function ($value) { return array($value); },
            array_keys(static::$alpha3ToNumeric)
        );
    }

    /**
     * @dataProvider provideCurrenciesWithNumericEquivalent
     */
    public function testGetNumericCode($currency)
    {
        $this->assertSame(static::$alpha3ToNumeric[$currency], $this->dataProvider->getNumericCode($currency));
    }

    public function provideCurrenciesWithoutNumericEquivalent()
    {
        return array_map(
            function ($value) { return array($value); },
            array_diff(static::$currencies, array_keys(static::$alpha3ToNumeric))
        );
    }

    /**
     * @dataProvider provideCurrenciesWithoutNumericEquivalent
     * @expectedException \Symfony\Component\Intl\Exception\MissingResourceException
     */
    public function testGetNumericCodeFailsIfNoNumericEquivalent($currency)
    {
        $this->dataProvider->getNumericCode($currency);
    }

    public function provideValidNumericCodes()
    {
        $numericToAlpha3 = $this->getNumericToAlpha3Mapping();

        return array_map(
            function ($numeric, $alpha3) { return array($numeric, $alpha3); },
            array_keys($numericToAlpha3),
            $numericToAlpha3
        );
    }

    /**
     * @dataProvider provideValidNumericCodes
     */
    public function testForNumericCode($numeric, $expected)
    {
        $actual = $this->dataProvider->forNumericCode($numeric);

        // Make sure that a different array order doesn't break the test
        sort($actual);
        sort($expected);

        $this->assertEquals($expected, $actual);
    }

    public function provideInvalidNumericCodes()
    {
        $validNumericCodes = array_keys($this->getNumericToAlpha3Mapping());
        $invalidNumericCodes = array_diff(range(0, 1000), $validNumericCodes);

        return array_map(
            function ($value) { return array($value); },
            $invalidNumericCodes
        );
    }

    /**
     * @dataProvider provideInvalidNumericCodes
     * @expectedException \Symfony\Component\Intl\Exception\MissingResourceException
     */
    public function testForNumericCodeFailsIfInvalidNumericCode($currency)
    {
        $this->dataProvider->forNumericCode($currency);
    }

    private function getNumericToAlpha3Mapping()
    {
        $numericToAlpha3 = array();

        foreach (static::$alpha3ToNumeric as $alpha3 => $numeric) {
            if (!isset($numericToAlpha3[$numeric])) {
                $numericToAlpha3[$numeric] = array();
            }

            $numericToAlpha3[$numeric][] = $alpha3;
        }

        return $numericToAlpha3;
    }
}
