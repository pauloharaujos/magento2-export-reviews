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

use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
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
    const FILE_PATH = 'approved_reviews_export.csv';
    /**
     * @var ReviewInterfaceFactory
     */
    private ReviewInterfaceFactory $reviewInterfaceFactory;

    /**
     * @var State
     */
    private State $appState;

    /**
     * @var WriteInterface
     */
    private WriteInterface $directory;

    /**
     * Import constructor.
     * @param ReviewInterfaceFactory $reviewInterfaceFactory
     * @param State $appState
     * @param Filesystem $filesystem
     * @throws FileSystemException
     */
    public function __construct(
        ReviewInterfaceFactory $reviewInterfaceFactory,
        State $appState,
        Filesystem $filesystem
    )
    {
        parent::__construct();
        $this->appState = $appState;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
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
     * @return void
     * @throws LocalizedException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->areaCodeFix();
        $output->writeln("Starting the export...");

        $this->directory->create('export');
        $stream = $this->directory->openFile(self::FILE_PATH, 'w+');
        $stream->lock();
        $header = ['review_id', 'status_id', 'title', 'detail', 'rating_summary', 'sku'];
        $stream->writeCsv($header);

        /** @var ReviewInterface $reviews */
        $reviews = $this->reviewInterfaceFactory->create();

        foreach($reviews->getReviews() as $review):
            $data = [];
            $data[] = $review['review_id'];
            $data[] = $review['status_id'];
            $data[] = $review['title'];
            $data[] = $review['detail'];
            $data[] = $review['rating_summary'];
            $data[] = $review['sku'];
            $stream->writeCsv($data);
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
