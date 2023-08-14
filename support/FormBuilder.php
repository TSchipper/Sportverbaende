<?php

class FormBuilder
{
    public static function buildFormHeader($headerIcon, $headertitle)
    {
        return (
            "<div class=\"card-header\">  
                <img class=\"listIcon\" src=\"".$headerIcon."\" title=\"".$headertitle."\">
                &nbsp;|&nbsp;".
                $headertitle.
            "</div>"
        );
    }

    public static function buildFormBody($body)
    {
        return (
            "<div class=\"card-body\">".
                $body.
            "</div>"
        );
    }

    public static function buildFormFooter($footer, $stdSubmit, $stdCommand)
    {
        return (
            "<div class=\"card-footer\">".
                $footer.
            "</div>"
        );
    }

    public static function buildForm($action, $method, $headerIcon, $headertitle, $formBody, $formFooter, $stdSubmit, $stdCommand)
    {
        return (
            "<div class=\"content\">
                <form action=\"".$action."\" method=\"".$method."\">
                    <div class=\"card\">".
                            self::buildFormHeader($headerIcon, $headertitle).
                            self::buildFormBody($formBody).
                            self::buildFormFooter($formFooter, $stdSubmit, $stdCommand).
                    "</div>
                </form>
            </div>"
        );
    }
}
