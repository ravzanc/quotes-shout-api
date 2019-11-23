<?php

/**
 * Common API methods (GET|POST|PUT|DELETE)
 * 
 * @author Razvan Cornea
 */

namespace Quotes\Common;

abstract class ApiAbstract 
{
    /**
     * Instance
     *
     * @var Singleton
     */
    protected static $_instance;

    /**
     * Constructor
     *
     * @return void
     */
    protected function __construct() {}

    /**
     * Get instance
     *
     * @return Singleton
     */
    public final static function getInstance() 
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    /**
     * Process API request
     * 
     * @param string $requestMethod (GET|POST|PUT|DELETE)
     * @param string $requestId
     * @param array $requestData
     * @param boolean $sendHeader
     */
    public function processRequest($requestMethod, $requestId = null, array $requestData = [], $sendHeader = true)
    {
        $response = array(
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => null
        );

        switch ($requestMethod) {
            case 'GET':
                $response['body'] = $this->_get($requestId, $requestData);
                break;
            case 'POST':
                $response = $this->_create($requestData);
                break;
            case 'PUT':
                $response = $this->_update($requestId, $requestData);
                break;
            case 'DELETE':
                $response = $this->_delete($requestId);
                break;
            default:
                $response = $this->_notFoundResponse();
                break;
        }
        
        if ($sendHeader) {
            header($response['status_code_header']);
            echo json_encode($response['body']);
        }

        return json_encode($response['body']);
    }

    /**
     * GET data for id
     * 
     * @param string $id
     * @return array
     */
    protected function _get($id, array $data = [])
    {
        return [];
    }

    /**
     * CREATE data
     * 
     * @param array $data
     * @return boolean
     */
    protected function _create(array $data)
    {
        return false;
    }

    /**
     * UPDATE data for id
     * 
     * @param string $id
     * @param array $data
     * @return boolean
     */
    protected function _update($id, array $data)
    {
        return false;
    }

    /**
     * Delete data for id
     * 
     * @param string $id
     * @return boolean
     */
    protected function _delete($id)
    {
        return false;
    }

    /**
     * HTTP NOT FOUND
     */
    private function _notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}