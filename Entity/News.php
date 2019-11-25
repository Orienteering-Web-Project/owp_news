<?php

namespace Owp\OwpNews\Entity;

use Doctrine\ORM\Mapping as ORM;
use Owp\OwpCore\Model as OwpCommonTrait;

/**
 * @ORM\Entity(repositoryClass="Owp\OwpNews\Repository\NewsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class News
{
    use OwpCommonTrait\IdTrait;
    use OwpCommonTrait\TitleTrait;
    use OwpCommonTrait\ContentTrait;
    use OwpCommonTrait\AuthorTrait;
    use OwpCommonTrait\PrivateTrait;
    use OwpCommonTrait\PromoteTrait;


    public function __construct()
    {
        $this->setPromote(true);
    }
}
