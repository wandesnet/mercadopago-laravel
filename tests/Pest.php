<?php

use Saloon\Http\Faking\MockClient;
use Saloon\Helpers\MockConfig;
use Saloon\Http\Faking\MockResponse;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(Tests\TestCase::class)->in('Feature');
uses()
    ->beforeEach(fn () => MockClient::destroyGlobal())
    ->in(__DIR__);
/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/
function getAccessToken(): string
{
    return config('mercadopago.access_token');
}

function mockClientFixture(string $mock): MockClient
{
    MockConfig::setFixturePath(__DIR__ . '/Fixtures/Mp');

    return new MockClient([
        MockResponse::fixture($mock),
    ]);
}

/**
 * @throws Exception
 */
function mockClient(string|array $mock, int $status = 200, array $headers = []): MockClient
{
    if (is_string($mock)) {
        $fixturePath = __DIR__ . '/Fixtures/Mp/' . $mock . '.json';

        if ( ! file_exists($fixturePath)) {
            throw new Exception("Fixture not found: {$fixturePath}");
        }

        $mock = json_decode(file_get_contents($fixturePath), true);
    }

    return new MockClient([
        MockResponse::make($mock, $status, $headers),
    ]);
}
