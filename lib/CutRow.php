<?php

namespace Lib;

use Lib\Constants as Constants;

/**
 * CutRow class
 * 
 * @author Niesuch
 */
class CutRow {

    /**
     * Number of characters in row
     * @var int
     */
    private $_charsInRow;

    /**
     * Text to be parse
     * @var string 
     */
    private $_text;

    /**
     * Current sum in row
     * @var int 
     */
    private $_sum;

    /**
     * Parsed text
     * @var string
     */
    private $_parsedText;

    /**
     * Check is next step is new row
     * @var bool
     */
    private $_isNewRow;

    /**
     * Class constructor 
     */
    public function __construct() {
        $this->_charsInRow = Constants::CHARS_IN_ROW;
        $this->_parsedText = '';
        $this->_isNewRow = false;
        $this->_sum = 0;
    }

    /**
     * Method parses written text using user options
     */
    public function run() {
        foreach (explode(' ', $this->_text) as $word) {
            $length = mb_strlen($word);
            $this->_sum += $length;

            // word that has more characters than value set in charsInRow
            if ($length >= $this->_charsInRow) {
                $this->_sum = 0;
                $this->_parsedText .= (($this->_isNewRow ? '' : Constants::NEW_LINE) . $word . Constants::NEW_LINE);
                $this->_isNewRow = true;
                continue;
                // sum of characters is greater than value set in charsInRow
            } else if ($this->_sum > $this->_charsInRow) {
                $this->_sum = $length + 1;
                $this->_parsedText .= (Constants::NEW_LINE . $word . Constants::SPACE);
                // other ...
            } else {
                $this->_sum += 1;
                $this->_parsedText .= ($word . Constants::SPACE);
            }
            $this->_isNewRow = false;
        }
    }

    /**
     * Method returns number of characters in row
     * @return int
     */
    public function getCharsInRow() {
        return $this->_charsInRow;
    }

    /**
     * Method returns text to be parsed
     * @return string
     */
    public function getText() {
        return $this->_text;
    }

    /**
     * Method returns parsed text
     * @return string
     */
    public function getParsedText() {
        return $this->_parsedText;
    }

    /**
     * Method sets value of number of characters in row
     * @param int $value
     */
    public function setCharsInRow($value) {
        if ($value < Constants::MIN_CHARS_IN_ROW) {
            trigger_error('Min "number of characters in row" should be ' . Constants::MIN_CHARS_IN_ROW . '.', E_USER_ERROR);
        }

        $this->_charsInRow = $value;
    }

    /**
     * Method sets value of the text to be parsed
     * @param string $value
     */
    public function setText($value) {
        $this->_text = $value;
    }

}
