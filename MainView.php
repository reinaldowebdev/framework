<?php
namespace fw;

use Exception;

class MainView
{
    const PATH_VIEWS = __DIR__  . '/../../app/Views';
    const DEFAULT_TEMPLATE = self::PATH_VIEWS . '/templates/main.php';

    public $template;
    public $title;

    public function render(string $file, string $viewDirectory, array $options)
    {
        $file = $file . '.php';
        if (empty($this->searchFile($file, $viewDirectory))) {
            throw new Exception('View not found');
        }

        ob_start();
        if (!empty($options)) {
            extract($options);
        }
        include self::PATH_VIEWS . '/' . $viewDirectory . '/' . $file;
        $content = ob_get_clean();

        ob_start();
        if ($this->template !== null) {
            // render template
        } else {
            require_once self::DEFAULT_TEMPLATE;
        }
        return ob_get_clean();
    }

    private function searchFile(string $file, string $viewDirectory) : ?string
    {
        $path = self::PATH_VIEWS . '/' . $viewDirectory;
        $files = scandir(self::PATH_VIEWS . '/' . $viewDirectory);
        return in_array($file, $files) ? $path : null;
    }
}
