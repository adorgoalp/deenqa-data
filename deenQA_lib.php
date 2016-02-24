<?php
class QA{
    var $question;
    var $answer;
    var $questionBy;
    var $answeredBy;
    var $hidden;
    function __construct($question, $answer, $questionBy, $answeredBy, $hidden) {
        $this->question = $question;
        $this->answer = $answer;
        $this->questionBy = $questionBy;
        $this->answeredBy = $answeredBy;
        $this->hidden = $hidden;
    }
    function getQuestion() {
        return $this->question;
    }

    function getAnswer() {
        return $this->answer;
    }

    function getQuestionBy() {
        return $this->questionBy;
    }

    function getAnsweredBy() {
        return $this->answeredBy;
    }

    function getHidden() {
        return $this->hidden;
    }

    function setQuestion($question) {
        $this->question = $question;
    }

    function setAnswer($answer) {
        $this->answer = $answer;
    }

    function setQuestionBy($questionBy) {
        $this->questionBy = $questionBy;
    }

    function setAnsweredBy($answeredBy) {
        $this->answeredBy = $answeredBy;
    }

    function setHidden($hidden) {
        $this->hidden = $hidden;
    }



}