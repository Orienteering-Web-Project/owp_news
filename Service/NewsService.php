<?php

namespace Owp\OwpNews\Service;

use Owp\OwpCore\Entity\News;
use Symfony\Component\HttpFoundation\Request;
use Owp\OwpNews\Repository\NewsRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Twig\Environment;
use Knp\Snappy\Pdf;

class NewsService {

    private $newsRepository;
    private $session;
    private $security;
    private $twig;

    public function __construct(NewsRepository $newsRepository, SessionInterface $session, Security $security, Environment $twig)
    {
        $this->newsRepository = $newsRepository;
        $this->session = $session;
        $this->security = $security;
        $this->twig = $twig;
    }

    public function getBy(array $filters = [], $order = ['updateAt' => 'DESC'])
    {
        if (empty($filters)) {
            $filters['promote'] = true;
        }

        if (!$this->security->isGranted('ROLE_MEMBER')) {
            $filters['private'] = false;
        }

        return $this->newsRepository->findBy($filters, $order);
    }

    public function isAllowed(News $news)
    {
        if (!$this->security->isGranted('view', $news)) {
            throw $this->createAccessDeniedException('Vous n\'êtes par autorisé à consulter cette page.');
        }
    }
}
