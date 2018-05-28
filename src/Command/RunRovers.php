<?php

namespace App\Command;

use App\Collection\RoverCollection;
use App\Entity\Position;
use App\Entity\Rover;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class RunRovers extends Command
{
    public const COMMAND_NAME = 'run-rovers';

    public const ARGUMENT_INPUT = 'input';

    protected function configure(): void
    {
        $this->setName(self::COMMAND_NAME)
            ->setDescription('Runs given rovers on a plateau and returns their destination positions.')
            ->addArgument(
                self::ARGUMENT_INPUT,
                InputArgument::REQUIRED,
                'Information about plateau size, rovers initial positions and movements.'
            );
    }

    /**
     * Here is all the magic happens - we just form rovers entities and ask them to move. I wanted to wrap it into a
     * service for reusability but here is only one iterator in fact.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $simulationInfo = $input->getArgument(self::ARGUMENT_INPUT);
        $runRoversInputTransformer = new RunRoversInputTransformer($simulationInfo);
        $rovers = $runRoversInputTransformer->getRoversFromInput();

        /** @var Rover $rover */
        foreach ($rovers as $rover) {
            $rover->makeMoves();
        }

        $output->write($this->getResponse($rovers));
    }

    /**
     * @param RoverCollection $rovers
     * @return string
     */
    private function getResponse(RoverCollection $rovers)
    {
        $positions = [];

        foreach ($rovers as $rover) {
            $positions[] = $this->getFormattedPosition($rover->getPosition());
        }

        return implode($positions, PHP_EOL);
    }

    /**
     * @param Position $position
     * @return string like '1 5 W'
     */
    private function getFormattedPosition(Position $position)
    {
        return sprintf('%s %s %s', $position->getX(), $position->getY(), $position->getDirection());
    }
}
