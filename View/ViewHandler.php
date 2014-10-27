<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\View;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface,
    Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ViewHandler implements ViewHandlerInterface
{
    /*
     * @var EngineInterface
     */
    protected $templating;
    
    /*
     * @var array
     */
    protected $layouts;
    
    /*
     * @var array
     */
    protected $templates;
    
    /**
     * Constructs a view handler.
     *
     * @param EngineInterface The engine
     */
    public function __construct(EngineInterface $templating, array $layouts = array(), array $templates = array())
    {
        $this->templating = $templating;
        
        $this->layouts = array_replace_recursive(array(
            'default' => '::base.html.twig'
        ), $layouts);

        $this->templates = array_replace_recursive(array(
            'list' => array('layout'=> 'base', 'name' => 'XideaProductBundle:Product/List:list.html.twig'),
            'create' => array('layout'=> 'base', 'name' => 'XideaProductBundle:Product/Create:create.html.twig'),
            'create_form' => array('layout'=> 'base', 'name' => 'XideaProductBundle:Product/Create:form.html.twig'),
            'view' => array('layout'=> 'base', 'name' => 'XideaProductBundle:Product/View:view.html.twig'),
        ), $templates);
    }

    /**
     * {@inheritdoc}
     */
    public function handle($view, array $parameters = array())
    {
        $template = $this->templates[$view];
        $parameters['layout'] = isset($this->layouts[$template['layout']]) ? $this->layouts[$template['layout']] : $this->layouts['default'];

        return $this->templating->renderResponse($template['name'], $parameters);
    }
    
    public function createRedirectResponse($url, $status = 302, $headers = array())
    {
        return new RedirectResponse($url, $status, $headers);
    }
}
