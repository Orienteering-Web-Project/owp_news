<?php

namespace Owp\OwpNews\Service;

use Owp\OwpCore\Entity\News;
use Owp\OwpNews\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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

    public function get(string $slug)
    {
        $entity = $this->newsRepository->findOneBySlug($slug);

        if (empty($entity)) {
            throw new NotFoundHttpException();
        }
        elseif (!$this->security->isGranted('view', $entity)) {
            throw new AccessDeniedException();
        }

        return $entity;
    }
}
