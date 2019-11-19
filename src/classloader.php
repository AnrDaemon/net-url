<?php
/** Universal stackable classloader.
*
* @version SVN: $Id: classloader.php 1040 2019-11-19 23:23:52Z anrdaemon $
*/

namespace AnrDaemon;

return \call_user_func(
  function()
  {
    $nsl = \strlen(__NAMESPACE__);
    return \spl_autoload_register(
      function($className)
      use($nsl)
      {
        if(\strncmp($className, __NAMESPACE__, $nsl) !== 0)
          return;

        $className = \substr($className, $nsl);
        if($className[0] !== "\\")
          return;

        $path = __DIR__ . \strtr("$className.php", '\\', '/');
        if(\file_exists($path))
        {
          return include $path;
        }
      }
    );
  }
);
