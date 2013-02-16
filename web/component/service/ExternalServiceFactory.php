<?php

/**
 * Helps to create external services instances.
 * Use this factory if you need to create instance to work with external services.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class ExternalServiceFactory {

    // -----------------------------------------------
    // Public methods
    // -----------------------------------------------

    /**
     * Creates FlikrService object.
     *
     * @return ExternalService
     */
    public function createFlikrService() {
        return new FlikrService();
    }

    /**
     * Creates InstagramService object.
     *
     * @return ExternalService
     */
    public function createInstagramService() {
        return new InstagramService();
    }

    // -----------------------------------------------
    // Singleton pattern
    // -----------------------------------------------

    private static $instance;

    private function ExternalServiceFactory() { }

    public static function getInstance() {
        if (self::$instance == null)
            self::$instance = new ExternalServiceFactory();
        return self::$instance;
    }

}