<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use App\TranslationBundle\Translation\TranslationInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\Table(name="post")
 */
class Post implements EntityInterface //TranslatableInterface, TranslationInterface
{
    use TranslatableTrait;

    #region Fields

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $authorEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    #endregion

    #region Constructors

    public function __construct()
    {
        $this->publishedAt = new \DateTime();
    }

    #endregion

    #region Properties

    /**
     * @Groups({"post:id"})
     *
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @Groups({"post:default"})
     *
     */
    public function getAuthorEmail(): ?string
    {
        return $this->authorEmail;
    }

    public function setAuthorEmail(string $authorEmail): self
    {
        $this->authorEmail = $authorEmail;

        return $this;
    }

    public function getPublishedAt(): \DateTime
    {
        return $this->publishedAt;
    }

    public function setTranslatableProperties($lang, $value)
    {
        $this->translate($lang, false)->setTitle($value->title);
        $this->translate($lang, false)->setSlug($value->slug);
        $this->translate($lang, false)->setAuthorName($value->authorName);
        $this->translate($lang, false)->setPostText($value->postText);
    }

    /**
     * @SerializedName("translation")
     * @Groups({"post:default"})
     *
     * @return ArrayCollection
     */
    public function getTranslation()
    {
        return $this->getTranslations();
    }

    #endregion
}
