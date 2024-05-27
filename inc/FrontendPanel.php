<?php
namespace AT_Assistant;

/**
 * This class using for manage all Admin raleted class 
 * @FrotnendPanel
 */
class FrontendPanel {
    function __construct(){

        /**
         * Handles frontend asset enqueueing.
         * Frontend All endquee class
         */        
        new Frontend\FrontendEnqueue();  

        /**
         * Handles DOM manipulation for views.
         * Dom Mange class
         */
        new Frontend\views\DomHandle();
        
    }
}
