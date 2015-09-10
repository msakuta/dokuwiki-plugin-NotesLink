<?php
/**
 * Plugin NotesLink: Add links to URLs with Notes schema
 * 
 * @license    MIT License (https://opensource.org/licenses/MIT)
 * @author     Masahiro Sakuta <masahiro.sakuta@gmail.com>
 */

// must be run within DokuWiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_noteslink extends DokuWiki_Syntax_Plugin {
 
    function getType(){ return 'substition'; }
    function getSort(){ return 160; }
    function connectTo($mode) {
      $this->Lexer->addSpecialPattern('notes://[^\s]+',$mode,'plugin_noteslink');
      $this->Lexer->addSpecialPattern('Notes://[^\s]+',$mode,'plugin_noteslink');
    }

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler){
        return array($match, $state, $pos);
    }

    /**
     * Create output
     */
    function render($mode, &$renderer, $data) {
        if($mode == 'xhtml'){
            list($match, $state, $pos) = $data;
            $renderer->doc .= '<a href="' . $match . '">' . $match . '</a>';
            return true;
        }
        return false;
    }
}
?>
