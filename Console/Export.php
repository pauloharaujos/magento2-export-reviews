<?php

/**
 * Export Reviews Extension by Paulo Henrique Araujo da Silva
 *
 * @category  PHAS
 * @package   PHAS_ExportReviews
 * @author    Paulo Henrique Araujo da Silva <pauloharaujos@gmail.com>
 * @copyright Copyright (c) 2022 Paulo Henrique Araujo da Silva (https://github.com/pauloharaujos)
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=1);

namespace PHAS\ExportReviews\Console;

use PHAS\ExportReviews\Api\Data\ReviewInterface;
use PHAS\ExportReviews\Api\Data\ReviewInterfaceFactory;
use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use Magento\Framework\Exception\LocalizedException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Export extends Command
{
    /**
     * @var ReviewInterfaceFactory
     */
    private ReviewInterfaceFactory $reviewInterfaceFactory;

    /**
     * @var State
     */
    private State $appState;

    /**
     * Import constructor.
     * @param ReviewInterfaceFactory $review
     * @param State $appState
     */
    public function __construct(ReviewInterfaceFactory $reviewInterfaceFactory, State $appState)
    {
        $this->appState = $appState;
        parent::__construct();
        $this->reviewInterfaceFactory = $reviewInterfaceFactory;
    }

    /**
     * Configure cli command
     */
    protected function configure()
    {
        $this->setName('phas:export_reviews');
        $this->setDescription('Export Product Reviews.');
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws LocalizedException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->areaCodeFix();
        $output->writeln("Starting the export...");

        /** @var ReviewInterface $reviews */
        $reviews = $this->reviewInterfaceFactory->create();

        foreach($reviews->getReviews() as $review):
            $output->writeln($review);
        endforeach;

        $output->writeln("Export finished...");
    }

    /**
     * @throws LocalizedException
     */
    protected function areaCodeFix()
    {
        try {
            $this->appState->getAreaCode();
        } catch (\Exception $exception) {
            $this->appState->setAreaCode(Area::AREA_GLOBAL);
        }
    }
}
