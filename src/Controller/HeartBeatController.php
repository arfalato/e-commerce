<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HeartBeatController
{
    #[Route('/heartbeat')]
    public function heartbeat(): Response
    {
        return new Response(
            '<html><body>I am alive.</body></html>'
        );
    }
}
