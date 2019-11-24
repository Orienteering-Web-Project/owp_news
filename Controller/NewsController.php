<?php

namespace Owp\OwpNews\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Owp\OwpNews\Service\NewsService;
use Owp\OwpNews\Entity\News;

class NewsController extends Controller
{
    public function show(News $news, NewsService $newsService): Response
    {
        $newsService->isAllowed('show', $news);

        return $this->render('News/show.html.twig', [
            'news' => $news,
        ]);
    }
}
