<?php

namespace App\Filters;

use CodeIgniter\Filters\PageCache;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ConditionalPageCacheFilter extends PageCache
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if ($this->isPasswordResetUrl($request)) {
            return null;
        }

        return parent::before($request, $arguments);
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        if ($this->isPasswordResetUrl($request)) {
            return null;
        }

        return parent::after($request, $response, $arguments);
    }

    protected function isPasswordResetUrl(RequestInterface $request): bool
    {
        return preg_match(
            '#(?:^|/)password/reset/[^/]+/?$#',
            $request->getUri()->getPath()
        ) === 1;
    }
}