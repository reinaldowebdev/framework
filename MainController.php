<?php
namespace fw;

class MainController
{
    protected $template = null;

    public function render($view, $options = [])
    {
        $viewInstance = new MainView();
        $viewInstance->template = $this->template;
        $className = get_called_class();
        $viewDirectory = strtolower(str_replace('Controller', '', str_replace('app\Controllers\\', '', $className)));
        return $viewInstance->render($view, $viewDirectory, $options);
    }
}
