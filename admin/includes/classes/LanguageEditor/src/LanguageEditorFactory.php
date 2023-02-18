<?php


namespace SoloMono\LanguageEditor;


/**
 * Class LanguageEditorFactory
 *
 * @package SoloMono\LanguageEditor
 */
class LanguageEditorFactory {

    /**
     * Create language editor instance
     *
     * @param string $webSitePart
     * @return LanguageEditorInterface
     */
    public static function create($webSitePart) {
        if ($webSitePart === "admin") {
            return new PHPLanguageEditor();
        }
        return new JsonLanguageEditor();
    }

}