<?php
class C implements ArrayAccess
{
    public $xml;
    public $currentNode;

    function __construct($xml = '', $encoding = 'UTF-8')
    {
        $this->xml = new DOMDocument('1.0',$encoding);        
        $this->xml->loadXML($xml, LIBXML_NONET | LIBXML_COMPACT | LIBXML_NOENT);
        $this->currentNode = $this->xml;
    }

    function _GetNodesByPath($path)
    {
        $xp = new DOMXpath($this->xml);
        return  $xp->query($path);
    }

    function attr()
    {
        $node=$this->currentNode;
        for ($i = 0; $i <$node->attributes->length; ++$i) {
            $attr[$node->attributes->item($i)->name] = $node->attributes->item($i)->value;
        }
        return $attr;
    }

    function node($name)
    {
        $node = $this->_GetNodesByPath($name);
        $this->currentNode = $node;
        return $this;
    }

    public function offsetSet($offset, $value)
    {
    }

    public function offsetExists($offset)
    {
    }

    public function offsetUnset($offset)
    {
    }

    public function offsetGet($offset)
    {
        $this->currentNode=$this->currentNode->item($offset);
        return $this;
    }
}
