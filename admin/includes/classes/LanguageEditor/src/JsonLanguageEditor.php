<?php


namespace SoloMono\LanguageEditor;


/**
 * Class JsonLanguageEditor
 *
 * @package SoloMono\LanguageEditor
 */
class JsonLanguageEditor implements LanguageEditorInterface {

    /**
     * @inheritDoc
     */
    public function update($constants, $fileName) {
        $constants = array_map(function ($constantValue) {
            return $constantValue['new'];
        }, $constants);
        $parsedConstants = json_decode(file_get_contents($fileName), true);
        $mergedConstants = array_merge($parsedConstants, $constants);
        $jsonEncodedConstants = json_encode($mergedConstants, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($fileName, $jsonEncodedConstants);
    }

    /**
     * @inheritDoc
     */
    public function insert($constantName, $constantValue, $fileName) {
        $constants[$constantName] = $constantValue;
        $parsedConstants = json_decode(file_get_contents($fileName), true);

        if(isset($parsedConstants[$constantName])) {
            throw new ConstantAlreadyExistException($constantName);
        }

        $mergedConstants = array_merge($parsedConstants, $constants);
        $jsonEncodedConstants = json_encode($mergedConstants, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($fileName, $jsonEncodedConstants);
    }

    /**
     * @inheritDoc
     */
    public function parse($fileName) {
        $constants = file_get_contents($fileName);
        $parsedConstants = json_decode($constants, true);
        return array_map(function ($key, $val) {
            return [
                'const' => $key,
                'val'   => $val,
            ];
        }, array_keys($parsedConstants), $parsedConstants);
    }

    /**
     * @inheritDoc
     */
    public function getFileExtension() {
        return "json";
    }

}