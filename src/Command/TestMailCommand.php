<?php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsCommand(
    name: 'app:test-mail',
    description: 'Send a test email'
)]
class TestMailCommand extends Command
{
    public function __construct(private MailerInterface $mailer)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = (new Email())
            ->from('no-reply@spotify.com')
            ->to('test@example.com')
            ->subject('Test email from Symfony')
            ->html('<h1>Hello from Symfony!</h1>');

        $this->mailer->send($email);

        $output->writeln('Test email sent.');

        return Command::SUCCESS;
    }
}
