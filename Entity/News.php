<?php

namespace Owp\OwpNews\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Owp\OwpCore\Model as OwpCommonTrait;
use Knp\DoctrineBehaviors\Model\Sluggable\Sluggable;

/**
 * @ORM\Entity(repositoryClass="Owp\OwpNews\Repository\NewsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class News
{
    use Sluggable;

    use OwpCommonTrait\IdTrait;
    use OwpCommonTrait\TitleTrait;
    use OwpCommonTrait\ContentTrait;
    use OwpCommonTrait\AuthorTrait;
    use OwpCommonTrait\PrivateTrait;

    /**
     * @ORM\Column(type="string", length=512)
     */
    protected $slug;

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
    
    public function getSluggableFields()
    {
        return [ 'id', 'title' ];
    }

    public function generateSlugValue($values)
    {
        return implode('-', str_replace(' ', '-', $values));
    }
}
