<?php
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;



if (! function_exists('asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function asset($path, $secure = null)
    {
//        return app('url')->asset($path, $secure);
        $package = new Package(new EmptyVersionStrategy());
        return $package->getUrl($path);
    }
}