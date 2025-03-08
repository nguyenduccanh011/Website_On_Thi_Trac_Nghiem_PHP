<?php
class Question {
    public $id;
    public $exam_id;
    public $content;
    public $options;
    public $correct_option;

    public function __construct($id, $exam_id, $content, $options, $correct_option) {
        $this->id = $id;
        $this->exam_id = $exam_id;
        $this->content = $content;
        $this->options = $options;
        $this->correct_option = $correct_option;
    }
}
?>
