<?php
class Render_TokenParser extends Twig_TokenParser
{
    public function parse(Twig_Token $token) {
      $expr = $this->parser->getExpressionParser()->parseExpression();
      list($variables) = $this->parseArguments();
      return new Render_Node($expr,
                             $variables,
                             $token->getLine(),
                             $this->getTag()
                            );
    }

    protected function parseArguments() {
       $stream = $this->parser->getStream();
       $variables = null;
       if ($stream->nextIf(Twig_Token::PUNCTUATION_TYPE, ',')) {
           $variables = $this->parser->getExpressionParser()->parseExpression();
       }
       $stream->expect(Twig_Token::BLOCK_END_TYPE);
       return array($variables);
    }


    public function getTag() {
        return 'render';
    }
}


/**
 * Represents an include node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @source https://github.com/twigphp/Twig/blob/1.x/lib/Twig/Node/Include.php
 */
class Render_Node extends Twig_Node implements Twig_NodeOutputInterface {
    public function __construct(Twig_Node_Expression $expr,
                                Twig_Node_Expression $variables = null,
                                $lineno,
                                $tag = null) {

        parent::__construct(array('expr' => $expr,
                                  'variables' => $variables),
                           [],
                           $lineno,
                           $tag);

    }

    public function compile(Twig_Compiler $compiler) {
        $compiler->addDebugInfo($this);
        $this->addGetTemplate($compiler);
        $compiler->raw('->display(');
        $this->addTemplateArguments($compiler);
        $compiler->raw(");\n");
    }
    protected function addGetTemplate(Twig_Compiler $compiler)
    {

      $name = $this->getNode('expr')->getAttribute('value');
      // if $name begins with @ pop that off
      if($name{0} == '@') {
        $name = substr($name, 1);
      }

      $compiler
           ->write('$this->loadTemplate(\'' . $name . '/' . $name . '.twig\'')
           ->raw(', ')
           ->repr($compiler->getFilename())
           ->raw(', ')
           ->repr($this->getLine())
           ->raw(')');
    }
    /**
     *  Extends the include function but parses fractal files
     */
    protected function addTemplateArguments(Twig_Compiler $compiler)
    {
        if (null === $this->getNode('variables')) {
            $compiler->raw('$context');
        } else {
            $compiler->subcompile($this->getNode('variables'));
        }
    }
}

?>
