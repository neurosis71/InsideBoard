<?php

namespace Insideboard\DbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {



        function libxml_display_error($error) {
            $return = "<br/>\n";
            switch ($error->level) {
                case LIBXML_ERR_WARNING:
                    $return .= "<b>Warning $error->code</b>: ";
                    break;
                case LIBXML_ERR_ERROR:
                    $return .= "<b>Error $error->code</b>: ";
                    break;
                case LIBXML_ERR_FATAL:
                    $return .= "<b>Fatal Error $error->code</b>: ";
                    break;
            }
            $return .= trim($error->message);
            if ($error->file) {
                $return .= " in <b>$error->file</b>";
            }
            $return .= " on line <b>$error->line</b>\n";

            return $return;
        }

        function libxml_display_errors($display_errors = true) {
            $errors = libxml_get_errors();
            $chain_errors = "";

            foreach ($errors as $error) {
                $chain_errors .= preg_replace('/( in\ \/(.*))/', », strip_tags(libxml_display_error($error))) . "\n";
                if ($display_errors) {
                    trigger_error(libxml_display_error($error), E_USER_WARNING);
                }
            }
            libxml_clear_errors();

            return $chain_errors;
        }

        // Activer "user error handling"
        libxml_use_internal_errors(true);

        $xml = new \DOMDocument();
        $xml->load($this->get('kernel')->getRootDir() . "/../src/integrated-data.xml");
        $validate = $xml->schemaValidate($this->get('kernel')->getRootDir() . "/../src/schema.xsd");

        if ($validate) {
            echo "<b>DOMDocument::schemaValidate() Valid schema !</b>";
        } else {
            echo "<b>DOMDocument::schemaValidate() Generated Errors !</b><br /><br />";
            libxml_display_errors();
        }
        
        die();

        //return $this->render('InsideboardDbBundle:Default:index.html.twig');
    }

}
