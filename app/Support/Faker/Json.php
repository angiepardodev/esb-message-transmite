<?php

namespace App\Support\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Arr;

/**
 * Utility class for generating JSON data.
 */
class Json extends Base
{
    const RANDOM_LETTER = 'randomLetter';
    const WORD = 'word';
    const WORDS = 'words';
    const SENTENCE = 'sentence';
    const PARAGRAPH = 'paragraph';
    const TEXT = 'text';
    const UNIX_TIME = 'unixTime';
    const DATE_TIME = 'dateTime';
    const DATE_TIME_AD = 'dateTimeAD';
    const ISO8601 = 'iso8601';
    const DATE = 'date';
    const TIME = 'time';
    const DATE_TIME_BETWEEN = 'dateTimeBetween';
    const DATE_TIME_IN_INTERVAL = 'dateTimeInInterval';
    const DATE_TIME_THIS_CENTURY = 'dateTimeThisCentury';
    const DATE_TIME_THIS_DECADE = 'dateTimeThisDecade';
    const DATE_TIME_THIS_YEAR = 'dateTimeThisYear';
    const DATE_TIME_THIS_MONTH = 'dateTimeThisMonth';
    const AM_PM = 'amPm';
    const DAY_OF_MONTH = 'dayOfMonth';
    const DAY_OF_WEEK = 'dayOfWeek';
    const MONTH_NAME = 'monthName';
    const YEAR = 'year';
    const CENTURY = 'century';
    const TIMEZONE = 'timezone';
    const SAFE_EMAIL = 'safeEmail';
    const EMAIL = 'email';
    const FREE_EMAIL = 'freeEmail';
    const COMPANY_EMAIL = 'companyEmail';
    const FREE_EMAIL_DOMAIN = 'freeEmailDomain';
    const USER_NAME = 'userName';
    const PASSWORD = 'password';
    const DOMAIN_NAME = 'domainName';
    const DOMAIN_WORD = 'domainWord';
    const TLD = 'tld';
    const URL = 'url';
    const SLUG = 'slug';
    const IPV4 = 'ipv4';
    const LOCAL_IPV4 = 'localIpv4';
    const IPV6 = 'ipv6';
    const MAC_ADDRESS = 'macAddress';
    const USER_AGENT = 'userAgent';
    const CHROME = 'chrome';
    const FIREFOX = 'firefox';
    const SAFARI = 'safari';
    const OPERA = 'opera';
    const INTERNET_EXPLORER = 'internetExplorer';
    const MS_EDGE = 'msedge';
    const CREDIT_CARD_TYPE = 'creditCardType';
    const CREDIT_CARD_NUMBER = 'creditCardNumber';
    const CREDIT_CARD_EXPIRATION_DATE = 'creditCardExpirationDate';
    const CREDIT_CARD_EXPIRATION_DATE_STRING = 'creditCardExpirationDateString';
    const CREDIT_CARD_DETAILS = 'creditCardDetails';
    const IBAN = 'iban';
    const SWIFT_BIC_NUMBER = 'swiftBicNumber';
    const HEX_COLOR = 'hexColor';
    const SAFE_HEX_COLOR = 'safeHexColor';
    const RGB_COLOR_AS_ARRAY = 'rgbColorAsArray';
    const RGBA_CSS_COLOR = 'rgbaCssColor';
    const RGB_CSS_COLOR = 'rgbCssColor';
    const SAFE_COLOR_NAME = 'safeColorName';
    const COLOR_NAME = 'colorName';
    const HSL_COLOR = 'hslColor';
    const HSL_COLOR_AS_ARRAY = 'hslColorAsArray';
    const MIME_TYPE = 'mimeType';
    const FILE_EXTENSION = 'fileExtension';
    const UUID = 'uuid';
    const EAN13 = 'ean13';
    const EAN8 = 'ean8';
    const ISBN10 = 'isbn10';
    const ISBN13 = 'isbn13';
    const ASCIIFY = 'asciify';
    const BOTHIFY = 'bothify';
    const BOOLEAN = 'boolean';
    const MD5 = 'md5';
    const SHA1 = 'sha1';
    const SHA256 = 'sha256';
    const LOCALE = 'locale';
    const COUNTRY = 'country';
    const COUNTRY_CODE = 'countryCode';
    const COUNTRY_ISO_ALPHA3 = 'countryISOAlpha3';
    const LANGUAGE_CODE = 'languageCode';
    const CURRENCY_CODE = 'currencyCode';
    const EMOJI = 'emoji';
    const RANDOM_HTML = 'randomHtml';
    const SEMVER = 'semver';
    const RANDOM_NUMBER = 'randomNumber';
    const RANDOM_FLOAT = 'randomFloat';
    const OBJECT = 'object';
    
