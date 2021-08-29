<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateMediaFileCommand extends Command
{
    const COMMAND_NAME = 'app:create-media-file';

    private $s3;

    public function __construct()
    {
        parent::__construct();

        // Instantiate an Amazon S3 client.
        //$this->s3 = new S3Client(['version' => 'latest', 'region'  => 'eu-central-1']);
    }

    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription('Creates a new media file.')
            ->setHelp('Creates a new media file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('File successfully generated!');
    }
}