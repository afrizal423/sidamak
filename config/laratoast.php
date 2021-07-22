<?php
return [
    'options' => [
        "text" => '',
        "heading" => '',
        "icon" => '', // Warning, Success, Error, Information
        "showHideTransition" => 'fade', // fade, slide or plain
        "allowToastClose" => true, // Boolean value true or false
        "hideAfter" => 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
        "stack" => 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
        "position" => "bottom-left", // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
        "textAlign" => 'left',  // Text alignment i.e. left, right or center
        "loader" => true, // Whether to show loader or not. True by default
        "loaderBg" => "#9EC600", // Background color of the toast loader
        "beforeShow" => "", // will be triggered before the toast is shown
        "afterShown" => "", // will be triggered after the toat has been shown
        "beforeHide" => "", // will be triggered before the toast gets hidden
        "afterHidden" => ""  // will be triggered after the toast has been hidden
    ],
];
