<?php
class QA{
    var $title;
    var $question;
    var $answer;
    var $questionBy;
    var $answeredBy;
    var $hidden;
    var $category;
    function __construct($title, $question, $answer, $questionBy, $answeredBy, $hidden, $category) {
        $this->title = $title;
        $this->question = $question;
        $this->answer = $answer;
        $this->questionBy = $questionBy;
        $this->answeredBy = $answeredBy;
        $this->hidden = $hidden;
        $this->category = $category;
    }
    function getTitle() {
        return $this->title;
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

    function getCategory() {
        return $this->category;
    }

    function setTitle($title) {
        $this->title = $title;
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

    function setCategory($category) {
        $this->category = $category;
    }
}
class Category{
    var $cat;
    function __construct($cat) {
        $this->cat = $cat;
    }
    function getCat() {
        return $this->cat;
    }

    function setCat($cat) {
        $this->cat = $cat;
    }
}
class PendingQA{
    var $question;
    var $questionBy;
    var $email;
    function __construct($question, $questionBy, $email) {
        $this->question = $question;
        $this->questionBy = $questionBy;
        $this->email = $email;
    }
    function getQuestion() {
        return $this->question;
    }

    function getQuestionBy() {
        return $this->questionBy;
    }

    function getEmail() {
        return $this->email;
    }

    function setQuestion($question) {
        $this->question = $question;
    }

    function setQuestionBy($questionBy) {
        $this->questionBy = $questionBy;
    }

    function setEmail($email) {
        $this->email = $email;
    }


}