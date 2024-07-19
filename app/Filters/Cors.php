<?php

declare(strict_types=1);

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Cors implements FilterInterface
{
    /**
     * @param array|null $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        /** @var ResponseInterface $response */
        $response = service('response');

        // Set your Origin.
        $response->setHeader('Access-Control-Allow-Origin', '*');

        // Set this header if the client sends Cookies.
        // $response->setHeader('Access-Control-Allow-Credentials', 'true');
    }

    /**
     * @param array|null $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}