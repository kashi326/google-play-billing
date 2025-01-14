<?php

namespace Tests\Products;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Kashi326\GooglePlay\ClientFactory;
use Kashi326\GooglePlay\Products\ProductClient;
use Kashi326\GooglePlay\Products\ProductPurchase;
use Kashi326\GooglePlay\ValueObjects\EmptyResponse;
use Tests\TestCase;

/**
 * Class ProductClientTest.
 */
class ProductClientTest extends TestCase
{
    /**
     * @var string
     */
    private $packageName;
    /**
     * @var string
     */
    private $productId;
    /**
     * @var string
     */
    private $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->packageName = 'com.some.thing';
        $this->productId = 'fake_id';
        $this->token = 'fake_token';
    }

    /**
     * @test
     *
     * @throws GuzzleException
     */
    public function test_it_can_send_get_request()
    {
        $response = new Response(200, [], '[]');
        $transactions = [];

        $client = ClientFactory::mock($response, $transactions);

        $product = new ProductClient(
            $client,
            $this->packageName,
            $this->productId,
            $this->token
        );

        $this->assertInstanceOf(ProductPurchase::class, $product->get());

        /** @var Request $request */
        $request = $transactions[0]['request'];
        $this->assertEquals($this->endpoint(ProductClient::URI_GET), (string)$request->getUri());
    }

    /**
     * @test
     *
     * @throws GuzzleException
     */
    public function test_it_can_send_acknowledge_request()
    {
        $response = new Response(200, [], '[]');
        $transactions = [];

        $client = ClientFactory::mock($response, $transactions);

        $product = new ProductClient(
            $client,
            $this->packageName,
            $this->productId,
            $this->token
        );

        $this->assertInstanceOf(EmptyResponse::class, $product->acknowledge());

        /** @var Request $request */
        $request = $transactions[0]['request'];
        $this->assertEquals($this->endpoint(ProductClient::URI_ACKNOWLEDGE), (string)$request->getUri());
    }

    /** @test */
    public function it_can_send_consume_request(): void
    {
        $response = new Response(200, [], '[]');
        $transactions = [];
        $client = ClientFactory::mock($response, $transactions);
        $sut = new ProductClient($client, $this->packageName, $this->productId, $this->token);

        $sut->consume();

        /** @var Request $request */
        $request = $transactions[0]['request'];
        $this->assertEquals($this->endpoint(ProductClient::URI_CONSUME), (string)$request->getUri());
    }

    private function endpoint(string $template): string
    {
        return sprintf($template, $this->packageName, $this->productId, $this->token);
    }
}
