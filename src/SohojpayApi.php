<?php

namespace Sohojpay\SohojpayLib;

abstract class SohojpayApi
{
    private $api;
    private $url;
    private $headers = [];
    private $params = [];

    /**
     * Set the API key.
     *
     * @param string $api
     */
    public function setApi($api)
    {
        $this->api = $api;
    }

    /**
     * Get the API key.
     *
     * @return string
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Set the base URL.
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get the base URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url ?: 'https://secure.sohojpaybd.com/api/';
    }

    /**
     * Set custom headers.
     *
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Get custom headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set request parameters.
     *
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * Get request parameters.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Create a payment.
     *
     * @return mixed
     */
    public function createPayment()
    {
        return $this->sendRequest('payment/create');
    }

    /**
     * Verify a payment.
     *
     * @return mixed
     */
    public function verifyPayment()
    {
        return $this->sendRequest('payment/verify');
    }

    /**
     * Send a request to the specified endpoint.
     *
     * @param string $endpoint
     * @return mixed
     */
    protected function sendRequest($endpoint)
    {
        $headers = array_merge(
            [
                'Content-Type: application/json',
                'SOHOJPAY-API-KEY: ' . $this->getApi()
            ],
            $this->getHeaders()
        );

        $url = $this->getUrl() . $endpoint;
        $data = json_encode($this->getParams());

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_VERBOSE => true
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
