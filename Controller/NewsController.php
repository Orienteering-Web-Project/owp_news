<?php

namespace Owp\OwpNews\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NewsRepository;
use Owp\OwpNews\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class NewsController extends AbstractController
{
    /**
     * @Route("/news/{slug}", name="owp_news_show")
     */
    public function show(News $news): Response
    {
        if (!$this->isGranted('view', $news)) {
            throw $this->createAccessDeniedException('Vous n\'êtes par autorisé à consulter cette page.');
        }

        return $this->render('News/show.html.twig', [
            'news' => $news,
        ]);
    }
}
