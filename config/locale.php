<?php

return [

    /*
     * Whether or not to show the language picker, or just default to the default
     * locale specified in the app config file
     *
     * @var bool
     */
    'status'    => true,

    /*
     * Available languages
     *
     * Add your language code to this array.
     * The code must have the same name as the language folder.
     * Be sure to add the new language in an alphabetical order.
     *
     * The language picker will not be available if there is only one language option
     * Commenting out languages will make them unavailable to the user
     *
     * @var array
     */
    'languages' => [
        /*
         * Key is the Laravel locale code
         * Index 0 of sub-array is the Carbon locale code
         * Index 1 of sub-array is the PHP locale code for setlocale()
         * Index 2 of sub-array is full language name
         * Index 3 of sub-array is whether or not to use RTL (right-to-left) html direction for this language
         * Index 4 of sub-array is show or not language
         */
        //'de' => ['de', 'de_DE', 'German', false, true],
        'ru' => ['ru', 'ru-RU', 'Russian', false, true],
        'en' => ['en', 'en_US', 'English', false, true],
        //'ar' => ['ar', 'ar-AR', 'Arabian', true, true],
        //'zh' => ['zh', 'zh-ZH', 'Chinese', false, true],
        //'fr' => ['fr', 'fr-FR', 'French', false, true],
        //'pl' => ['pl', 'pl-PL', 'Polish', false, true],
    ],
];
