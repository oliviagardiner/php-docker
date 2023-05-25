<?php

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs ;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'users')]
#[HasLifecycleCallbacks]
final class User
{

    #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'string', unique: true, nullable: false)]
    private string $email;

    #[Column(type: 'string'), ]
    private string $passwordHash;

    #[Column(name: 'created', type: 'datetimetz_immutable', nullable: false)]
    private DateTimeImmutable $created;

    #[Column(name: 'updated', type: 'datetimetz_immutable', nullable: false)]
    private DateTimeImmutable $updated;

    #[PrePersist]
    public function prePersist(PrePersistEventArgs $eventArgs): void
    {
        $this->setCreated(new DateTimeImmutable('now'));
    }
    
    #[PreUpdate]
    public function preUpdate(PreUpdateEventArgs $eventArgs): void
    {
        $this->setUpdated(new DateTimeImmutable('now'));
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPasswordHash(string $hash): self
    {
        $this->passwordHash = $hash;
        return $this;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setCreated(DateTimeImmutable $date): self
    {
        $this->created = $date;
        return $this;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function setUpdated(DateTimeImmutable $date): self
    {
        $this->updated = $date;
        return $this;
    }

    public function getUpdated(): DateTimeImmutable
    {
        return $this->updated;
    }
}
