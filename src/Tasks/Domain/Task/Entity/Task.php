<?php

namespace App\Tasks\Domain\Task\Entity;

use App\Authentication\Domain\User\Entity\User;
use App\Tasks\Domain\Task\Repository\TaskRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 * @ORM\Table(name="tasks")
 */
class Task
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DONE = 'done';

    /**
     * @var Uuid
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="uuid", unique=true, nullable=false)
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tasks")
     * @ORM\Column(name="user_id", type="uuid", nullable=false)
     */
    private User $user;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private DateTime $date;

    /**
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private string $status;

    /**
     * Task constructor.
     * @param User $user
     * @param string $name
     * @param DateTime $date
     * @param string $status
     */
    public function __construct(User $user, string $name, DateTime $date, string $status = self::STATUS_ACTIVE)
    {
        $this->id = Uuid::uuid4();
        $this->user = $user;
        $this->name = $name;
        $this->date = $date;
        $this->status = $status;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status = self::STATUS_ACTIVE): void
    {
        $this->status = $status;
    }
}
