<?php


namespace SoloMono\LanguageEditor;


/**
 * Interface LanguageEditorInterface
 *
 * @package SoloMono\LanguageEditor
 */
interface LanguageEditorInterface {

    /**
     * @param array $constants the list of constant name => constant value pairs
     * @param string $fileName the name of the file to which the constants will be saved
     * @return void
     */
    public function update($constants, $fileName);

    /**
     * @param string $constantName the name of new constant
     * @param string $constantValue the value of new constant
     * @param string $fileName the name of the file to which the constant will be saved
     * @return void
     * @throws ConstantAlreadyExistException
     */
    public function insert($constantName, $constantValue, $fileName);

    /**
     * @param string $fileName the file name with constants for parsing
     * @return array the list of constants
     */
    public function parse($fileName);

    /**
     * @return string file extension
     */
    public function getFileExtension();

}