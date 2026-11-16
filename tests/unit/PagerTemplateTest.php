<?php

use CodeIgniter\Pager\PagerRenderer;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\HTTP\URI;

/**
 * @internal
 */
final class PagerTemplateTest extends CIUnitTestCase
{
    public function testDefaultTemplatesAreRegisteredAndPreservePageFilters(): void
    {
        $config = config('Pager');

        $this->assertSame('App\Views\pagers\default_full', $config->templates['default_full']);
        $this->assertSame('App\Views\pagers\default_simple', $config->templates['default_simple']);

        $html = $this->renderPager('default_full', 2, 3, 45);

        $this->assertStringContainsString('keyword=users&amp;page=1', $html);
        $this->assertStringContainsString('keyword=users&amp;page=3', $html);
        $this->assertStringContainsString('aria-current="page">2', $html);
        $this->assertStringContainsString('&laquo; Previous', $html);
        $this->assertStringContainsString('Next &raquo;', $html);
    }

    public function testFullPagerDisablesNavigationAtBothBoundaries(): void
    {
        $firstPage = $this->renderPager('default_full', 1, 3, 45);
        $lastPage  = $this->renderPager('default_full', 3, 3, 45);

        $this->assertStringContainsString('aria-disabled="true">&laquo; Previous', $firstPage);
        $this->assertStringContainsString('aria-disabled="true">Next &raquo;', $lastPage);
    }

    public function testSimplePagerRendersOnlyPreviousAndNext(): void
    {
        $html = $this->renderPager('default_simple', 2, 3, 45);

        $this->assertStringContainsString('page=1', $html);
        $this->assertStringContainsString('page=3', $html);
        $this->assertStringNotContainsString('aria-current="page"', $html);
    }

    public function testFullPagerHandlesEmptyAndSinglePageResults(): void
    {
        $empty = $this->renderPager('default_full', 0, 0, 0);
        $single = $this->renderPager('default_full', 1, 1, 5);

        $this->assertStringNotContainsString('<nav', $empty);
        $this->assertStringContainsString('aria-current="page">1', $single);
        $this->assertStringNotContainsString('Previous', $single);
        $this->assertStringNotContainsString('Next', $single);
    }

    private function renderPager(string $template, int $currentPage, int $pageCount, int $total): string
    {
        $pager = new PagerRenderer([
            'currentPage' => $currentPage,
            'total' => $total,
            'pageCount' => $pageCount,
            'uri' => new URI('http://example.com/permissions?keyword=users'),
            'pageSelector' => 'page',
            'perPage' => 15,
        ]);

        return service('renderer')
            ->setVar('pager', $pager)
            ->render('pagers/' . $template);
    }
}
