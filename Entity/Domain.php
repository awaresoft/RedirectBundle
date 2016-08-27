<?php

namespace Awaresoft\RedirectBundle\Entity;

use Awaresoft\Sonata\PageBundle\Entity\Site;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Awaresoft\TreeBundle\Entity\AbstractTreeNode;
use Sonata\ClassificationBundle\Model\TagInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="redirect__domain")
 * @ORM\Entity(repositoryClass="Awaresoft\RedirectBundle\Entity\Repository\DomainRepository")
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class Domain
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=512)
     *
     * @var string
     */
    protected $urlFrom;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     *
     * @var string
     */
    protected $urlTo;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     *
     * @var string
     */
    protected $generateMethod;

    /**
     * @ORM\Column(type="integer", length=3)
     *
     * @var int
     */
    protected $code;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    protected $validFrom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $validTo;

    /**
     * @ORM\Column(type="string", length=5)
     *
     * @var string
     */
    protected $locale;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getPathFrom()
    {
        return $this->urlFrom;
    }

    /**
     * @param string $urlFrom
     *
     * @return $this
     */
    public function setUrlFrom($urlFrom)
    {
        $this->urlFrom = $urlFrom;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrlTo()
    {
        return $this->urlTo;
    }

    /**
     * @param string $urlTo
     *
     * @return $this
     */
    public function setUrlTo($urlTo)
    {
        $this->urlTo = $urlTo;

        return $this;
    }

    /**
     * @return string
     */
    public function getGenerateMethod()
    {
        return $this->generateMethod;
    }

    /**
     * @param string $generateMethod
     *
     * @return Domain
     */
    public function setGenerateMethod($generateMethod)
    {
        $this->generateMethod = $generateMethod;

        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * @param \DateTime $validFrom
     *
     * @return $this
     */
    public function setValidFrom(\DateTime $validFrom = null)
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * @param \DateTime $validTo
     *
     * @return $this
     */
    public function setValidTo(\DateTime $validTo = null)
    {
        $this->validTo = $validTo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     *
     * @return Domain
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}