    /**
     * Generate data random to JSON format.
     *
     * @param  array|null  $allows  An optional array of allowed keys; By default it allows all formatters.
     * @param  array|null  $denies  An optional array of denied keys; By default, it does not deny any formatters.
     * @param  int  $maxDeep  An optional parameter to determine the maximum depth while encoding nested data.
     *
     * @return string The JSON-encoded data.
     */
    public function json(array $allows = null, array $denies = null, int $maxDeep = 1): string
    {
        return json_encode($this->createDataRandom($allows ?? [], $denies ?? [], $maxDeep));
    }
    
    /**
     * Returns a JSON representation of an object.
     *
     * @param  int  $maxDeep  The maximum depth of nested objects to include in the JSON.
     *
     * @return string The JSON representation of the object.
     */
    public function jsonObject(int $maxDeep = 1): string
    {
        return $this->json(allows: [self::OBJECT], maxDeep: $maxDeep);
    }
    
    /**
     * Returns a JSON representation of a variety of data types.
     *
     * @param  int  $maxDeep  The maximum depth of nested objects to include in the JSON.
     *
     * @return string The JSON representation of the data.
     */
    public function jsonVariety(int $maxDeep = 1): string
    {
        return $this->json(maxDeep: $maxDeep);
    }
    
    protected function createArrayAssoc(array $allows, array $denies, int $maxDeep): array
    {
        $maxDeep--;
        $range = mt_rand(1, 5);
        $array = [];
        for ($i = 0; $i < $range; $i++) {
            $array[$this->generator->word] = $this->createDataRandom($allows, $denies, $maxDeep);
        }
        return $array;
    }
    
    protected function createDataRandom(array $allows, array $denies, int $maxDeep)
    {
        $generators = $allows ? Arr::only($this->getGeneratorFunctions(), $allows) : $this->getGeneratorFunctions();
        
        if ($denies) {
            $generators = Arr::except($generators, $denies);
        }
        
        if (array_key_exists(self::OBJECT, $generators)) {
            $generators[] = fn() => $this->createArrayAssoc($allows, $denies, $maxDeep);
        }
        
        $generators = array_values($generators);
        
        return $generators[mt_rand(0, count($generators) - 1)]();
    }
    
