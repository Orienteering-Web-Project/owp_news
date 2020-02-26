<?php

namespace Owp\OwpNews\Entity;

use Doctrine\ORM\Mapping as ORM;
use Owp\OwpCore\Model as OwpCommonTrait;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;

/**
 * @ORM\Entity(repositoryClass="Owp\OwpNews\Repository\NewsRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class News
{
    use OwpCommonTrait\IdTrait;
    use OwpCommonTrait\TitleTrait;
    use OwpCommonTrait\ContentTrait;
    use OwpCommonTrait\AuthorTrait;
    use OwpCommonTrait\PrivateTrait;
    use OwpCommonTrait\PromoteTrait;
    use OwpCommonTrait\ImageTrait;

    public function __construct()
    {
        $this->setPromote(true);
        $this->image = new EmbeddedFile();
    }
}
