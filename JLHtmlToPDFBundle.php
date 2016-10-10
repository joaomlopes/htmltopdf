<?php

namespace joaomlopes\HtmlToPDFBundle;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JLHtmlToPDFBundle extends Bundle
{
    /**
     *
     */
    public function boot()
    {
        if(!$this->container->hasParameter('jl_html_to_pdf.tcpdf')) {
            return;
        }

        $config = $this->container->getParameter('jl_html_to_pdf.tcpdf');

        if ($config['tcpdf_external_config'])
        {
            foreach ($config as $k => $v)
            {
                $constKey = strtoupper($k);

                // All K_ constants are required
                if (preg_match("/^k_/i", $k))
                {
                    if (!defined($constKey))
                    {
                        $value = $this->container->getParameterBag()->resolveValue($v);

                        if (($k === 'tcpdf_path_cache' || $k === 'tcpdf_path_url_cache') && !is_dir($value)) {
                            $this->mkCacheDir($value);
                        }

                        define($constKey, $value);
                    }
                }
            }
        }
    }

    /**
     * Create a directory
     *
     * @param string $filePath
     *
     * @throws \RuntimeException
     */
    private function mkCacheDir($filePath)
    {
        $filesystem = new Filesystem();
        if (false === $filesystem->mkdir($filePath)) {
            throw new \RuntimeException(sprintf(
              'Could not create directory %s', $filePath
            ));
        }
    }
}
