<?php

declare(strict_types=1);

namespace tusk\http\status;

function permanent_redirect(bool $kill = true): void
{
    http_response_code(308);
    if ($kill) exit(1);
}

function bad_request(bool $kill = true): void
{
    http_response_code(400);
    if ($kill) exit(1);
}

function forbidden(bool $kill = true): void
{
    http_response_code(403);
    if ($kill) exit(1);
}

function not_found(bool $kill = true): void
{
    http_response_code(404);
    if ($kill) exit(1);
}

function method_not_allowed(bool $kill = true): void
{
    http_response_code(405);
    if ($kill) exit(1);
}

function unprocessable_entity(bool $kill = true): void
{
    http_response_code(422);
    if ($kill) exit(1);
}

function im_a_teapot(bool $kill = true): void
{
    http_response_code(418);
    if ($kill) exit(0);
}
