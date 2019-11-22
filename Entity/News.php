<?php

namespace Owp\OwpNews\Entity;

use App\Entity\User;
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

    /**
     * @ORM\Column(name="promote", type="boolean")
     */
    protected $promote;

    public function __construct()
    {
        $this->setPromote(true);
    }

    public function isPromote(): ?bool
    {
        return $this->promote;
    }

    public function setPromote(bool $promote): self
    {
        $this->promote = $promote;

        return $this;
    }
}
