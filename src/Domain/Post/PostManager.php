<?php

declare(strict_types=1);

namespace Domain\Post;

use App\Entity\Post;
use Carbon\CarbonImmutable;
use Doctrine\ORM\EntityManagerInterface;

final class PostManager
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function addPost(string $title, string $content): void
    {
        $post = new Post();

        $post->setTitle($title);
        $post->setContent($content);

        $this->em->persist($post);
        $this->em->flush();
    }

    public function addSummaryPost(string $content, CarbonImmutable $dateTime): void
    {
        $post = new Post();

        $post->setTitle("Summary {$dateTime->format('Y-m-d')}");
        $post->setContent($content);

        $this->em->persist($post);
        $this->em->flush();
    }

    public function findPost(int $id): Post
    {
        $postRepository = $this->em->getRepository(Post::class);

        return $postRepository->findOneBy(['id' => $id]);
    }
}
