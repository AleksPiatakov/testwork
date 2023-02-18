<?php


namespace SoloMono\LanguageEditor;


use Exception;

/**
 * Class ConstantAlreadyExistException
 *
 * @package SoloMono\LanguageEditor
 */
class ConstantAlreadyExistException extends Exception {
    /**
     * ConstantAlreadyExistException constructor.
     *
     * @param string $constantName the name of constant
     */
    public function __construct($constantName) {
        parent::__construct("Constant $constantName already exists!");
    }
}