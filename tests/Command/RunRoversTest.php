<?php

namespace Tests\Command;

use App\Command\RunRovers;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

final class RunRoversTest extends TestCase
{
    /**
     * @var CommandTester
     */
    private $commandTester;

    /**
     * @dataProvider validExecuteDataProvider
     *
     * @param string $input
     * @param string $expectedResult
     */
    public function testExecute(string $input, string $expectedResult): void
    {
        $this->commandTester->execute([
            'command' => RunRovers::COMMAND_NAME,
            RunRovers::ARGUMENT_INPUT => $input
        ]);

        $this->assertEquals($expectedResult, $this->commandTester->getDisplay());
    }

    /**
     * @dataProvider invalidExecuteDataProvider
     *
     * @param string $input
     */
    public function testExecuteFailure(string $input): void
    {
        $this->expectException(\Exception::class);

        $this->commandTester->execute([
            'command' => RunRovers::COMMAND_NAME,
            RunRovers::ARGUMENT_INPUT => $input
        ]);
    }

    /**
     * @return array
     */
    public function validExecuteDataProvider(): array
    {
        return [
            [
                'input' => '5 5
                    1 2 N
                    LMLMLMLMM
                    3 3 E
                    MMRMMRMRRM',
                'expected' => '1 3 N' . PHP_EOL . '5 1 E'
            ],
            [
                'input' => '1 1
                    1 1 W
                    LLLL',
                'expected' => '1 1 W'
            ],
            [
                'input' => '10 10
                    0 0 N
                    MMMMRMMMMLMMMMMRMMMMM',
                'expected' => '9 9 E'
            ]
        ];
    }

    /**
     * @return array
     */
    public function invalidExecuteDataProvider(): array
    {
        return [
            [
                '1 1
                1 1 N
                M'
            ],
            [
                '5 5
                5 5 W
                RRM'
            ],
            [
                '1 10
                0 0 N
                MMMMMMMMMMM',
            ]
        ];
    }

    protected function setUp(): void
    {
        $application = new Application();
        $application->add(new RunRovers());

        $command = $application->find(RunRovers::COMMAND_NAME);

        $this->commandTester = new CommandTester($command);
    }
}
