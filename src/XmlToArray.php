<?php

declare(strict_types=1);

namespace Vyuldashev\XmlToArray;

use DOMAttr;
use DOMText;
use DOMElement;
use DOMDocument;
use DOMCdataSection;
use DOMNamedNodeMap;

class XmlToArray
{
    protected $document;

    public function __construct(string $xml)
    {
        $this->document = new DOMDocument();
        $this->document->loadXML($xml);
    }

    public static function convert(string $xml): array
    {
        $converter = new static($xml);

        return $converter->toArray();
    }

    protected function convertAttributes(DOMNamedNodeMap $nodeMap): ?array
    {
        if ($nodeMap->length === 0) {
            return null;
        }

        $result = [];

        /** @var DOMAttr $item */
        foreach ($nodeMap as $item) {
            $result[$item->name] = $item->value;
        }

        return ['_attributes' => $result];
    }

    protected function convertDomElement(DOMElement $element)
    {
        $result = $this->convertAttributes($element->attributes);

        foreach ($element->childNodes as $node) {
            if ($node instanceof DOMCdataSection) {
                $result['_cdata'] = $node->data;

                continue;
            }
            if ($node instanceof DOMText) {
                $result = $node->textContent;

                continue;
            }
            if ($node instanceof DOMElement) {
                $result[$node->nodeName] = $this->convertDomElement($node);

                continue;
            }
        }

        return $result;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->document->hasChildNodes()) {
            $children = $this->document->childNodes;

            foreach ($children as $child) {
                $result[$child->nodeName] = $this->convertDomElement($child);
            }
        }

        return $result;
    }
}
