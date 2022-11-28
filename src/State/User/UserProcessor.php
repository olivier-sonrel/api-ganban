<?php

namespace App\State;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


//TODO change by use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface
// look on https://symfony.com/doc/current/security/passwords.html

//TODO resolve ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface

class UserProcessor implements ProcessorInterface
{
    private $decorated;
    private $passwordHasher;

    public function __construct(
        ProcessorInterface $decorated,
        UserPasswordHasherInterface $passwordHasher,
    ) {
        $this->decorated = $decorated;
        $this->passwordHasher = $passwordHasher;
    }

    private function preparePassword(mixed $data): void
    {
        if ($data->getPlainPassword()) {
            $data->setPassword(
                $this->passwordHasher->hashPassword(
                    $data,
                    $data->getPlainPassword()
                )
            );
            $data->eraseCredentials();
        }
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $this->preparePassword($data);
        return $this->decorated->process($data, $operation, $uriVariables, $context);
    }
}