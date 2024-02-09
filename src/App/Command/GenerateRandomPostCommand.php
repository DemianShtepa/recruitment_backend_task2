<?php

declare(strict_types=1);

namespace App\Command;

use Carbon\FactoryImmutable;
use Domain\Post\PostManager;
use joshtronic\LoremIpsum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateRandomPostCommand extends Command
{
    protected static $defaultName = 'app:generate-random-post';
    protected static $defaultDescription = 'Run app:generate-random-post';

    private LoremIpsum $loremIpsum;
    private PostManager $postManager;
    private FactoryImmutable $factoryImmutable;

    public function __construct(
        PostManager $postManager,
        FactoryImmutable $factoryImmutable,
        LoremIpsum $loremIpsum,
        string $name = null
    ) {
        parent::__construct($name);
        $this->postManager = $postManager;
        $this->loremIpsum = $loremIpsum;
        $this->factoryImmutable = $factoryImmutable;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $content = $this->loremIpsum->paragraphs();

        $this->postManager->addSummaryPost($content, $this->factoryImmutable->now());

        $output->writeln('A random post has been generated.');

        return Command::SUCCESS;
    }
}
