<?php
/**
 * DokuWiki Plugin dontfeedtemplates (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Cilyan Olowen <gaknar@gmail.com>
 */

if(!defined('DOKU_INC')) die();

class action_plugin_dontfeedtemplates extends DokuWiki_Action_Plugin {
    
    /**
     * Initialise the template inside constructor rather than in register,
     * to keep things clean.
     */
    public function __construct() {
        /* Load defaults from configuration */
        /*    template name for current namespace */
        $this->current_pagename_tpl   = 
            $this->GetConf("current_pagename_tpl");
        /*    template name for current and child namespaces */
        $this->inherited_pagename_tpl = 
            $this->GetConf("inherited_pagename_tpl");
        /*    filtering is active */
        $this->active = $this->GetConf("always");
        /* Replace defaults with parameters from templatepagename */
        if (!plugin_isdisabled('templatepagename')) {
            $templatepagename =& plugin_load('action', 'templatepagename_TemplatePageName');
            $this->current_pagename_tpl   = 
                $templatepagename->getConf('current_pagename_tpl');
            $this->inherited_pagename_tpl = 
                $templatepagename->getConf('inherited_pagename_tpl');
            /* When templatepagename is active, this plugin is always active */
            /* no-config pattern. The right way to force the plugin to not   */
            /* filter is to deactivate it.                                   */
            $this->active = true;
        }
    }
    
    /**
     * Registers handle_feed_item_add for FEED_ITEM_ADD:BEFORE
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     * @return void
     */
    public function register(Doku_Event_Handler &$controller) {
        if ($this->active) {
            $controller->register_hook(
                'FEED_ITEM_ADD', 'BEFORE',
                $this, 'handle_feed_item_add'
            );
        }
    }

    /**
     * Filter out template pages from namespace listings
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  [the parameters passed as fifth argument to register_hook() when this
     *                           handler was registered]
     * @return void
     */

    public function handle_feed_item_add(Doku_Event &$event, $param) {
        /* Only in list namespace mode */
        if ($event->data['opt']['feed_mode'] == "list") {
            /* Get the page name (strip out namespace part) */
            $id = $event->data['ditem']['id'];
            $pagename = $id;
            $pos = strrpos((string)$id,':');
            if($pos!==false){
                $pagename = substr((string)$id,$pos+1);
            }
            /* Filter out current_pagename_tpl */
            if ($pagename == $this->current_pagename_tpl) {
                $event->preventDefault();
                $event->stopPropagation();
                $event->result = false;
                return;
            }
            /* Filter out inherited_pagename_tpl */
            if ($pagename == $this->inherited_pagename_tpl) {
                $event->preventDefault();
                $event->stopPropagation();
                $event->result = false;
                return;
            }
            /* The item is conform, it can be processed */
        }
    }

}

// vim:ts=4:sw=4:et:
