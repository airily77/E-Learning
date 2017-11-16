<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 15.11.2017
 * Time: 10.09
 */

namespace database\connectors;


class Question{
    var $question;
    var $options;
    var $correctanwser;

    public function __construct($question, $options, $correctanwser){
        $this->question=$question;
        $this->options= $options;
        $this->correctanwser = $correctanwser;
    }

   /* function Question($question,$options,$correctanwser){
        this.$question =$question;
        this.$options = $options;
        this.$correctanwser = $correctanwser;
    }*/
    /**
     * @return mixed
     */
    public function getCorrectanwser(){
        return $this->correctanwser;
    }
    /**
     * @return mixed
     */
    public function getOptions(){
        return $this->options;
    }
    /**
     * @return mixed
     */
    public function getQuestion(){
        return $this->question;
    }
}