<?php

/**
 * Comment entity.
 */

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Comment.
 *
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ORM\Table(name: 'comments')]
class Comment
{
    /**
     * Primary key.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * Content.
     */
    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $content = null;

    /**
     * Nick.
     */
    #[ORM\Column(length: 64)]
    private ?string $nick = null;

    /**
     * Task.
     */
    #[ORM\ManyToOne(targetEntity: Task::class, fetch: 'EXTRA_LAZY', inversedBy: 'comments')]
    #[ORM\JoinColumn(name: 'task_id', referencedColumnName: 'id', nullable: false)]
    private $task;

    /**
     * User.
     */
    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    /**
     * Comment constructor.
     *
     * @param string $content The content of the comment
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Getter for the ID.
     *
     * @return int|null The ID
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for the content.
     *
     * @return string|null The content
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Setter for the content.
     *
     * @param string $content The content to set
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Getter for the author.
     *
     * @return User|null The author
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * Setter for the author.
     *
     * @param User|null $author The author to set
     */
    public function setAuthor(?User $author): void
    {
        $this->author = $author;
    }

    /**
     * Getter for the nickname.
     *
     * @return string|null The nickname
     */
    public function getNick(): ?string
    {
        return $this->nick;
    }

    /**
     * Setter for the nickname.
     *
     * @param string $nick The nickname to set
     */
    public function setNick(string $nick): void
    {
        $this->nick = $nick;
    }

    /**
     * Getter for the task.
     *
     * @return Task|null The task
     */
    public function getTask(): ?Task
    {
        return $this->task;
    }

    /**
     * Setter for the task.
     *
     * @param Task|null $task The task to set
     */
    public function setTask(?Task $task): void
    {
        $this->task = $task;
    }
}