    protected function getGeneratorFunctions(): array
    {
        return [
            self::RANDOM_LETTER                      => fn() => $this->generator->randomLetter(),
            self::WORD                               => fn() => $this->generator->word(),
            self::WORDS                              => fn() => $this->generator->words(),
            self::SENTENCE                           => fn() => $this->generator->sentence(),
            self::PARAGRAPH                          => fn() => $this->generator->paragraph(),
            self::TEXT                               => fn() => $this->generator->text(),
            self::UNIX_TIME                          => fn() => $this->generator->unixTime(),
            self::DATE_TIME                          => fn() => $this->generator->dateTime(),
            self::DATE_TIME_AD                       => fn() => $this->generator->dateTimeAD(),
            self::ISO8601                            => fn() => $this->generator->iso8601(),
            self::DATE                               => fn() => $this->generator->date(),
            self::TIME                               => fn() => $this->generator->time(),
            self::DATE_TIME_BETWEEN                  => fn() => $this->generator->dateTimeBetween(),
            self::DATE_TIME_IN_INTERVAL              => fn() => $this->generator->dateTimeInInterval(),
            self::DATE_TIME_THIS_CENTURY             => fn() => $this->generator->dateTimeThisCentury(),
            self::DATE_TIME_THIS_DECADE              => fn() => $this->generator->dateTimeThisDecade(),
            self::DATE_TIME_THIS_YEAR                => fn() => $this->generator->dateTimeThisYear(),
            self::DATE_TIME_THIS_MONTH               => fn() => $this->generator->dateTimeThisMonth(),
            self::AM_PM                              => fn() => $this->generator->amPm(),
            self::DAY_OF_MONTH                       => fn() => $this->generator->dayOfMonth(),
            self::DAY_OF_WEEK                        => fn() => $this->generator->dayOfWeek(),
            self::MONTH_NAME                         => fn() => $this->generator->monthName(),
            self::YEAR                               => fn() => $this->generator->year(),
            self::CENTURY                            => fn() => $this->generator->century(),
            self::TIMEZONE                           => fn() => $this->generator->timezone(),
            self::SAFE_EMAIL                         => fn() => $this->generator->safeEmail(),
            self::EMAIL                              => fn() => $this->generator->email(),
            self::FREE_EMAIL                         => fn() => $this->generator->freeEmail(),
            self::COMPANY_EMAIL                      => fn() => $this->generator->companyEmail(),
            self::FREE_EMAIL_DOMAIN                  => fn() => $this->generator->freeEmailDomain(),
            self::USER_NAME                          => fn() => $this->generator->userName(),
            self::PASSWORD                           => fn() => $this->generator->password(),
            self::DOMAIN_NAME                        => fn() => $this->generator->domainName(),
            self::DOMAIN_WORD                        => fn() => $this->generator->domainWord(),
            self::TLD                                => fn() => $this->generator->tld(),
            self::URL                                => fn() => $this->generator->url(),
            self::SLUG                               => fn() => $this->generator->slug(),
            self::IPV4                               => fn() => $this->generator->ipv4(),
            self::LOCAL_IPV4                         => fn() => $this->generator->localIpv4(),
            self::IPV6                               => fn() => $this->generator->ipv6(),
            self::MAC_ADDRESS                        => fn() => $this->generator->macAddress(),
            self::USER_AGENT                         => fn() => $this->generator->userAgent(),
            self::CHROME                             => fn() => $this->generator->chrome(),
            self::FIREFOX                            => fn() => $this->generator->firefox(),
            self::SAFARI                             => fn() => $this->generator->safari(),
            self::OPERA                              => fn() => $this->generator->opera(),
            self::INTERNET_EXPLORER                  => fn() => $this->generator->internetExplorer(),
            self::MS_EDGE                            => fn() => $this->generator->msedge(),
            self::CREDIT_CARD_TYPE                   => fn() => $this->generator->creditCardType(),
            self::CREDIT_CARD_NUMBER                 => fn() => $this->generator->creditCardNumber(),
            self::CREDIT_CARD_EXPIRATION_DATE        => fn() => $this->generator->creditCardExpirationDate(),
            self::CREDIT_CARD_EXPIRATION_DATE_STRING => fn() => $this->generator->creditCardExpirationDateString(),
            self::CREDIT_CARD_DETAILS                => fn() => $this->generator->creditCardDetails(),
            self::IBAN                               => fn() => $this->generator->iban(),
            self::SWIFT_BIC_NUMBER                   => fn() => $this->generator->swiftBicNumber(),
            self::HEX_COLOR                          => fn() => $this->generator->hexColor(),
            self::SAFE_HEX_COLOR                     => fn() => $this->generator->safeHexColor(),
            self::RGB_COLOR_AS_ARRAY                 => fn() => $this->generator->rgbColorAsArray(),
            self::RGBA_CSS_COLOR                     => fn() => $this->generator->rgbaCssColor(),
            self::RGB_CSS_COLOR                      => fn() => $this->generator->rgbCssColor(),
            self::SAFE_COLOR_NAME                    => fn() => $this->generator->safeColorName(),
            self::COLOR_NAME                         => fn() => $this->generator->colorName(),
            self::HSL_COLOR                          => fn() => $this->generator->hslColor(),
            self::HSL_COLOR_AS_ARRAY                 => fn() => $this->generator->hslColorAsArray(),
            self::MIME_TYPE                          => fn() => $this->generator->mimeType(),
            self::FILE_EXTENSION                     => fn() => $this->generator->fileExtension(),
            self::UUID                               => fn() => $this->generator->uuid(),
            self::EAN13                              => fn() => $this->generator->ean13(),
            self::EAN8                               => fn() => $this->generator->ean8(),
            self::ISBN10                             => fn() => $this->generator->isbn10(),
            self::ISBN13                             => fn() => $this->generator->isbn13(),
            self::ASCIIFY                            => fn() => $this->generator->asciify('***'),
            self::BOTHIFY                            => fn() => $this->generator->bothify('##??'),
            self::BOOLEAN                            => fn() => $this->generator->boolean(),
            self::MD5                                => fn() => $this->generator->md5(),
            self::SHA1                               => fn() => $this->generator->sha1(),
            self::SHA256                             => fn() => $this->generator->sha256(),
            self::LOCALE                             => fn() => $this->generator->locale(),
            self::COUNTRY                            => fn() => $this->generator->country(),
            self::COUNTRY_CODE                       => fn() => $this->generator->countryCode(),
            self::COUNTRY_ISO_ALPHA3                 => fn() => $this->generator->countryISOAlpha3(),
            self::LANGUAGE_CODE                      => fn() => $this->generator->languageCode(),
            self::CURRENCY_CODE                      => fn() => $this->generator->currencyCode(),
            self::EMOJI                              => fn() => $this->generator->emoji(),
            self::RANDOM_HTML                        => fn() => $this->generator->randomHtml(),
            self::SEMVER                             => fn() => $this->generator->semver(),
            self::RANDOM_NUMBER                      => fn() => $this->generator->randomNumber(),
            self::RANDOM_FLOAT                       => fn() => $this->generator->randomFloat(),
        ];
    }
}
