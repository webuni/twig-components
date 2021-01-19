<?php

declare(strict_types=1);

/*
 * This is part of the webuni/twig-components package.
 *
 * (c) Martin Hasoň <martin.hason@gmail.com>
 * (c) Webuni s.r.o. <info@webuni.cz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webuni\TwigComponents\Tests\Twig;

use PhpUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class EmbedTest extends TestCase
{
    private $loader;
    private $twig;

    protected function setUp(): void
    {
        $this->loader = new FilesystemLoader();
        $this->twig = new Environment($this->loader, ['strict_variables' => true, 'cache' => __DIR__]);
    }

    public function testVariableScope(): void
    {
        $path = __DIR__.'/../fixtures/embed_variable_scope';
        $this->loader->setPaths([$path]);

        $content = $this->twig->render('index.twig');
        $this->assertStringEqualsFile($path.'/result.txt', $content);
    }
}
