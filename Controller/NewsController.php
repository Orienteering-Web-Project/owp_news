<?php

namespace Owp\OwpNews\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Owp\OwpNews\Service\NewsService;

class NewsController extends Controller
{
    public function show(string $slug, NewsService $newsService): Response
    {
        $entity = $newsService->get($slug);

        return $this->render('@OwpNews/Page/show.html.twig', [
            'news' => $entity,
        ]);
    }
}
