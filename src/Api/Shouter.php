<?php

/**
 * Quutes shout API end point
 * 
 * @author Razvan Cornea
 */

namespace Quotes\API;
use Quotes\Common\ApiAbstract;

class Shouter extends ApiAbstract
{
    /**
     * GET limited quotes for a given author
     * 
     * @param string $id
     * @return array
     */
    protected function _get($id, array $data = [])
    {
        // Input data
        $author = $this->_sanitizeName($id);
        $quotes = [];
        $limit = empty($_GET['limit']) ? 0 : intval($_GET['limit']);

        // Iterate quotes
        foreach ($data as $item) {
            // Match author's quotes
            if (isset($item['author']) &&  isset($item['quote']) 
                    && $author === $this->_sanitizeName($item['author'])
            ) {
                $quotes[] = $this->_sanitizeQuote($item['quote']);

                // Limit matched author's quotes
                if ($limit && count($quotes) >= $limit) {
                    break;
                }
            }
        }

        return $quotes;
    }

    /**
     * Helper method to sanitize (author) name 
     * 
     * @return string
     */
    private function _sanitizeName($value) 
    {
        return strtolower(
            str_replace(' ', '-', trim($value, '-–')));
    }

    /**
     * Helper method to sanitize (author's) quotes 
     * 
     * @return string
     */
    private function _sanitizeQuote($value) 
    {
        return strtoupper(
            trim(preg_replace(array("/(‘|’)/", '/(“|”)/', "/\s+/"), array("'", '"', " "), $value)
                , '!?.')) 
            . '!';
    }
}