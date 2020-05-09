<?php

/**
 * Factory
 * 
 * Generate Wallet class with connection.
 * 
 * @author Gemblue
 */

namespace Gemblue\TinyWallet;

class Factory {

    /** Singleton container */
    public static $instance = null;

    /**
     * Get instance with Singleton.
     */
    public static function getInstance(array $config) : object {
        
        if (self::$instance == null) {
            self::$instance = new Wallet($config);
        } 

        return self::$instance;
    }
}

