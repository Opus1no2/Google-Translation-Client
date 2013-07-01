<?php
/**
 *
 * Google Translation Client
 *
 * @author - Travis Tillotson <tillotson.travis@gmail.com>
 */
class Goolge_Translate
{
    const BASE = 'https://www.googleapis.com';
    const PATH = '/language/translate/';

    /**
     * @var string $version
     */
    public static $version = 'v2';
    
    /**
     * @var array $_query
     */
    private $_query;
    
    /**
     *
     * Get API key at instantiation
     *
     * @param string $key
     *
     * @return void
     */
    public function __construct($key)
    {
        $this->_query['key'] = (string)$key;
    }
    
    /**
     *
     * Method used to request a translation
     * 
     * @param array $params
     *
     * @return string
     */
    public function translate(array $params = array())
    {
        return $this->_execRequest($params);
    }
    
    /**
     *
     * Method used to detect available languages
     *
     * @param array $params
     *
     * @return string
     */
    public function detect(array $params = array())
    {
        return $this->_execRequest($params, 'detect');
    }
    
    /**
     *
     * Execute HTTP request
     *
     * @param string $url
     *
     * @return mixed
     */
    private function _request($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $out = curl_exec($ch);
        curl_close($ch);
        
        return $out;
    }
    
    /**
     *
     * Assemble URL and execute request
     *
     * @param array $params
     * @param mixed $endpoint
     *
     * @return string
     *
     * @throws RunTimeException
     */
    private function _execRequest($params, $endpoint=null)
    {
        $url = $this->_getUrl($params, $endpoint);
        
        $out = $this->_request($url);
        
        if ($out === false) {
            throw new RunTimeException(sprintf('cURL error: %s', curl_error($ch)));
        }
        return $out;
    }
    
    /**
     *
     * Assemble URL for HTTP request
     *
     * @param array $params
     * @param mixed $endpoint
     *
     * @return string
     */
    private function _getUrl($params, $endpoint)
    {
        $url = self::BASE . self::PATH . self::$version;
        $query = array_merge($this->_query, $params);
           
        if ($endpoint) {
            $url .= "/{$endpoint}/";
        }
        $url .= '?'.http_build_query($query);
        
        return self::validUrl($url);
    }
    
    /**
     *
     * Set targent language
     *
     * @param string $target
     *
     * @return Goolge_Translate
     */
    public function setTarget($target)
    {
        $this->_query['target'] = (string)$target;
        return $this;
    }
    
    /**
     *
     * Set source language
     *
     * @param string $src
     *
     * @return Goolge_Translate
     */
    public function setSource($src)
    {
        $this->_query['source'] = (string)$src;
        return $this;
    }
    
    /**
     *
     * Set text to be translated
     *
     * @param string $text
     *
     * @return Goolge_Translate
     */
    public function setText($text)
    {
        $this->_query['q'] = (string)$text;
        return $this;
    }
    
    /**
     *
     * Set javascript call back method
     *
     * @param string $callback
     *
     * @return Goolge_Translate
     */
    public function setCallBack($callback)
    {
        $this->_query['callback'] = $callback;
        return $this;
    }
    
    /**
     *
     * Set format for return data
     *
     * @param string $format | 'html' or 'text'
     *
     * @return Goolge_Translate
     */
    public function setFormat($format)
    {
        $this->_query['format'] = $format;
        return $this;
    }

    /**
     *
     * Set to return response with indentations and line breaks
     *
     * @param bool $bool
     *
     * @return Goolge_Translate
     */
    public function setPrettyPrint($bool)
    {
        $this->_query['prettyprint'] = $bool;
        return $this;
    }
        
    /**
     *
     * Used to validate URL before request
     *
     * @param string $url
     *
     * @return string
     *
     * @throws RunTimeException
     */
    public static function validUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }
        throw new RunTimeException(sprintf('Invalid URL: %s', $url));
    }
}