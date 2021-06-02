<?php
namespace ConvertCli;

use ConvertCli\Command\CommandCall;

interface ControllerInterface
{
    /**
     * Called before `run`
     * @param App $app
     */
    public function boot(App $app);

    /**
     * Main execution
     * @param CommandCall $input
     */
    public function run(CommandCall $input);

    /**
     * Called when `run` is successfully finished.
     * @return void
     */
    public function teardown();
}